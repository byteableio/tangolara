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
        $this->app->singleton('TangoApi', function ($app) {
          $platform = isset($app['config']['tango.platform_name']) ? $app['config']['tango.platform_name'] : null;
          $key = isset($app['config']['tango.platform_key']) ? $app['config']['tango.platform_key'] : null;

          return new TangoApi($platform, $key);
        });
    }

    /**
     * Boot
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/tango.php' => config_path('tango.php')]);
    }
}
