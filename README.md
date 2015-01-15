server-sdk-php
==============
更新日期 2015-01-15
修复消息历史记录请求方法错误
增加消息历史记录删除方法



使用：
include('ServerAPI.php');

$p = new ServerAPI('appKey','AppSecret');
$r = $p->getToken('11','22','33');
print_r($r);

Rong Cloud Server SDK in PHP.
