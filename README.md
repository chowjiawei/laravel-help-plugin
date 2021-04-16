##chowjiawei/laravel-help-plugin

###Integrating useful auxiliary functions into laravel

##下载方式：composer

composer require chowjiawei/laravel-help-plugin

##发布配置文件

php artisan vendor:publish --provider="Chowjiawei\Helpers\Providers\HelpPluginServiceProvider"


##注册facade

打开config/app.php

找到 'providers'添加

```
\Chowjiawei\Helpers\Providers\HelpPluginServiceProvider::class,
```
找到 'aliases'添加
```
'Helper'=>\Chowjiawei\Helpers\Facade\Helper::class
```


目前支持 

钉钉机器人消息发送  

微信机器人消息发送 

微信模板消息发送 

获取全部国家代码及名字

根据国家代码或名字转化 

获取实时汇率