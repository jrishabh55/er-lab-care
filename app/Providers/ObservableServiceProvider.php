<?php

namespace App\Providers;

use App\Client;
use App\Observable\ClientObservable;
use Illuminate\Support\ServiceProvider;

class ObservableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObservable::class);
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
