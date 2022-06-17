<?php
/**
 超级群免打扰
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 设置超级群免打扰
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=>"",
        "unpushLevel"=>1
        //免打扰级别
        //-1：全部消息通知
        //0：未设置（用户未设置时为此状态，为全部消息都通知，在此状态下，如设置了超级群默认状态以超级群的默认设置为准）
        //1：仅针对 @ 消息进行通知，包括 @指定用户 和 @所有人
        //2：仅针对 @ 指定用户消息进行通知，且仅通知被 @ 的指定的用户进行通知。
        //如：@张三 则张三可以收到推送，@所有人 时不会收到推送。
        //
        //4：仅针对 @群全员进行通知，只接收 @所有人 的推送信息
        //5：不接收通知，即使为 @ 消息也不推送通知。
    ];
    $result = $RongSDK->getUltragroup()->Notdisturb()->set($group);
    Utils::dump("设置超级群免打扰",$result);
}
set();
/**
 * 查询超级群免打扰
 */
function get()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=>"",
    ];
    $result = $RongSDK->getUltragroup()->Notdisturb()->get($group);
    Utils::dump("查询超级群免打扰",$result);
}
get();



