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


    public function languageChange($language = 'english')
    {
        if ($language == 'english') {
            return config('helpers.extend.english');
        }

        if ($language == 'chinese') {
            return config('helpers.extend.chinese');
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
                $language['generate'],
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
                    switch ($banType) {
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
                        $language['liftBanType'],
                        ['ip', 'mac', 'user'],
                        0
                    );
                    $value = 'ip';
                    switch ($banType) {
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
                    break;
                case $language['generate']:
                    $generateType = $this->choice(
                        $language['generate'],
                        ['Dingtalk', 'Wechat', 'WechatTemplateMessageNotification'],
                        0
                    );
                    switch ($generateType) {
                        case 'Dingtalk':
                            $this->output->title($language['generate_dingtalk']);
                            Artisan::call("generate Dingtalk");
                            break;
                        case 'Wechat':
                            $this->output->title($language['generate_wechat']);
                            Artisan::call("generate Wechat");
                            break;
                        case 'WechatTemplateMessageNotification':
                            $this->output->title($language['generate_wechatTemplateMessage']);
                            Artisan::call("generate WechatTemplateMessage");
                            break;
                    }

                    break;

                default:
                    $message = $language['choose'];
            }
            $this->info($language['success']);
            $this->output->title($message ?? $language['exit']);
            $exit = $this->confirm($language['exit']);
        } while ($exit != 'yes');
    }
}
