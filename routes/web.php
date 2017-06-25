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

Route::get('/', function () {
    return redirect('/admin/dashboard');
});
Route::group([
    'prefix' => 'orders'
], function () {
    Route::get('create', "OrderController@create");
    Route::post('create', "OrderController@createHandle");
    Route::get('invoice/{id}', "InvoiceController@view");
    Route::post('invoice/{id}', "InvoiceController@view");
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin::',
    'middleware' => 'auth'
], function () {
    Route::get('dashboard', 'Admin\DashboardController@dashboard');
    Route::get('clients', 'Admin\ClientController@show');
    Route::get('orders', 'Admin\OrderController@show');
    Route::get('products', 'Admin\ProductController@show');
});