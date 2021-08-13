###  v1.1.7是不带封禁功能稳定版本，若您不想使用封禁功能，推荐使用此版本
###  v1.3.0是威妥码和汉语拼音互转的稳定版本，推荐使用此版本
本包将持续更新！以下文档更新可能不及时，请详细文档查看

详细文档：https://learnku.com/docs/laravel-help-plugin/1.3.0


# Laravel辅助工具包

<p align="center">
    <a href="https://packagist.org/packages/chowjiawei/laravel-help-plugin" ><img src="https://poser.pugx.org/chowjiawei/laravel-help-plugin/v/stable" /></a> 
    <a href="https://packagist.org/packages/chowjiawei/laravel-help-plugin"><img src="https://img.shields.io/packagist/dt/chowjiawei/laravel-help-plugin.svg?color=" /></a> 
    <a><img src="https://img.shields.io/badge/php-7.0+-59a9f8.svg?style=flat" /></a> 
    <a><img src="https://img.shields.io/badge/laravel-5.5+-59a9f8.svg?style=flat" ></a>
</p>

 #### 支持钉钉机器人 企业微信机器人 微信模板消息/广播 Openexchangerates汇率实时获取的一个工具包

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
     - [Artisan命令示例](#artisan)
- [国家获取转换](#country)
- [Openexchangerates汇率实时获取](#openexchangerates)
- [网站封禁](#ban)
  - [ip封禁](#banip)
  - [mac地址封禁](#banmac)
  - [用户封禁](#banuser)
  - [封禁记录](#banlog)
  - [解除封禁](#banlift)
- [扩展Artisan命令](#extend)
  - [代码生成器](#generate)
    - [钉钉Notification模板生成](#generateDingtalk)
    - [企业微信Notification模板生成](#generateWechat)
    - [微信模板消息Notification模板生成](#generateWechat)
  - [模型生成](#generateModel)
  - [控制器生成](#generateController)
- [威妥码互转汉语拼音-移步详细文档查看](#e)
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
        $user=['odAYnxOVy7vS266666666','odAYnxEuuTCf66666fov276666'];

        $template="iA2V1K45vS8IgUEvE666666EH3R-V-66666";

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

<a name="artisan"></a>
### Artisan命令示例:

由于业务不同，工具默认提供了通知Notification模板，可以通过extend Artisan命令选择代码生成器生成



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
还有更多可以下载包后体验哦

```
Helper::allCountry();

```
<a name="openexchangerates"></a>
# Openexchangerates汇率实时获取

```
use Chowjiawei\Helpers\Exchange\Exchange;
//获取实时汇率
$help->getChangerates();
```
将为您返回完整的汇率及接口信息，以下省略篇幅
```
{
  "disclaimer": "Usage subject to terms: https://openexchangerates.org/terms",
  "license": "https://openexchangerates.org/license",
  "timestamp": 1622097300,
  "base": "USD",
  "rates": {
    "AED": 3.6731,
    "AFN": 79.130257,
    "ALL": 101.073262,
    "AMD": 520.828816,
    "ANG": 1.796011,
    "AOA": 643.121,
    "ARS": 94.4963,
    "AUD": 1.291358,
    "AWG": 1.8,
    "AZN": 1.700805,
    "BAM": 1.604705,
    "BBD": 2,
    "BDT": 85.048855,
    "BGN": 1.601902,
    "BHD": 0.377012,
    "BIF": 1974.680206,

```
```
use Chowjiawei\Helpers\Exchange\Exchange;
//获取特定汇率
$help->getSymbolChangerates(['GBP','EUR','AED','CAD']);
```
将为您返回指定的汇率及接口信息
```
{
    disclaimer: "https://openexchangerates.org/terms/",
    license: "https://openexchangerates.org/license/",
    "timestamp": 1424127600,
    "base": "USD",
    "rates": {
        "AED": 3.67295,
        "CAD": 0.99075,
        "EUR": 0.793903,
        "GBP": 0.62885
    }
}

```


<a name="ban"></a>
# 网站封禁功能

在 `app\Http\Kernel.php`文件内 添加封禁配置

```
    protected $middleware = [
        \App\Http\Middleware\Ban::class
    ];
```

修改`helper`配置文件内的 `ban` 配置的`enable`选项：`true`开启，`false`关闭(默认)

您可以配置自定义需要的异常，在`exception_type`选项配置，`exception_message`配置您显示给用户的消息

您可以选择全部开启，或者开启部分功能
```php

"ban" => [
        "enable" => false, //Enable Ban
        "user_model" => \App\Models\User::class,   //eg:"user_model" => \App\Models\User::class, //Ban user model
        "user_model_primary_key_id" => 'id',  //Ban user model primary_key_id
        "user_id_ban_enable" => false, //Enable user Ban
        "ip_ban_enable" => false, //Enable user ip
        "mac_ban_enable" => false, //Enable user mac
        "exception_type" => 'ErrorException', //Ban exception type
        "exception_message" => 'Your device or account is blocked', //Ban exception message
    ]

```

<a name="banip"></a>
## ip封禁

修改`helper`配置文件内的 `ban` 配置的`ip_ban_enable`选项：`true`开启，`false`关闭(默认)


<a name="banmac"></a>
## mac地址封禁
修改`helper`配置文件内的 `ban` 配置的`mac_ban_enable`选项：`true`开启，`false`关闭(默认)


<a name="banuser"></a>
## 用户封禁
 - 修改`helper`配置文件内的 `ban`  配置的`user_id_ban_enable`选项：`true`开启，`false`关闭(默认)
 - 配置的`user_model`选项：更改为您要封禁的用户模型，`user_model_primary_key_id`更改为您用户模型的主键


<a name="banlog"></a>
## 封禁记录
我们为你内置了一个 `Ban` 模型 ，您可以在模型内添加您所需要的功能，但是不允许删除模型内的原有配置，以免其他地方出现问题

![img.png](readme/images/img.png)

在您要实现封禁的业务逻辑中，使用 

`Ban::ipBan('199.199.199.199', \Carbon\Carbon::now())` 记录下此ip地址   
  ### ip地址如何获取？
  我们为您内置了geoip2包，您可以使用
  ```
  $ip = last(request()->getClientIps());
  $info = geoip($ip)->toArray();
  $info['ip']即为客户端IP地址
  ```

`Ban::macBan('24-4B-99-02-75-C3', \Carbon\Carbon::now())` 记录下mac地址
  ### mac地址如何获取？
  您可以使用以下语句获取mac地址
  ```
  待完善
  ```
  

`Ban::userBan('7666', \Carbon\Carbon::now())` 记录下此用户id
  ### userid如何获取？
  用户id为您用户模型的主键id



### 我们为您提供了个自由更改的例子

以下例子将对10秒内连续访问10次的ip进行封禁，并通知到钉钉机器人

```
if (config('helpers.ban.ip_ban_enable')) {
                //ban ip
                $ip = last(request()->getClientIps());
                $info = geoip($ip)->toArray();
                $cacheIp=Cache::get($info['ip'])?Cache::get($info['ip']):0;

                Cache::put($info['ip'],$cacheIp+1,10);
                
                if(Cache::get($info['ip'])==10){
                    \App\Models\Ban::ipBan($info['ip'],'2021-07-01');
                    Notification::route('dingtalk_robot', config('helpers.dingtalk'))
                        ->notify(new DingtalkRobotNotification($info['ip'].'连续高频访问Api,考虑恶意攻击，系统自动封禁该ip一日', "通知"));
                }
                $findBanUser = \App\Models\Ban::where('ip', $info['ip'])->where('ban_deleted','>', Carbon::now())->first();
                if ($findBanUser) {
                    return response()->view('helpers.errors', ['exception' => $message], 302);
                }
            }
```


<a name="banlift"></a>
## 解除封禁

`Ban::liftBan('199.199.199.199', 'ip')` 解除对该ip的封禁，支持`ip` `mac` `user`


<a name="extend"></a>
# 扩展Artisan命令
插件被您提供了一个支持中文和英文的扩展命令，您可以用命令呼出，命令提供了以下功能

```php artisan extend --chinese ```中文

```php artisan extend  ```英文

  - 创建Rest规范控制器
  - 备份数据库
  - 命令封禁
  - 命令解封

![img_3.png](readme/images/img_3.png)

![img_1.png](readme/images/img_1.png)

我们提供了个默认视图，`views/helpers/error.balde.php`,请根据您的页面协调更改样式


- [代码生成器](#generate)
  - [钉钉Notification模板生成](#generateDingtalk)
  - [企业微信Notification模板生成](#generateWechat)
  - [微信模板消息Notification模板生成](#generateWechat)
  - [模型生成](#generateModel)
  - [控制器生成](#generateController)

## 详情请移步详细文档

单汉语拼音转威妥码拼音

```
Helper::changeHWWord("zhou");
```


![汉语拼音转威妥码拼音](https://cdn.learnku.com/uploads/images/202108/12/61195/k6coQ5Xauj.png!large)



长句汉语拼音转威妥码拼音

```
Helper::changeHWWord("zhou jia wei hao shuai");
```


![汉语拼音转威妥码拼音](https://cdn.learnku.com/uploads/images/202108/12/61195/byi6DgH8Cr.png!large)

单汉语拼音转威妥码拼音

```
Helper::changeWHWord("chou");
```



![威妥码拼音转汉语拼音](https://cdn.learnku.com/uploads/images/202108/12/61195/q8qUU64Liw.png!large)




长句汉语拼音转威妥码拼音

```
Helper::changeWHWord("chou chia wei hao shuai a");
```


![威妥码拼音转汉语拼音](https://cdn.learnku.com/uploads/images/202108/12/61195/C9RmfgpHpN.png!large)


待完善