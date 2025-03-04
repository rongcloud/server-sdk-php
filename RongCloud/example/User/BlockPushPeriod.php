<?php
/**
 * User module no disturbance period
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add a Do Not Disturb period
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'startTime' => "23:59:59",// Do not disturb start time
        'period'=>'600',// Do not disturb duration in minutes
        'level'=>1,// Do Not Disturb Level 1 only targets single chats and @ messages for notifications, including @ specific users and @ all messages.  
// No notifications are received, even for @ messages.
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->add($user);
    Utils::dump("Add a do-not-disturb period",$Blacklist);
}
add();

/**
 * Remove the do-not-disturb period
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->remove($user);
    Utils::dump("Remove the do-not-disturb period",$Blacklist);
}


/**
 * Get the do-not-disturb period
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
    ];
    $Blacklist = $RongSDK->getUser()->BlockPushPeriod()->getList($user);
    Utils::dump("Get the no-disturb period",$Blacklist);
}
getList();

remove();