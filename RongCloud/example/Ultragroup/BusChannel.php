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
    Utils::dump("超级群频道创建",$result);
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
    Utils::dump("超级群频道类型切换",$result);
}
change();
/**
 * Super group channel acquisition
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $result = $RongSDK->getUltragroup()->BusChannel()->getList("phpgroup2");
    Utils::dump("超级群频道列表",$result);
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
    Utils::dump("超级群频道删除",$result);
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
    Utils::dump("添加超级群私有频道成员",$result);
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
    Utils::dump("查询超级群私有频道成员列表",$result);
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
    Utils::dump("移除超级群私有频道成员",$result);
}
removePrivateUsers();


getPrivateUserList();