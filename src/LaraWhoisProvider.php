<?php

namespace AzisHapidin\LaraWhois;

use Illuminate\Support\ServiceProvider;

class LaraWhoisProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (version_compare(app()->version(), '5.0', '>=')) {
            $this->publishes([
                __DIR__.'/../config/larawhois.php' => config_path('larawhois.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Silent is gold
    }
}
