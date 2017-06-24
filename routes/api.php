<?php
Route::post('client/new', 'ClientController@create');
Route::post('client/login', 'ClientController@create');

Route::group([
    'middleware' => 'auth:client_api'
], function () {
    Route::post('client/{id}/update', 'ClientController@create');
    Route::get('client/reports', 'PatientController@listAllReports');

    Route::get('patients', "PatientController@listAll");
    Route::post('patient/create', "PatientController@create");
    Route::group([
        'middleware' => 'patient_ownership',
    ], function () {
        Route::post('patient/{id}/update', "PatientController@create");
        Route::get('patient/{id}/reports', "PatientController@reports");
        Route::get('patient/{id}/report/create', "PatientController@createReport");
        Route::get('patient/{id}', "PatientController@patient");
    });

    Route::get('labs', "LabController@listAll");
    Route::get('labs/create', "LabController@listAll");
    Route::group(['middleware' => 'lab_ownership'], function () {
        Route::get('labs/{id}/update', "LabController@update");
        Route::get('lab/{id}/reports', "LabController@reports");
        Route::get('lab/{id}', "LabController@view");
    });
});