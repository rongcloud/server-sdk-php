<?php
/**
 * 会话实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;
/**
 * 设置用户某个会话屏蔽 Push
 */
function mute()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $conversation = [
        'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
        'userId'=>'Vu-oC0_LQ6kgPqltm_zYtI',//会话所有者
        'targetId'=>'Vu-oC0_LQ6kgPqltm_zYtI'//会话 id
    ];
    $result = $RongSDK->getConversation()->mute($conversation);
    Utils::dump("设置用户某个会话屏蔽 Push",$result);
}
mute();

/**
 *设置用户某个会话接收 Push
 */
function unmute()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $conversation = [
        'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
        'userId'=>'mka091amn',//会话所有者
        'targetId'=>'adm1klnm'//会话 id
    ];
    $result = $RongSDK->getConversation()->unmute($conversation);
    Utils::dump("设置用户某个会话接收 Push",$result);
}
unmute();
