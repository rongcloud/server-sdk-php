# server-sdk-php-composer
Rong Cloud Server SDK in PHP for Composer.

## 安装

* 推荐通过 composer 安装，使用 composer.json 声明依赖，或者运行下面的命令：

```bash
$ composer require qiniu/php-sdk
```

* 直接下载安装，SDK 没有依赖其他第三方库，可直接下载引入使用。

## 使用方法
```php
use RongCloud\Api as RCloud;
...
    $rcloudApi = new RCloud('app_key', 'app_secret');
    $token = $rcloudApi->getToken('user_id', 'user_name' , 'portraitUri');
...
```

## 联系我们
- 如果希望帮助，请提交[工单](http://developer.rongcloud.cn/ticket), 或者 mailto:support.rongcloud.cn
- 如果发现了bug， 欢迎提交 [issue](https://github.com/rongcloud/server-sdk-php-composer)
- 如果要提交代码，欢迎提交 pull request

## 代码许可

The MIT License (MIT).详情见 [License文件](https://github.com/qiniu/php-sdk/blob/master/LICENSE).