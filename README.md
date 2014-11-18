server-sdk-php
==============
使用：
include('ServerAPI.php');

$p = new ServerAPI( 'appKey','appSecret','/group/sync',
                    array('userId'=>11,'group'=>array('name'=>'xxxx'))
);
$r = $p->request();
print_r($r);

Rong Cloud Server SDK in PHP.
