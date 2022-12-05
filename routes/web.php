<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your central system.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

/*
| Resource example: named companies
+-----------+---------------------------+---------+-------------------+
| GET       | /companies                | index   | companies.index   |
+-----------+---------------------------+---------+-------------------+
| GET       | /companies/create         | create  | companies.create  |
+-----------+---------------------------+---------+-------------------+
| POST      | /companies                | store   | companies.store   |
+-----------+---------------------------+---------+-------------------+
| GET       | /companies/{company}      | show    | companies.show    |
+-----------+---------------------------+---------+-------------------+
| GET       | /companies/{company}/edit | edit    | companies.edit    |
+-----------+---------------------------+---------+-------------------+
| PUT/PATCH | /companies/{company}      | update  | companies.update  |
+-----------+---------------------------+---------+-------------------+
| DELETE    | /companies/{company}      | destroy | companies.destroy |
+-----------+---------------------------+---------+-------------------+
*/

// web routes for the central system(not tenants)
Route::middleware(['system_guard', 'auth:system', 'global_scopes'])->group(function () {
    // Route::get('/companies/{id}/impersonate', [CompanyController::class, 'impersonate'])->name('companies.impersonate');
    // Route::resource('companies', CompanyController::class)->except('show');
});
