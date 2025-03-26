<?php
/**
 * User Module User Tag
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add user tag
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',// User ID
        'tags'=> ['tag557','tag4']// User tag
    ];
    $Block = $RongSDK->getUser()->Tag()->set($user);
    Utils::dump("set",$Block);
}
set();

/**
 * Batch add user tags
 */
function batchset()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],// User ID
        'tags'=> ['tag567','tag2']// User tag
    ];
    $Block =  $RongSDK->getUser()->Tag()->batchset($user);
    Utils::dump("batchset",$Block);
}
batchset();

/**
 * Get user tags
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],// User ID
    ];
    $Block =  $RongSDK->getUser()->Tag()->get($user);
    Utils::dump("get",$Block);
}
get();