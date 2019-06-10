<?php
/**
 * 推送模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testPush($RongSDK){
    $Push = $RongSDK->getPush();
    $params = [
        'platform'=> ['ios','android'],//目标操作系统
        'fromuserid'=>'mka091amn',//送人用户 Id
        'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
        'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],//发送消息内容
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("广播消息成功",$Push->broadcast($params));

    Utils::dump("广播消息参数错误",$Push->broadcast());

    $params = [
        'platform'=> ['ios','android'],//目标操作系统
        'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("推送消息成功",$Push->push($params));

    Utils::dump("推送消息参数错误",$Push->push());


}

testPush($RongSDK);


