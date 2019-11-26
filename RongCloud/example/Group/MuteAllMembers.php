<?php
/**
 * 指定群组全员禁言实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加群组禁言
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->add($group);
    Utils::dump("添加指定群组全部禁言",$result);
}
add();
/**
 * 查询禁言成员列表
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [

    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->getList($group);
    Utils::dump("查询指定群组全部禁言列表",$result);
}
getList();
/**
 * 解除禁言
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->remove($group);
    Utils::dump("解除指定群组全部禁言",$result);
}
remove();


