<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\lockers\LogsController;
use App\Http\Controllers\api\lockers\TechnicianController;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use App\Http\Controllers\api\lockers\ConfigurationController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\api\companies\WebhooksController as CompanyWebhooksController;

/*
|--------------------------------------------------------------------------
| API Routes for tenants
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => [
    'json_response',
    'client_credentials',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
]], function(){

//   Api Lockers -------------------------------------------------------------------------------------------------------
    Route::prefix('armarios/{codigo_armario}')->middleware("valid_locker")->group(function () {
        Route::post('configuracao', [ConfigurationController::class, 'updateConfiguration']);

        Route::middleware("configured_locker")->group(function() {
            Route::get('tecnicos', [TechnicianController::class, 'allTechnician']);
            Route::post('logs', [LogsController::class, 'storeLog']);
        });
    });
});
