<?php

namespace App\Console\Commands;

use App\Models\Ban;
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
    const CHINESE_BAN_IP = '请输入封禁ip地址';
    const CHINESE_BAN_MAC = '请输入封禁mac地址';
    const CHINESE_BAN_USER = '请输入封禁用户ID';
    const CHINESE_LIFT_BAN_IP = '请输入解封ip地址';
    const CHINESE_LIFT_BAN_MAC = '请输入解封mac地址';
    const CHINESE_LIFT_BAN_USER = '请输入解封用户ID';
    const CHINESE_BAN = '封禁';
    const CHINESE_LIFT_BAN = '解封';
    const CHINESE_BAN_TIME = '请输入您要封禁的时间';
    const CHINESE_BAN_TYPE = '请输入封禁类型';
    const CHINESE_LIFT_BAN_TYPE = '请输入操作类型';
    const CHINESE_SUCCESS = '您的操作已完成';


    const ENGLISH_STORE_REST_CONTROLLER = 'Create rest style resource controller';
    const ENGLISH_DB_BACKUP = 'Backup database';
    const ENGLISH_CHOOSE = 'Please select';
    const ENGLISH_EXIT = 'Exit?';
    const ENGLISH_DB_RESULT = 'If the database backup is successful, you can go to the storage/backup folder to view it';
    const ENGLISH_DB_ALERT = 'During the backup, the website will be temporarily changed to maintenance mode, and will be restored after the backup is completed';
    const ENGLISH_DB_RESULT_ALERT = 'Created for you';
    const ENGLISH_STORE_REST_CONTROLLER_ALERT = 'Please enter the name of the created controller, starting with uppercase, such as:';
    const ENGLISH_BAN_IP = 'Please enter the blocked IP address';
    const ENGLISH_BAN_MAC = 'Please enter the blocked MAC address';
    const ENGLISH_BAN_USER = 'Please enter the blocked user ID';
    const ENGLISH_LIFT_BAN_IP = 'Please enter the unsealing IP address';
    const ENGLISH_LIFT_BAN_MAC = 'Please enter the unsealing MAC address';
    const ENGLISH_LIFT_BAN_USER = 'Please enter the user ID to unseal';
    const ENGLISH_BAN = 'Ban';
    const ENGLISH_LIFT_BAN = 'Lifting Ban';
    const ENGLISH_BAN_TIME = 'Please enter the time you want to ban';
    const ENGLISH_BAN_TYPE = 'Please enter the blocking type';
    const ENGLISH_LIFT_BAN_TYPE = 'Please enter the type of unsealing';
    const ENGLISH_SUCCESS = 'SUCCESS';

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
                'banIp' => self::ENGLISH_BAN_IP,
                'banUser' => self::ENGLISH_BAN_USER,
                'banMac' => self::ENGLISH_BAN_MAC,
                'liftBanIp' => self::ENGLISH_LIFT_BAN_IP,
                'liftBanUser' => self::ENGLISH_LIFT_BAN_USER,
                'liftBanMac' => self::ENGLISH_LIFT_BAN_MAC,
                'ban' => self::ENGLISH_BAN,
                'liftBan' => self::ENGLISH_LIFT_BAN,
                'banTime' => self::ENGLISH_BAN_TIME,
                'banType' => self::ENGLISH_LIFT_BAN_TYPE,
                'success' => self::ENGLISH_SUCCESS,

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
                'banIp' => self::CHINESE_BAN_IP,
                'banUser' => self::CHINESE_BAN_USER,
                'banMac' => self::CHINESE_BAN_MAC,
                'liftBanIp' => self::CHINESE_LIFT_BAN_IP,
                'liftBanUser' => self::CHINESE_LIFT_BAN_USER,
                'liftBanMac' => self::CHINESE_LIFT_BAN_MAC,
                'ban' => self::CHINESE_BAN,
                'liftBan' => self::CHINESE_LIFT_BAN,
                'banTime' => self::CHINESE_BAN_TIME,
                'banType' => self::CHINESE_LIFT_BAN_TYPE,
                'success' => self::CHINESE_SUCCESS,

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
                $language['ban'],
                $language['liftBan'],
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
                case $language['ban']:
                    $banType = $this->choice(
                        $language['banType'],
                        ['ip', 'mac', 'user'],
                        0
                    );
                    switch ($banType){
                        case 'ip':
                            $ip = $this->ask($language['banIp']);
                            $time = $this->ask($language['banTime']);
                            Ban::ipBan($ip, $time);
                            break;
                        case 'mac':
                            $mac = $this->ask($language['banMac']);
                            $time = $this->ask($language['banTime']);
                            Ban::macBan($mac, $time);
                            break;
                        case 'user':
                            $userid = $this->ask($language['banUser']);
                            $time = $this->ask($language['banTime']);
                            Ban::userBan($userid, $time);
                            break;
                    }
                    break;
                case $language['liftBan']:
                    $banType = $this->choice(
                        $language['banType'],
                        ['ip', 'mac', 'user'],
                        0
                    );
                    $value='ip';
                    switch ($banType){
                        case 'ip':
                            $value = $this->ask($language['liftBanIp']);
                            break;
                        case 'mac':
                            $value = $this->ask($language['liftBanMac']);
                            break;
                        case 'user':
                            $value = $this->ask($language['liftBanUser']);
                            break;
                    }
                    Ban::liftBan($value, $banType);

                default:
                    $message = $language['choose'];
            }
            $this->info($language['success']);
            $this->output->title($message ?? $language['exit']);
            $exit = $this->confirm($language['exit']);
        } while ($exit != 'yes');
    }
}
