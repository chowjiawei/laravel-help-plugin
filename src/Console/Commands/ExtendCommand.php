<?php

namespace Chowjiawei\Helpers\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class ExtendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extend { --chinese :  Use Chinese, default English }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'extend command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    const CHINESE_STORE_REST_CONTROLLER = '创建Rest风格资源控制器';
    const CHINESE_DB_BACKUP = '备份数据库';
    const CHINESE_CHOOSE = '请选择';
    const CHINESE_EXIT = '退出?';
    const CHINESE_DB_RESULT = '数据库备份成功，可以前往storage/backup文件夹中查看';
    const CHINESE_DB_ALERT = '备份期间将临时更改网站为维护模式，备份完成后将恢复';
    const CHINESE_DB_RESULT_ALERT = '为您创建了';
    const CHINESE_STORE_REST_CONTROLLER_ALERT = '请输入创建的控制器名字,请以大写开头，如：';

    const ENGLISH_STORE_REST_CONTROLLER = 'Create rest style resource controller';
    const ENGLISH_DB_BACKUP = 'Backup database';
    const ENGLISH_CHOOSE = 'Please select';
    const ENGLISH_EXIT = 'Exit?';
    const ENGLISH_DB_RESULT = 'If the database backup is successful, you can go to the storage/backup folder to view it';
    const ENGLISH_DB_ALERT = 'During the backup, the website will be temporarily changed to maintenance mode, and will be restored after the backup is completed';
    const ENGLISH_DB_RESULT_ALERT = 'Created for you';
    const ENGLISH_STORE_REST_CONTROLLER_ALERT = 'Please enter the name of the created controller, starting with uppercase, such as:';


//    const ENGLISH = [
//        'storeRestController' => self::ENGLISH_STORE_REST_CONTROLLER,
//        'dbBackup' => self::ENGLISH_DB_BACKUP,
//        'choose' => self::ENGLISH_CHOOSE,
//    ];
//
//    const CHINESE = [
//        'storeRestController' => self::CHINESE_STORE_REST_CONTROLLER,
//        'dbBackup' => self::ENGLISH_DB_BACKUP,
//        'choose' => self::CHINESE_CHOOSE,
//    ];

    public function languageChange($language = 'english')
    {
        if ($language == 'english') {
            return [
                'storeRestController' => self::ENGLISH_STORE_REST_CONTROLLER,
                'dbBackup' => self::ENGLISH_DB_BACKUP,
                'choose' => self::ENGLISH_CHOOSE,
                'exit' => self::ENGLISH_EXIT,
                'dbResult' => self::ENGLISH_DB_RESULT,
                'dbAlert' => self::ENGLISH_DB_ALERT,
                'dbResultAlert' => self::ENGLISH_DB_RESULT_ALERT,
                'storeRestControllerAlert' => self::ENGLISH_STORE_REST_CONTROLLER_ALERT,
            ];
        }

        if ($language == 'chinese') {
            return [
                'storeRestController' => self::CHINESE_STORE_REST_CONTROLLER,
                'dbBackup' => self::CHINESE_DB_BACKUP,
                'choose' => self::CHINESE_CHOOSE,
                'exit' => self::CHINESE_EXIT,
                'dbResult' => self::CHINESE_DB_RESULT,
                'dbAlert' => self::CHINESE_DB_ALERT,
                'dbResultAlert' => self::CHINESE_DB_RESULT_ALERT,
                'storeRestControllerAlert' => self::CHINESE_STORE_REST_CONTROLLER_ALERT,
            ];
        }
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exit = 'no';
        if ($this->option('chinese')) {
            $language = $this->languageChange('chinese');
        } else {
            $language = $this->languageChange('english');
        }


        do {
            $option = $this->choice($language['choose'], [
                $language['storeRestController'],
                $language['dbBackup'],
            ]);
            $this->line($option);
            switch ($option) {
                case $language['storeRestController']:
                    $controllerName = $this->ask($language['storeRestControllerAlert'] . 'Product  ProductController');
                    $strLen = strlen($controllerName);
                    $testLen = strlen('Controller');
                    if (substr_compare($controllerName, 'Controller', $strLen - $testLen, $testLen) !== 0) {
                        $controllerName .= 'Controller';
                    }
                    Artisan::call("make:controller $controllerName --resource");
                    $message = $language['dbResultAlert'] . $controllerName;
                    break;
                case $language['dbBackup']:
                    $this->output->title($language['dbAlert']);
                    Artisan::call("down");
                    $this->callSilent("db:backup");
                    Artisan::call("up");
                    $message = $language['dbResult'];
                    break;
                default:
                    $message = $language['choose'];
            }
            $this->output->title($message ?? $language['exit']);
            $exit = $this->confirm($language['exit']);
        } while ($exit != 'yes');
    }
}
