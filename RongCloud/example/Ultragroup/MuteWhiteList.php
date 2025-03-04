<?php
/**
 * Super group ban whitelist whitelist instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add super group ban whitelist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'members'=>[ // Forbidden whitelist personnel list
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
        ,
    ];
    $result = $RongSDK->getUltragroup()->MuteWhiteList()->add($group);
    Utils::dump("Add super group ban whitelist",$result);
}
add();
/**
 * Query the list of members in the forbidden word whitelist
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Ultra group ID
    ];
    $result = $RongSDK->getUltragroup()->MuteWhiteList()->getList($group);
    Utils::dump("Query the list of members in the forbidden word whitelist",$result);
}
getList();
/**
 * Remove the denylist whitelist
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'members'=>[ // //Unblock whitelisted personnel list
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getUltragroup()->MuteWhiteList()->remove($group);
    Utils::dump("Remove the denylist whitelist",$result);
}
remove();


getList();