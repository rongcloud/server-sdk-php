<?php

/**
 * 超级群模块 超级群扩展消息
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);
/**
 * 消息发送
 */
function set()
{
    //连接新加坡数据中心
    //RongCloud::$apiUrl = ['http://api-sg01.ronghub.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'groupId'          => 'tjw3zbMrU',             //超级群id
        'busChannel'  => '',                     //频道id 可以为空
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] //消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->set($message);
    Utils::dump("设置消息扩展", $res);
}
set();


function delete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'groupId'          => 'tjw3zbMrU',             //超级群id
        'busChannel'  => '',                     //频道id 可以为空
        'extraKey'          => ['type1', 'type2']       //需要删除的扩展信息的 Key 值，一次最多可以删除 100 个扩展信息
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->delete($message);
    Utils::dump("删除消息扩展", $res);
}
delete();

/**
 * 获取超级群扩展消息
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'groupId'=>"aaa" ,//超级群id
        'busChannel'=>"aaa" ,//超级群频道
        'pageNo' => 1                     //页数，默认返回 300 个扩展信息。
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->getList($message);
    Utils::dump("获取扩展信息", $res);
}
getList();
