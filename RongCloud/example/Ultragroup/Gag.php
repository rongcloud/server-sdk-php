<?php
/**
 * Supergroup ban example
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add super group ban speech
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Supergroup ID
        'members'=>[//  Forbidden personnel list
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
        ,
        'minute'=>3000  // Forbidden utterance duration
    ];
    $result = $RongSDK->getUltragroup()->Gag()->add($group);
    Utils::dump("Add super group ban speech",$result);
}
add();
/**
 * Query the list of banned members
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Ultra Group ID
    ];
    $result = $RongSDK->getUltragroup()->Gag()->getList($group);
    Utils::dump("Query the list of banned members",$result);
}
getList();
/**
 * Lift the ban
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Supergroup ID
        'members'=>[//  Unban user list
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getUltragroup()->Gag()->remove($group);
    Utils::dump("Lift the ban",$result);
}
remove();


getList();