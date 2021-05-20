# Laravel辅助工具包


 支持钉钉机器人 企业微信机器人 微信模板消息/广播 Openexchangerates汇率实时获取

- [安装说明](#composer)
- [发布配置文件](#config)
- [注册门面方法](#facade)
- [消息驱动](#channel)
     - [钉钉机器人](#dingtalk)
     - [企业微信机器人](#wechat)
     - [微信模板消息](#wechatTemp)
- [直接消息推送](#usem)
     - [钉钉机器人](#usedingtalk)
     - [企业微信机器人](#usewechat)
     - [微信模板消息](#usewechatTemp)
- [国家获取转换](#country)
- [Openexchangerates汇率实时获取](#openexchangerates)

<a name="composer"></a>
# 安装说明

环境要求

- php => ^7.0
- guzzlehttp/guzzle => ^6.3"
- laravel/framework => ~5.5|~6.0|~7.0|~8.0,
- overtrue/laravel-wechat => ~5.0

工具包使用composer安装

`composer require chowjiawei/laravel-help-plugin`

<a name="config"></a>
# 发布配置文件

- 使用工具包请运行Artisan命令

`php artisan vendor:publish --provider="Chowjiawei\Helpers\Providers\HelpPluginServiceProvider"`

- 如若使用微信模板消息则需要发布easywechat配置:

`php artisan vendor:publish --provider="Overtrue\LaravelWeChat\ServiceProvider"`


```
<?php

/*
 * This file is part of the overtrue/laravel-wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
     * 默认配置，将会合并到各模块中
     */
    'defaults' => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
         */
        'response_type' => 'array',

        /*
         * 使用 Laravel 的缓存系统
         */
        'use_laravel_cache' => true,

        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => env('WECHAT_LOG_LEVEL', 'debug'),
            'file' => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
        ],
    ],

    /*
     * 路由配置
     */
    'route' => [
        /*
         * 开放平台第三方平台路由配置
         */
        // 'open_platform' => [
        //     'uri' => 'serve',
        //     'action' => Overtrue\LaravelWeChat\Controllers\OpenPlatformController::class,
        //     'attributes' => [
        //         'prefix' => 'open-platform',
        //         'middleware' => null,
        //     ],
        // ],
    ],

    /*
     * 公众号
     */
    'official_account' => [
        'default' => [
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'your-app-id'),         // AppID
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'your-app-secret'),    // AppSecret
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'your-token'),           // Token
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey

            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
             */
            // 'oauth' => [
            //     'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
            //     'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
            // ],
        ],
    ],
];

```

<a name="facade"></a>
# 注册facade

打开`config/app.php`

找到 `providers` 项添加

```
\Chowjiawei\Helpers\Providers\HelpPluginServiceProvider::class,
```

找到 'aliases'添加

```
'Helper'=>\Chowjiawei\Helpers\Facade\Helper::class
```


<a name="channel"></a>
# 消息驱动


- [钉钉机器人](#dingtalk)
- [企业微信机器人](#wechat)
- [微信模板消息](#wechatTemp)


<a name="dingtalk"></a>
## 钉钉机器人消息发送驱动 

```
use Chowjiawei\Helpers\Channels\DingtalkRobotChannel;

public function via($notifiable)
{
    return [DingtalkRobotChannel::class];
}
```

<a name="wechat"></a>
## 微信机器人消息发送驱动

```
use Chowjiawei\Helpers\Channels\WechatRobotChannel;

public function via($notifiable)
{
    return [WechatRobotChannel::class];
}
```

<a name="wechatTemp"></a>
## 微信模板消息发送驱动

```
use Chowjiawei\Helpers\Channels\WechatTemplateMessageChannel;

public function via($notifiable)
{
    return [WechatTemplateMessageChannel::class];
}
```

```
Notification::route('dingtalk_robot', $key)->notify(new YourNotification());
Notification::route('wechat_robot', $key)->notify(new YourNotification());
Notification::route('Wechat_template_message', $key)->notify(new YourNotification());
```

<a name="usem"></a>
# 直接消息推送

- [钉钉机器人](#usedingtalk)
- [企业微信机器人](#usewechat)
- [微信模板消息](#usewechatTemp)

<a name="usedingtalk"></a>
### 钉钉:

`use Chowjiawei\Helpers\Notifications\DingtalkRobotNotification;`

`Notification::route('dingtalk_robot', env("DINGTALK_ROBOT"))
     ->notify(new DingtalkRobotNotification($message,$title));`

<a name="usewechat"></a>
### 企业微信:

`use Chowjiawei\Helpers\Notifications\WechatRobotNotification;`

`Notification::route('wechat_robot', env("WECHAT_ROBOT)"))
->notify(new DingtalkRobotNotification($message));`

<a name="usewechatTemp"></a>
### 微信模板消息:



`use Chowjiawei\Helpers\Notifications\WechatTemplateMessageNotification;`

- 不指定用户（广播用户）

`Notification::route('WechatTemplateMessage', null)->notify(new WechatTemplateMessageNotification($data));` 

- 指定用户

```
        $user=['odAYnxOVy7vS266666GFQ','odAYnxEuuTCf66666fov27cf4A'];

        $template="iA2V1K45vS8IgUEvE666666EH3R-V-DdLWpzAw";

        $data=[

            "order_id"=>[

                "value"=>"20200414234478934343",

                "color"=>"#173177"

            ],

            "package_id"=>[

                "value"=>"SF4345454534",

                "color"=>"#173177"

            ],

            "remark"=>[

                "value"=>'模板消息发送',

                "color"=>"#173177"

            ]

        ];

        Notification::route('WechatTemplateMessage', $user)->notify(new WechatTemplateMessageNotification($data, $template));

``` 

<a name="country"></a>
# 国家获取转换


```
use Chowjiawei\Helpers\PhpHelps\LaravelHelp;

初始化辅助工具
$help=new LaravelHelp();

获取所有国家
$help->getAllCountry();

根据国家代码转国家名字 
$help->getCountryName('CN');
根据国家名字转国家代码
$help->getCountryName('China');
```

or

```
Helper::allCountry();
```
<a name="openexchangerates"></a>
# Openexchangerates汇率实时获取

```
use Chowjiawei\Helpers\Exchange\Exchange;

$help->getChangerates();
```
