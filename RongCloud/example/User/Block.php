<?php
/**
 * 用户模块 用户禁言实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 封禁用户
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha1',//封禁用户id 唯一标识，最大长度 30 个字符
        'minute'=> 20 //封禁时长 1 - 1 * 30 * 24 * 60 分钟
    ];
    $Block = $RongSDK->getUser()->Block()->add($user);
    Utils::dump("封禁用户",$Block);
}
add();

/**
 * 解除用户封禁
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha1',//解禁用户id 唯一标识，最大长度 30 个字符
    ];
    $Block =  $RongSDK->getUser()->Block()->remove($user);
    Utils::dump("解除用户封禁",$Block);
}
remove();

/**
 * 封禁用户列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [

    ];
    $Block =  $RongSDK->getUser()->Block()->getList($user);
    Utils::dump("封禁用户列表",$Block);
}
getList();