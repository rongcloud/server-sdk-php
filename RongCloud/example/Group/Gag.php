<?php
/**
 * Group ban example
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add group ban words
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'members'=>[ // Forbidden personnel list
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
        ,
        'minute'=>3000  // Forbidden duration
    ];
    $result = $RongSDK->getGroup()->Gag()->add($group);
    Utils::dump("Add group ban words",$result);
}
add();
/**
 * Query the list of banned members
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// group id
    ];
    $result = $RongSDK->getGroup()->Gag()->getList($group);
    Utils::dump("Query the list of banned members",$result);
}
getList();
/**
 * Unblock
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'members'=>[ //Unblock the list of banned personnel
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getGroup()->Gag()->remove($group);
    Utils::dump("Unblock",$result);
}
remove();


getList();