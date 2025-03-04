<?php
/**
 * Specify a supergroup member ban instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Set supergroup ban
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        "status"=>1
    ];
    $result = $RongSDK->getUltragroup()->MuteAllMembers()->set($group);
    Utils::dump("添加超级群全部禁言",$result);
}
set();
/**
 * Query the status of super group bans
 */
function get()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Ultra group ID
    ];
    $result = $RongSDK->getUltragroup()->MuteAllMembers()->get($group);
    Utils::dump("查询超级群禁言状态",$result);
}
get();



