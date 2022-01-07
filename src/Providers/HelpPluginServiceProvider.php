<?php

namespace Chowjiawei\Helpers\Providers;

use Chowjiawei\Helpers\Console\Commands\BackupDatabaseCommand;
use Chowjiawei\Helpers\Console\Commands\ExtendCommand;
use Chowjiawei\Helpers\Console\Commands\GenerateCommand;
use Chowjiawei\Helpers\Facade\Helper;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\ServiceProvider;

class HelpPluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Helper', function () {
            return new Helper();
        });

        $this->app->singleton('Chowjiawei.generate', function ($app) {
            return new GenerateCommand($app['files']);
        });
        $this->app->singleton('Chowjiawei.extend', function ($app) {
            return new ExtendCommand($app['files']);
        });
        $this->commands('Chowjiawei.generate');
        $this->commands('Chowjiawei.extend');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/helpers.php' => config_path('helpers.php'),
            __DIR__ . '/../Config/helpers-pinyin.php' => config_path('helpers-pinyin.php'),
        ]);
    }
}
