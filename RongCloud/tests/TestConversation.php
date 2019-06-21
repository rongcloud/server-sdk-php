<?php
/**
 * 会话模块测试用例
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
        'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
        'userId'=>'mka091amn',//会话所有者
        'targetId'=>'adm1klnm'//会话 id
    ];
    Utils::dump("设置用户某个会话屏蔽 Push成功",$Conversation->mute($params));

    Utils::dump("设置用户某个会话屏蔽 Push type 错误",$Conversation->mute());

    $params = [
        'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
        'userId'=>'mka091amn',//会话所有者
        'targetId'=>'adm1klnm'//会话 id
    ];
    Utils::dump("设置用户某个会话接收 Push成功",$Conversation->unmute($params));

    Utils::dump("设置用户某个会话接收 Push type 错误",$Conversation->unmute());

}

testConversation($RongSDK);


