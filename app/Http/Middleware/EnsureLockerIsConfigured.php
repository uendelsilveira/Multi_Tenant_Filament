<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\api\lockers\BadRequestErrors;

class EnsureLockerIsConfigured
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
        /** @var Locker $locker */
        $locker = $request->get("lockerModel");
        if($locker->configured === Locker::WAITING_CONFIG) {
            return new Response(
                [
                    "mensagem" => "Aguardando o armário enviar suas configurações",
                    "erro" => BadRequestErrors::NOT_CONFIGURED_LOCKER,
                ], 400);
        }

        return $next($request);
    }
}
