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
    return redirect('/admin/dashboard');
});
Route::get('home', function () {
    return redirect('/admin/dashboard');
});

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin::',
], function () {
    Route::get('dashboard', 'Admin\DashboardController@dashboard');
    Route::get('clients', 'Admin\ClientController@show');
    Route::get('orders', 'Admin\OrderController@show');
});