<?php
/**
 * User module User ban instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * banned user
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha1',// User ID unique identifier, maximum length 30 characters
        'minute'=> 20//  Blocking duration 1 - 1 * 30 * 24 * 60 minutes
    ];
    $Block = $RongSDK->getUser()->Block()->add($user);
    Utils::dump("banned user",$Block);
}
add();

/**
 * Unblock user
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha1',// Unlock user ID unique identifier, maximum length 30 characters
    ];
    $Block =  $RongSDK->getUser()->Block()->remove($user);
    Utils::dump("remove",$Block);
}
remove();

/**
 * Banned user list
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [

    ];
    $Block =  $RongSDK->getUser()->Block()->getList($user);
    Utils::dump("getList",$Block);
}
getList();