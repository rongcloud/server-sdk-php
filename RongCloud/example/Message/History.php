<?php
/**
 * 消息模块 历史消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 历史消息获取
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'date'=> '2019011711',//日期
    ];
    $Chartromm = $RongSDK->getMessage()->History()->get($message);
    Utils::dump("历史消息获取",$Chartromm);
}
get();

/**
 * 历史消息文件删除
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'date'=> '2018011116',//日期
    ];
    $Chartromm = $RongSDK->getMessage()->History()->remove($message);
    Utils::dump("历史消息文件删除",$Chartromm);
}
remove();

/**
 * 消息清除
 */
function clean()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'conversationType'=> '1',//会话类型，支持单聊、群聊、系统会话。单聊会话是 1、群组会话是 3、系统通知是 6
        'fromUserId'=>"fromUserId",//用户 ID，删除该用户指定会话 msgTimestamp 前的历史消息
        'targetId'=>"userId",//需要清除的目标会话 ID
        'msgTimestamp'=>"1588838388320",//清除该时间戳之前的所有历史消息，精确到毫秒，为空时清除该会话的所有历史消息。
    ];
    $Chartromm = $RongSDK->getMessage()->History()->clean($message);
    Utils::dump("消息清除",$Chartromm);
}
clean();
