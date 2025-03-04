<?php
/**
 * Super group channel instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Super group channel creation
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=> 'busChannel',// Super Group Channel
        'type'=>1
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->add($group);
    Utils::dump("Super group channel creation",$result);
}
create();

function change()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super Group ID
        'busChannel'=> 'busChannel',// Super Group Channel
        'type'=>1
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->change($group);
    Utils::dump("change",$result);
}
change();
/**
 * Super group channel acquisition
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $result = $RongSDK->getUltragroup()->BusChannel()->getList("phpgroup2");
    Utils::dump("Super group channel acquisition",$result);
}
getList();
/**
 * Super group channel deletion
 */
function remove()
{
     $RongSDK = new RongCloud(APPKEY,APPSECRET);
        $group = [
            'id'=> 'phpgroup1',// Supergroup ID
            'busChannel'=> 'busChannel',// Super Group Channel
        ];
        $result = $RongSDK->getUltragroup()->BusChannel()->remove($group);
    Utils::dump("Super group channel deletion",$result);
}
remove();


getList();

/* /**
* Add supergroup private channel member
*/
function addPrivateUsers()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>'',
        'members'=>[ // Add super group private channel member
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->addPrivateUsers($group);
    Utils::dump("Add supergroup private channel member",$result);
}
addPrivateUsers();
/**
 * Query the list of members in the super private channel
 */
function getPrivateUserList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup2',// Super Group ID
        'busChannel'=>'',
        'page'=>1,
        'pageSize'=>100
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->getPrivateUserList($group);
    Utils::dump("Query the list of members in the super private channel",$result);
}
getPrivateUserList();
/**
 * Remove members from the super private channel
 */
function removePrivateUsers()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Supergroup ID
        'busChannel'=>'',
        'members'=>[ // Remove supergroup private channel member
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->removePrivateUsers($group);
    Utils::dump("Remove members from the super private channel",$result);
}
removePrivateUsers();


getPrivateUserList();