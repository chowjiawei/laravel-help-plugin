## chowjiawei/laravel-help-plugin
laravel辅助工具包

### Integrating useful auxiliary functions into laravel

##下载方式：composer

composer require chowjiawei/laravel-help-plugin

## 发布配置文件

php artisan vendor:publish --provider="Chowjiawei\Helpers\Providers\HelpPluginServiceProvider"


## 注册facade

打开config/app.php

找到 'providers'添加

```
\Chowjiawei\Helpers\Providers\HelpPluginServiceProvider::class,
```

找到 'aliases'添加

```
'Helper'=>\Chowjiawei\Helpers\Facade\Helper::class
```


目前支持以下驱动，具体使用方式详见laravel中国文档 

``
https://learnku.com/docs/laravel/7.x/notifications/7489#specifying-delivery-channels
``

#### 钉钉机器人消息发送驱动 

```
use Chowjiawei\Helpers\Channels\DingtalkRobotChannel;

public function via($notifiable)
{
    return [DingtalkRobotChannel::class];
}
```
#### 微信机器人消息发送驱动

```
use Chowjiawei\Helpers\Channels\WechatRobotChannel;

public function via($notifiable)
{
    return [WechatRobotChannel::class];
}
```

#### 微信模板消息发送驱动

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
Notification::route('WechatTemplateMessage', $key)->notify(new YourNotification());
```

### 获取全部国家代码及名字

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

facade方式：
```
Helper::allCountry();
```

### 获取实时汇率

```
use Chowjiawei\Helpers\Exchange\Exchange;

$help->getChangerates();
```

# 文档待完善