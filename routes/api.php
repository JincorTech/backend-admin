<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('companies', 'CompanyAPIController', [
    'only' => [
        'index',
        'show',
    ],
]);

Route::resource('company_types', 'CompanyTypeAPIController');

Route::resource('currencies', 'CurrencyAPIController');

Route::resource('economical_activity_types', 'EconomicalActivityTypeAPIController');

Route::resource('countries', 'CountryAPIController');


Route::resource('mailing_list_items', 'MailingListItemAPIController', [
    'except' => [
        'update'
    ],
]);
