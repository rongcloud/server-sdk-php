<?php
/**
 * Global group ban instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add group ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'members'=>[ // Forbidden personnel list
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ],
        'minute'=>3000  // Forbidden utterance duration
    ];
    $result = $RongSDK->getUser()->MuteGroups()->add($group);
    Utils::dump("add",$result);
}
add();
/**
 * Query the list of banned members
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [

    ];
    $result = $RongSDK->getUser()->MuteGroups()->getList($group);
    Utils::dump("getList",$result);
}
getList();
/**
 * Unblock
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'members'=>[ // //Unblock banned user list
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getUser()->MuteGroups()->remove($group);
    Utils::dump("remove",$result);
}
remove();


getList();