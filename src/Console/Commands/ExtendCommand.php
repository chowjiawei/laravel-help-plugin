<?php

namespace Chowjiawei\Helpers\Console\Commands;

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
        if ($this->option('chinese')) {
            $language = $this->languageChange('chinese');
        } else {
            $language = $this->languageChange();
        }

        do {
            $option = $this->choice($language['choose'], [
                $language['generate'],
            ]);
            $this->line($option);
            switch ($option) {
                case $language['generate']:
                    $generateType = $this->choice(
                        $language['generate'],
                        ['Dingtalk', 'Wechat', 'WechatTemplateMessageNotification'],
                        0
                    );

                    switch ($generateType) {
                        case 'Dingtalk':
                            $this->output->title($language['generateDingtalk']);
                            Artisan::call("generate Dingtalk");
                            break;
                        case 'Wechat':
                            $this->output->title($language['generateWechat']);
                            Artisan::call("generate Wechat");
                            break;
                        case 'WechatTemplateMessageNotification':
                            $this->output->title($language['generateWechatTemplateMessage']);
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
