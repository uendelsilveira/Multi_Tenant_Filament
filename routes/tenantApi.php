<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\lockers\LogsController;
use App\Http\Controllers\api\lockers\DoorsController;
use App\Http\Controllers\api\lockers\DeliveriesController;
use App\Http\Controllers\api\lockers\PickupKeysController;
use App\Http\Controllers\api\lockers\TechnicianController;
use App\Http\Controllers\api\lockers\CondominiumController;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use App\Http\Controllers\api\lockers\ConfigurationController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\api\lockers\DeliverymanReceiptController;
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
    // rotas de api
});
