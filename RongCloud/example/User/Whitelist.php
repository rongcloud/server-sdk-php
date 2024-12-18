<?php
/**
 * 用户模块 白名单实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加白名单
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'whitelist'=> ['kkj9o01'] //需要添加白名单的人员列表
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->add($user);
    Utils::dump("添加白名单",$Whitelist);
}
add();

/**
 * 移除白名单
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'whitelist'=> ['kkj9o02'] //需要移除白名单的人员列表
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->remove($user);
    Utils::dump("移除白名单",$Whitelist);
}
remove();

/**
 * 用户白名单列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'size'=> 1000,//分页获取白名单用户时每页行数，不传时默认为 1000 条，最大不超过 1000 条
        'pageToken'=> ''//分页信息，上一次请求返回 next ，不传时不做分页处理，默认获取前 1000 个用户列表，按加入白名单时间倒序排序。
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->getList($user);
    Utils::dump("用户白名单列表",$Whitelist);
}
getList();