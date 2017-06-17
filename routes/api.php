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

Route::group([
    'as' => 'api::',
    'middleware' => 'auth:client_api'
], function () {
    Route::group([
        'middleware' => 'patient_ownership',
    ], function () {
        Route::get('patient/create', "Api\PatientController@patient");
        Route::get('patient/{id}', "Api\PatientController@patient")->where('id', '[0–9]+');
        Route::get('patient/{id}/reports', "Api\PatientController@reports")->where('id', '[0-9]+');
    });
    Route::get('patients', "Api\PatientController@listAll");
});
