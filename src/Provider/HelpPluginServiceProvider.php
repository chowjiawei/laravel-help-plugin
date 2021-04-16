<?php

namespace Chowjiawei\Helpers\Provider;

use Illuminate\Support\ServiceProvider;

class HelpPluginServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/helpers.php' => config_path('helpers.php'),
        ]);
    }
}