<?php
/**
 * User module whitelist instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add to whitelist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'whitelist'=> ['kkj9o01']//  The list of personnel requiring whitelist addition
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->add($user);
    Utils::dump("add",$Whitelist);
}
add();

/**
 * Remove whitelist
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'whitelist'=> ['kkj9o02']//  List of personnel to be removed from the whitelist
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->remove($user);
    Utils::dump("remove",$Whitelist);
}
remove();

/**
 * User whitelist
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'size'=> 1000,// The number of rows per page when fetching the whitelist users, defaults to 1000 if not passed, with a maximum of no more than 1000
        'pageToken'=> ''// Pagination information, the next request returns 'next', no pagination processing is done when not transmitting, defaults to fetching the first 1000 user lists, sorted in reverse order by whitelist addition time.
    ];
    $Whitelist = $RongSDK->getUser()->Whitelist()->getList($user);
    Utils::dump("getList",$Whitelist);
}
getList();