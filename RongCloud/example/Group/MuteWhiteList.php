<?php
/**
 * Group ban whitelist whitelist instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add group blocklist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'members'=>[//  Forbidden personnel whitelist
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
        ,
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->add($group);
    Utils::dump("Add group blocklist",$result);
}
add();
/**
 * Query the forbidden whitelist member list
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// group id
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->getList($group);
    Utils::dump("Query the forbidden whitelist member list",$result);
}
getList();
/**
 * Remove the ban from the whitelist
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'members'=>[ //Unblock the whitelist personnel list
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->remove($group);
    Utils::dump("Remove the ban from the whitelist",$result);
}
remove();


getList();