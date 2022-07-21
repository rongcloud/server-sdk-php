<?php
/**
 * 用户模块 免打扰时段
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加免打扰时段
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'startTime' => "23:59:59",//免打扰开始时间
        'period'=>'600',//免打扰时长 分钟
        'level'=>1,//免打扰级别 1仅针对单聊及 @ 消息进行通知，包括 @指定用户和 @所有人的消息。  5不接收通知，即使为 @ 消息也不推送通知
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->add($user);
    Utils::dump("添加免打扰时段",$Blacklist);
}
add();

/**
 * 移除免打扰时段
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->remove($user);
    Utils::dump("移除免打扰时段",$Blacklist);
}


/**
 * 获取免打扰时段
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->getList($user);
    Utils::dump("获取免打扰时段",$Blacklist);
}
getList();

remove();