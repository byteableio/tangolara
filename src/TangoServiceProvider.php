<?php

namespace Byteable\Tangolara;

use Byteable\Tangolara\TangoService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class TangoServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TangoService', function ($app) {

            $platform = $app['config']['tango']['platform_name'];
            $key = $app['config']['tango']['platform_key'];

          return new TangoService($platform, $key);
        });
    }

    /**
     * Boot
     */
    public function boot()
    {
        $this->package('byteable/tangolara', 'byteable/tangolara');

        // $this->publishes([__DIR__ . '/config/tango.php' => config_path('tango.php')]);
    }
}
