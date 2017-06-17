<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($data, $response_code = 200, $error = false) {

            $response = [];
            $response['status'] = $error ? 'error' : 'ok';
            $response['code'] = $response_code;
            $response['data'] = $data;

            return response()->json($response);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
