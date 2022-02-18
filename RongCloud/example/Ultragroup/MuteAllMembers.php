<?php
/**
 * 指定超级群全员禁言实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 设置超级群禁言
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        "status"=>1
    ];
    $result = $RongSDK->getUltragroup()->MuteAllMembers()->set($group);
    Utils::dump("添加超级群全部禁言",$result);
}
set();
/**
 * 查询超级群禁言状态
 */
function get()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
    ];
    $result = $RongSDK->getUltragroup()->MuteAllMembers()->get($group);
    Utils::dump("查询超级群禁言状态",$result);
}
get();



