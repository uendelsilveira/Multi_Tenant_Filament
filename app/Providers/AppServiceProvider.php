<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Passport::loadKeysFrom(base_path('/storage'));
        Passport::$registersRoutes = false;

        Route::group([
            'as' => 'passport.',
            'middleware' => [InitializeTenancyBySubdomain::class], // Use tenancy initialization middleware of your choice
            'prefix' => config('passport.path', 'oauth'),
            'namespace' => 'Laravel\Passport\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . "/../../vendor/laravel/passport/src/../routes/web.php");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
