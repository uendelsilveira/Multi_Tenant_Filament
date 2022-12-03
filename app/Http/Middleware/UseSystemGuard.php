<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Password;

class UseSystemGuard
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
        // set system auth guard. Defined at config/auth.php
        Auth::shouldUse('system');
        // set a "password reset configuration" for central system users. Defined at config/auth.php
        Password::setDefaultDriver('system_users');
        return $next($request);
    }
}
