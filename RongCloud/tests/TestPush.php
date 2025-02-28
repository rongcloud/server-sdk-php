<?php
/**
 * Push module test case
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
        'platform'=> ['ios','android'],// // Target operating system
        'fromuserid'=>'mka091amn',// Sender User ID
        'audience'=>['is_to_all'=>true],// // Push conditions, including: tag, userid, is_to_all.
        'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],// // Message content
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("广播消息成功",$Push->broadcast($params));

    Utils::dump("广播消息参数错误",$Push->broadcast());

    $params = [
        'platform'=> ['ios','android'],// // Target operating system
        'audience'=>['is_to_all'=>true],// Push conditions, including: tag, userid, is_to_all.
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("推送消息成功",$Push->push($params));

    Utils::dump("推送消息参数错误",$Push->push());


}

testPush($RongSDK);


