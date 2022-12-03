<?php

namespace App\Http\Middleware;

use App\Models\Ala;
use App\Models\Apartment;
use App\Models\Bloc;
use App\Models\Company;
use App\Models\Condominium;
use App\Models\CondominiumManager;
use App\Models\DeliveryAccess;
use App\Models\Door;
use App\Models\Locker;
use App\Models\PickupKey;
use App\Models\Resident;
use App\Models\Scopes\ApartmentScope;
use App\Models\Scopes\CentralSystemScope;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\CondominiumScope;
use App\Models\Scopes\LockerScope;
use App\Models\Scopes\ProfileScope;
use App\Models\Scopes\UserScope;
use App\Models\Size;
use App\Models\TechnicianAccess;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnableGlobalScopesMiddleware
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
        User::addGlobalScope(new ProfileScope);
        return $next($request);
    }
}
