<?php

Route::get('dashboard', 'DashboardController@dashboard');
Route::get('clients', 'ClientController@show');
Route::get('orders', 'OrderController@show');
Route::get('products', 'ProductController@show');