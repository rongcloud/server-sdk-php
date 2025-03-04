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
        'platform'=> ['ios','android'],// Target operating system
        'fromuserid'=>'mka091amn',// Sender User ID
        'audience'=>['is_to_all'=>true],// Push conditions, including: tag, userid, is_to_all.
        'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],// Message content
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("Broadcast message succeeded",$Push->broadcast($params));

    Utils::dump("Broadcast message parameter error",$Push->broadcast());

    $params = [
        'platform'=> ['ios','android'],// Target operating system
        'audience'=>['is_to_all'=>true],// Push conditions, including: tag, userid, is_to_all.
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    Utils::dump("Message pushed successfully",$Push->push($params));

    Utils::dump("Push message parameter error",$Push->push());


}

testPush($RongSDK);


