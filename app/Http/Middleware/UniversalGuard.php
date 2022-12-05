<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Password;

class UniversalGuard
{
    /**
     * Handle an incoming request.
     * Set "auth guard" and "password reset configuration". Defined at config/auth.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(tenancy()->initialized) {
            Auth::shouldUse('tenants');
            Password::setDefaultDriver('users');
        }
        else {
            Auth::shouldUse('system');
            Password::setDefaultDriver('system_users');
        }
        return $next($request);
    }
}
