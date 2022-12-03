<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\api\lockers\BadRequestErrors;

class EnsureLockerIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $codigo_armario = $request->route('codigo_armario');
        $locker = Locker::findByApiToken($request->bearerToken());
        if($locker === null || $locker->serial != $codigo_armario) {
            return new Response(
                [
                    "mensagem" => "Não autorizado a acessar o servidor",
                    "erro" => BadRequestErrors::INVALID_LOCKER,
                ], 400);
        }
        $locker->last_request_time  = now();
        $locker->save();

        $request->merge(["lockerModel" => $locker]);
        return $next($request);
    }
}
