<?php
/**
 * 群组模块 群组备注
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加群组备注
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha1',//人员id
        'groupId'=>'abca', //群组id
        'remark'=> '人员备注'//群组备注
    ];
    $Remark = $RongSDK->getGroup()->Remark()->set($group);
    Utils::dump("添加备注",$Remark);
}
set();

/**
 * 删除群组备注
 */
function del()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha11',//人员id
        'groupId'=>'abca', //群组id
    ];
    $Remark = $RongSDK->getGroup()->Remark()->del($group);
    Utils::dump("删除备注",$Remark);
}
del();

/**
 * 获取群组备注
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'userId'=> 'ujadk90ha1',//人员id
        'groupId'=>'abca', //群组id
    ];
    $Remark =  $RongSDK->getGroup()->Remark()->get($group);
    Utils::dump("获取群组备注",$Remark);
}
get();