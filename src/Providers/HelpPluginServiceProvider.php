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
        $this->app->singleton('Chowjiawei.db', function ($app) {
            return new BackupDatabaseCommand($app['files']);
        });
        $this->commands('Chowjiawei.generate');
        $this->commands('Chowjiawei.extend');
        $this->commands('Chowjiawei.db');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/helpers.php' => config_path('helpers.php'),
//            __DIR__ . '/../Console/Commands/BackupDatabaseCommand.php' => app_path('Console/Commands/BackupDatabaseCommand.php'),
            __DIR__ . '/../Middleware/Ban.php' => app_path('Http/Middleware/Ban.php'),
            __DIR__ . '/../Models/Ban.php' => app_path('Models/Ban.php'),
            __DIR__ . '/../Database/migrations/2021_06_29_020823_create_ban_table.php' => database_path('migrations/2021_06_29_020823_create_ban_table.php'),
            __DIR__ . '/../Resources/views/errors.blade.php' => resource_path('views/helpers/errors.blade.php'),

        ]);
    }
}
