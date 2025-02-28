<?php
/**
 * // Session module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testConversation($RongSDK){
    $Conversation = $RongSDK->getConversation();
    $params = [
        'type'=> 'PRIVATE',// Session types PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'mka091amn',// Session Owner
        'targetId'=>'adm1klnm'// // session id
    ];
    Utils::dump("设置用户某个会话屏蔽 Push成功",$Conversation->mute($params));

    Utils::dump("设置用户某个会话屏蔽 Push type 错误",$Conversation->mute());

    $params = [
        'type'=> 'PRIVATE',// // Conversation types PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'mka091amn',// // Session owner
        'targetId'=>'adm1klnm'// Session ID
    ];
    Utils::dump("设置用户某个会话接收 Push成功",$Conversation->unmute($params));

    Utils::dump("设置用户某个会话接收 Push type 错误",$Conversation->unmute());

}

testConversation($RongSDK);


