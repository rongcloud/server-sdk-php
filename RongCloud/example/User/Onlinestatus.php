<?php
/**
 * 用户模块 用户在线状态
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 在线状态
 */
function check()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90hadsdfasdf',
    ];
    $register = $RongSDK->getUser()->Onlinestatus()->check($user);
    Utils::dump("用户注册",$register);
}
check();

