<?php

/**
 * 消息模块 二人消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 二人消息发送
 */
function set()
{
    //连接新加坡数据中心
    //RongCloud::$apiUrl = ['http://api-sg01.ronghub.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'targetId'          => 'tjw3zbMrU',             //目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
        'conversationType'  => '1',                     //会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] //消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置
    ];
    $res = $RongSDK->getMessage()->Expansion()->set($message);
    Utils::dump("设置消息扩展", $res);
}
set();

/**
 * 向多个用户发送不同内容消息
 */
function delete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'targetId'          => 'tjw3zbMrU',             //目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
        'conversationType'  => '1',                     //会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
        'extraKey'          => ['type1', 'type2']       //需要删除的扩展信息的 Key 值，一次最多可以删除 100 个扩展信息
    ];
    $res = $RongSDK->getMessage()->Expansion()->delete($message);
    Utils::dump("删除消息扩展", $res);
}
delete();

/**
 * 二人状态消息发送
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'pageNo' => 1                     //页数，默认返回 300 个扩展信息。
    ];
    $res = $RongSDK->getMessage()->Expansion()->getList($message);
    Utils::dump("获取扩展信息", $res);
}
getList();
