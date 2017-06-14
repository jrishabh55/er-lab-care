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
    Route::get('patient/{patient}', "Api\PatientController@patient")->middleware('patient_ownership');
    Route::get('patient/{patient}/reports', "Api\PatientController@reports")->middleware('patient_ownership');
    Route::get('patients', "Api\PatientController@listAll");
});