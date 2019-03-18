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
