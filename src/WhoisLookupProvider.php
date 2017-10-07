<?php

namespace AzisHapidin\WhoisLookup;

use Illuminate\Support\ServiceProvider;

class WhoisLookupProvider extends ServiceProvider
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
                __DIR__.'/../config/whois-lookup.php' => config_path('whois-lookup.php'),
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
