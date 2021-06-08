<?php

/**
 * 用户模块 白名单实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 设置用户单聊禁言
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => ['kkj9o01', 'kkj9o02'],  //被禁言用户 Id，支持批量设置，最多不超过 1000 个。
        'state' => 1,                    //禁言状态，0 解除禁言、1 添加禁言
        'type' => 'PERSON',              //会话类型，目前支持单聊会话 PERSON
    ];
    $res = $RongSDK->getUser()->Ban()->set($user);
    Utils::dump("设置用户单聊禁言", $res);
}
set();

/**
 * 查询单聊禁言用户列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'num'       => 101,     //获取行数，默认为 100，最大支持 200 个。
        'offset'    => 0,       //查询开始位置，默认为 0。
        'type'      => 'PERSON' //会话类型，目前支持单聊会话 PERSON。
    ];
    $res = $RongSDK->getUser()->Ban()->getList($param);
    Utils::dump("查询单聊禁言用户列表", $res);
}
getList();
