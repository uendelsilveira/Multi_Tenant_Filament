<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImpersonateController;
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
        ->middleware(['universal_guard', 'web', InitializeTenancyBySubdomain::class])
        ->name('sanctum.csrf-cookie');
});

Route::middleware([
    'universal_guard',
    'web',
    InitializeTenancyBySubdomain::class
])->group(function () {
    require __DIR__.'/auth.php';

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth', 'global_scopes'])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth'])
        // ->middleware(['auth', 'verified'])
        ->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
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
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/impersonate/{token}', [ImpersonateController::class, 'impersonateAndRedirect'])->name('tenant.impersonate');

    Route::middleware(['auth:tenants', 'global_scopes'])->group(function () {
        Route::get('/tenant', function () {
            // dd(\App\Models\User::all()->toJson($flags=JSON_PRETTY_PRINT));
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        });
    });
});
