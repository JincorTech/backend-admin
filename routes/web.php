<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('companies', 'CompanyController', [
    'only' => [
        'index',
        'show',
    ],
]);

Route::post('companies/block/{id}', [
    'as' => 'companies.block',
    'uses' => 'CompanyController@block',
]);

Route::post('companies/unblock/{id}', [
    'as' => 'companies.unblock',
    'uses' => 'CompanyController@unblock',
]);

Route::get('/dashboard', [
    'as' => 'dashboard.index',
    'uses' => 'DashboardController@index',
]);

Route::resource('companyTypes', 'CompanyTypeController');

Route::resource('currencies', 'CurrencyController');

Route::resource('economicalActivityTypes', 'EconomicalActivityTypeController');

Route::resource('countries', 'CountryController');

Route::resource('mailingListItems', 'MailingListItemController', [
    'except' => [
        'update'
    ],
]);
