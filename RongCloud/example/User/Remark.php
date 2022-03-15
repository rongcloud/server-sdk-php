<?php
/**
 * 用户模块 用户备注
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加用户备注
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',//用户id
        'remarks'=> json_encode([['id'=>'user1','remark'=>'备注4'],['id'=>'user2','remark'=>'备注4']])//用户备注
    ];
    $Remark = $RongSDK->getUser()->Remark()->set($user);
    Utils::dump("添加备注",$Remark);
}
set();

/**
 * 删除用户备注
 */
function del()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',//用户id
        'targetId'=> "userId1"//用户备注
    ];
    $Remark = $RongSDK->getUser()->Remark()->del($user);
    Utils::dump("删除备注",$Remark);
}
del();

/**
 * 获取用户备注
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',//用户id
        'size'=>100,
        'page'=>1
    ];
    $Remark =  $RongSDK->getUser()->Remark()->get($user);
    Utils::dump("获取用户备注",$Remark);
}
get();