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
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/helpers.php' => config_path('helpers.php'),
        ]);
        $this->publishes([
            __DIR__ . '/../Console/Commands/extendCommand.php' => app_path('Console/Commands/extendCommand.php'),
        ]);
        $this->publishes([
            __DIR__ . '/../Console/Commands/BackupDatabaseCommand.php' => app_path('Console/Commands/BackupDatabaseCommand.php'),
        ]);
    }
}