<?php
/**
 * 超级群频道实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 超级群频道创建
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=> 'busChannel',//超级群频道
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
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=> 'busChannel',//超级群频道
        'type'=>1
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->change($group);
    Utils::dump("超级群频道类型切换",$result);
}
change();
/**
 * 超级群频道获取
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $result = $RongSDK->getUltragroup()->BusChannel()->getList("phpgroup2");
    Utils::dump("超级群频道列表",$result);
}
getList();
/**
 * 超级群频道删除
 */
function remove()
{

     $RongSDK = new RongCloud(APPKEY,APPSECRET);
        $group = [
            'id'=> 'phpgroup1',//超级群 id
            'busChannel'=> 'busChannel',//超级群频道
        ];
        $result = $RongSDK->getUltragroup()->BusChannel()->remove($group);
    Utils::dump("超级群频道删除",$result);
}
remove();


getList();

/*
**
* 添加超级群私有频道成员
*/
function addPrivateUsers()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=>'',
        'members'=>[ //添加超级群私有频道成员
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->addPrivateUsers($group);
    Utils::dump("添加超级群私有频道成员",$result);
}
addPrivateUsers();
/**
 * 查询超级群私有频道成员列表
 */
function getPrivateUserList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup2',//超级群 id
        'busChannel'=>'',
        'page'=>1,
        'pageSize'=>100
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->getPrivateUserList($group);
    Utils::dump("查询超级群私有频道成员列表",$result);
}
getPrivateUserList();
/**
 * 移除超级群私有频道成员
 */
function removePrivateUsers()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=>'',
        'members'=>[ //移除超级群私有频道成员
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->removePrivateUsers($group);
    Utils::dump("移除超级群私有频道成员",$result);
}
removePrivateUsers();


getPrivateUserList();