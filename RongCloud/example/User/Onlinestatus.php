<?php
/**
 * User Module User Online Status
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Online status
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

