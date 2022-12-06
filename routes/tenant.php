<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

/*
|--------------------------------------------------------------------------
| Universal Routes // Web Universal Routes - central system and tenants
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => config('sanctum.prefix', 'sanctum')], static function () {
    Route::get('/csrf-cookie',[CsrfCookieController::class, 'show'])
        // Use tenancy initialization middleware of your choice
        ->middleware(['universal', 'web', InitializeTenancyBySubdomain::class])
        ->name('sanctum.csrf-cookie');
});

Route::middleware(['universal', 'universal_guard', 'web', InitializeTenancyBySubdomain::class])->group(function () {
    // rotas universais, login, home e etc
    Route::get('/login', function () {
        // dd(\App\Models\User::all()->toJson($flags=JSON_PRETTY_PRINT));
        if (Auth::attempt(['email' => 'admin@azanonatec.com.br', 'password' => 'q7a4z1x2'])) {
            // Authentication was successful...
            logger('login ok');
            return response('login ok');
        }
        else {
            logger('login fail');
            return response('login fail');
        }
    })->name('login');
});

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth:tenants',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        // dd(\App\Models\User::all()->toJson($flags=JSON_PRETTY_PRINT));
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});
