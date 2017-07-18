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

Auth::routes();
//Auth::guard('client_web')->loginUsingId(1);

Route::post('login/client', "Auth\LoginController@clientLogin")->name('login::client');

Route::middleware('auth:client_web')->group(function () {

    Route::get('/', "DashboardController@index");

    Route::prefix('order')->group(function () {
        Route::get('create/{id?}', "OrderController@create");
        Route::post('create', "OrderController@createHandle");
    });

    Route::get('payment/invoices', 'InvoiceController@list');
    Route::prefix('payment')->middleware('invoice_owner')->group(function () {
        Route::get('invoice-{id}', "InvoiceController@view");
        Route::post('invoice-{id}', "PaymentController@payment");
        Route::get('invoice-{id}/response', "PaymentController@response");
    });

    Route::get('services', 'ServiceController@view');
});

