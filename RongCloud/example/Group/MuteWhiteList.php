<?php
/**
 * 群组禁言白名单白名单实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加群组禁言白名单
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'members'=>[ //禁言白名单人员列表
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
        ,
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->add($group);
    Utils::dump("添加群组禁言白名单",$result);
}
add();
/**
 * 查询禁言白名单成员列表
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->getList($group);
    Utils::dump("查询禁言白名单成员列表",$result);
}
getList();
/**
 * 解除禁言白名单
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'members'=>[ ////解除禁言白名单人员列表
                ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
            ]
    ];
    $result = $RongSDK->getGroup()->MuteWhiteList()->remove($group);
    Utils::dump("解除禁言白名单",$result);
}
remove();


getList();