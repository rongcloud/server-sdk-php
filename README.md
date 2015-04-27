server-sdk-php
==============
更新日期 2015-01-15
修复消息历史记录请求方法错误
增加消息历史记录删除方法

==============
更新日期    2015-01-26
新增 用户相关接口：检查用户在线状态、封禁、解封、查询封禁用户、刷新用户信息


==============
更新日期    2015-02-02
新增 用户黑名单接口：userBlacklistAdd（添加）、userBlacklistQuery（查询）、userBlacklistRemove（删除）


=============
更新日期    201504-27
修复 参数中有 "@" 开头，导致接口调用异常


使用：
include('ServerAPI.php');

$p = new ServerAPI('appKey','AppSecret');
$r = $p->getToken('11','22','33');
print_r($r);

Rong Cloud Server SDK in PHP.
