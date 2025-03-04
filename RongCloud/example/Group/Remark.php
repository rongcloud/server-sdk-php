<?php
/**
 * Group module group annotation
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add group annotation
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha1',// @param personnelId
        'groupId'=>'abca', // Group ID
        'remark'=> '人员备注'// Group annotation
    ];
    $Remark = $RongSDK->getGroup()->Remark()->set($group);
    Utils::dump("Add group annotation",$Remark);
}
set();

/**
 * Delete group backup
 */
function del()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha11',// Personnel ID
        'groupId'=>'abca', // Group ID
    ];
    $Remark = $RongSDK->getGroup()->Remark()->del($group);
    Utils::dump("Delete group backup",$Remark);
}
del();

/**
 * Get group remarks
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha1',// Personnel ID
/* Personnel ID */
        'groupId'=>'abca', // Group ID
    ];
    $Remark =  $RongSDK->getGroup()->Remark()->get($group);
    Utils::dump("Get group remarks",$Remark);
}
get();