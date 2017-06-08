<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__ . '/../Http/helpers.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
