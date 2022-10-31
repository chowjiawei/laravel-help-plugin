
  * [x] 通知发送（包括但不限于以下频道【更多待接入】）
  - * [x]  钉钉机器人
  - * [x]  企业微信机器人
  - * [x]  微信模板消息
  - * [x]  飞书机器人
  * [x] 威妥码拼音互转获取
  * [x] 汇率实时互转获取（Openexchangerates Api）
  * [x] 全球城市中英互转获取 及更新
  * [x] 抖音新交易系统 （非旧交易系统 目前旧交易系统已经被官方废弃 ，正在更新）
本包将持续更新！请详细文档托管 https://learnku.com/docs/laravel-help-plugin

如发现bug  请直接提issue或者直接提pr，造成的不便请谅解。



# Laravel辅助工具包

<p align="center">
    <a href="https://packagist.org/packages/chowjiawei/laravel-help-plugin" ><img src="https://poser.pugx.org/chowjiawei/laravel-help-plugin/v/stable" /></a>
    <a><img src="https://img.shields.io/badge/php-7.0+-59a9f8.svg?style=flat" /></a> 
    <a><img src="https://img.shields.io/badge/laravel-5.5+-59a9f8.svg?style=flat" ></a>
</p>

 #### 目录

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
- [扩展Artisan命令](#extend)
  - [代码生成器](#generate)
    - [钉钉Notification模板生成](#generateDingtalk)
    - [企业微信Notification模板生成](#generateWechat)
    - [微信模板消息Notification模板生成](#generateWechat)
- [威妥码互转汉语拼音-移步详细文档查看](#pinyin)
- [抖音新交易系统](#tiktokPay)

## JetBrains 支持的项目

非常感谢 Jetbrains 为我提供了从事这个和其他开源项目的许可。

[![](https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.svg)](https://www.jetbrains.com/?from=https://github.com/overtrue)




<a name="composer"></a>
# 安装说明

环境要求 本包依托于Laravel框架，其他框架暂不适用

- php => ^7.0
- guzzlehttp/guzzle => ^6.3"
- laravel/framework => ~5.5|~6.0|~7.0|~8.0|~9.0
- overtrue/laravel-wechat => ~5.0

使用composer安装

`composer require chowjiawei/laravel-help-plugin`

<a name="config"></a>
# 发布配置文件

- 使用工具包请运行Artisan命令

`php artisan vendor:publish --provider="Chowjiawei\Helpers\Providers\HelpPluginServiceProvider"`

- 如若使用微信模板消息则需要发布easywechat配置，本包默认内置easywechat: 

`php artisan vendor:publish --provider="Overtrue\LaravelWeChat\ServiceProvider"`
微信包的配置  按需填写  公共号配置 `official_account` 配置省略


<a name="facade"></a>
# 注册facade

本报提供laravel Facade便捷，如需使用可按如下配置

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
- [飞书机器人](#lark)

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

该驱动支持单用户发送和广播功能

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

<a name="lark"></a>
## 飞书机器人消息发送驱动

```
use Chowjiawei\Helpers\Channels\DingtalkRobotChannel;

public function via($notifiable)
{
    return [DingtalkRobotChannel::class];
}
```


<a name="usem"></a>
# 直接消息推送

- [钉钉机器人](#usedingtalk)
- [企业微信机器人](#usewechat)
- [微信模板消息](#usewechatTemp)
- [飞书机器人](#uselark)

<a name="usedingtalk"></a>
### 钉钉:

`use Chowjiawei\Helpers\Notifications\DingtalkRobotNotification;`

`Notification::route('dingtalk_robot', env("DINGTALK_ROBOT"))
     ->notify(new DingtalkRobotNotification($message,$title));`

<a name="usewechat"></a>
### 企业微信:

`use Chowjiawei\Helpers\Notifications\WechatRobotNotification;`

`Notification::route('wechat_robot', env("WECHAT_ROBOT)"))
->notify(new WechatRobotNotification($message));`

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

<a name="uselark"></a>
### 飞书:

`use Chowjiawei\Helpers\Notifications\LarkRobotNotification;`

`Notification::route('lark', env("LARK_ROBOT"))
->notify(new DingtalkRobotNotification($message));`


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




<a name="extend"></a>
# 扩展Artisan命令
插件为您提供了一个支持中文和英文的扩展命令，您可以用命令呼出，命令提供了以下功能

```php artisan extend --chinese ```中文

```php artisan extend  ```英文

  - [钉钉Notification模板生成](#generateDingtalk)
  - [企业微信Notification模板生成](#generateWechat)
  - [微信模板消息Notification模板生成](#generateWechat)

<a name="pinyin"></a>
## 威妥码拼音

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

<a name="tiktokPay"></a>
## 抖音新交易系统
```use Chowjiawei\Helpers\Services\TTV2Service;```

`helpers.php` 配置文件中 `tiktok` 选项 全部需要配置完全才可以使用

- 查询订单

```php
$tiktokService= new TTV2Service();
$tiktokService->query("站内订单号，非抖音侧订单号");
正确时返回数组 其余返回空数组
```

- 发起退款

```php
$tiktokService= new TTV2Service();
$tiktokService->refund("站内订单号，非抖音侧订单号");
正确时返回true 其余返回false
```

- 同意退款

```php
$tiktokService= new TTV2Service();
$tiktokService->agreeRefund("站内订单号，非抖音侧订单号");
正确时返回true 其余返回false
```

- 查询退款

```php
$tiktokService= new TTV2Service();
$tiktokService->getRefund("站内订单号，非抖音侧订单号");
返回数组
```

- 发起分账

```php
$tiktokService= new TTV2Service();
$tiktokService->settle("站内订单号，非抖音侧订单号", "分账描述");
正确时返回true 其余返回false
```

- 设置回调配置

#### `config`中配置完成后 `$settingData`可以不传
如果需要再次自定义或者扩展更多糊掉参数  可以传详细参数  更多参数参考抖音
```php

$settingData = [
 'create_order_callback' => "", 
 'refund_callback' => "",
 'pay_callback' => "",
 ];

$tiktokService= new TTV2Service();
$tiktokService->settingReturn(array $settingData=[]);
正确时返回true 其余返回false
```

- 查询回调配置

```php
$tiktokService= new TTV2Service();
$tiktokService->getSettingReturn();
正确时返回数组，其余返回空数组
```

- 支付回调

```php
$tiktokService= new TTV2Service();
$tiktokService->return($request);  //控制器内 直接将接受的Request $request 传入return方法，即可自动验签，并返回接收参数

返回 `status` 正确为`true` 附带 `data`数据    错误为 `false`
```

如果业务处理失败 需要手动返回抖音成功

```php
$tiktokService->returnOK(); 
```

如果业务处理失败 需要手动返回抖音失败

```php
$tiktokService->returnError($result='失败原因，可省略'); 
```

- 预下单回调

```php
$tiktokService= new TTV2Service();
$tiktokService->return($request);  //控制器内 直接将接受的Request $request 传入return方法，即可自动验签，并返回接收参数
```

如果业务处理失败 需要手动返回抖音成功
```php
$tiktokService->returnOK(); 
```
如果业务处理失败 需要手动返回抖音失败
```php
$tiktokService->returnError($result='失败原因，可省略'); 
```

### 建议将数组内数据  存起来 后续退款等操作都需要用 抖音不支持二次查询某些字段
如果需要退款  必须存储 item_order_id_list  获取如下:
```php
$itemOrderId = json_decode($extendItem['msg'], true)['goods'][0]['item_order_id_list'][0];
```

- 退款回调

```php
$tiktokService= new TTV2Service();
$tiktokService->refundReturn($request); 
```

如果业务处理失败 需要手动返回抖音成功
```php
$tiktokService->returnOK(); 
```
如果业务处理失败 需要手动返回抖音失败
```php
$tiktokService->returnError($result='失败原因，可省略'); 
```

- 分账回调

```php
$tiktokService= new TTV2Service();
$tiktokService->settleCallback($request); 
```

如果业务处理失败 需要手动返回抖音成功
```php
$tiktokService->returnOK(); 
```
如果业务处理失败 需要手动返回抖音失败
```php
$tiktokService->returnError($result='失败原因，可省略'); 
```