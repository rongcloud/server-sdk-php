<?php
/**
 * // User module user remarks
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Add user remarks
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',// // User ID
        'remarks'=> json_encode([['id'=>'user1','remark'=>'备注4'],['id'=>'user2','remark'=>'备注4']])// // User Annotation
    ];
    $Remark = $RongSDK->getUser()->Remark()->set($user);
    Utils::dump("添加备注",$Remark);
}
set();

/**
 * // Delete user remarks
 */
function del()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',// // User ID
        'targetId'=> "userId1"// // User backup
    ];
    $Remark = $RongSDK->getUser()->Remark()->del($user);
    Utils::dump("删除备注",$Remark);
}
del();

/**
 * // Get user remark
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',// User ID
        'size'=>100,
        'page'=>1
    ];
    $Remark =  $RongSDK->getUser()->Remark()->get($user);
    Utils::dump("获取用户备注",$Remark);
}
get();