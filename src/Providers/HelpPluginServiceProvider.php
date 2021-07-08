<?php

namespace Chowjiawei\Helpers\Providers;

use Chowjiawei\Helpers\Facade\Helper;
use Illuminate\Support\ServiceProvider;

class HelpPluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Helper', function () {
            return new Helper();
        });

        $this->app->singleton('Chowjiawei.generate', function ($app) {
            return new MakeServices($app['files']);
        });
        $this->commands('Chowjiawei.generate');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/helpers.php' => config_path('helpers.php'),
            __DIR__ . '/../Console/Commands/ExtendCommand.php' => app_path('Console/Commands/ExtendCommand.php'),
            __DIR__ . '/../Console/Commands/BackupDatabaseCommand.php' => app_path('Console/Commands/BackupDatabaseCommand.php'),
            __DIR__ . '/../Middleware/Ban.php' => app_path('Http/Middleware/Ban.php'),
            __DIR__ . '/../Models/Ban.php' => app_path('Models/Ban.php'),
            __DIR__ . '/../Database/migrations/2021_06_29_020823_create_ban_table.php' => database_path('migrations/2021_06_29_020823_create_ban_table.php'),
            __DIR__ . '/../Resources/views/errors.blade.php' => resource_path('views/helpers/errors.blade.php'),

        ]);
    }
}