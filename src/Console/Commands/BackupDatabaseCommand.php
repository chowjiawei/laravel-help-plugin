<?php

namespace Chowjiawei\Helpers\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '备份数据库';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        WORKSPACE_INSTALL_MYSQL_CLIENT=true
        $dirPath = storage_path('backup/');
        $filePath = $dirPath . date('Y-m-d') . '.sql';
        shell_exec(sprintf(
            'mysqldump -h%s -p%s -u%s -p%s %s > %s',
            env('DB_HOST'),
            env('DB_PORT'),
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE'),
            $filePath
        ));
        $this->info('The backup has been proceed successfully.');
    }
}
