<?php

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

Route::group([
    'as' => 'api::',
    'middleware' => 'auth:client_api'
], function () {
    Route::group([
        'middleware' => 'patient_ownership',
    ], function () {
        Route::get('patient/create', "Api\PatientController@create");
        Route::get('patient/{id}', "Api\PatientController@patient")->where('id', '[0–9]+');
        Route::get('patient/{id}/reports', "Api\PatientController@reports")->where('id', '[0-9]+');
    });
    Route::get('patients', "Api\LabController@listAll");
    Route::get('patients', "Api\LabController@reports");
});

Route::middleware('api_response')->get('test', function () {
    return response()->json(App\Client::where('email', "rishabh@jnexsoft.com")->first());
});

Route::get('client/new', 'Api\ClientController@create');
Route::get('client/{id}/update', 'Api\ClientController@create')->where('id', '[0-9]+');
