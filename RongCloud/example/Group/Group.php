<?php
/**
 * Group module
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Group information synchronization
 */
function sync()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'uPj70HUrRSUk-ixtt7iIGc',// User ID
        'groups'=>[['id'=> 'php group1', 'name'=> 'watergroup']]// User group information
    ];
    $result = $RongSDK->getGroup()->sync($group);
    Utils::dump("群组信息同步",$result);
}
sync();

/**
 * Create a group
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'name'=> 'watergroup',// Group name
        'members'=>[          // Group member list
            ['id'=> 'uPj70HUrRSUk-ixtt7iIGc'],['id'=>'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getGroup()->create($group);
    Utils::dump("创建群组",$result);
}
create();

/**
 * Get group information
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// @param group id
    ];
    $result = $RongSDK->getGroup()->get($group);
    Utils::dump("获取群信息",$result);
}
get();

/**
 * Join the group
 */
function joins()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'name'=>"watergroup",// Group name
        'member'=>['id'=> 'group999'],// Group member information
    ];
    $result = $RongSDK->getGroup()->joins($group);
    Utils::dump("加入群组",$result);
}
joins();

/**
 * Exit group
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'member'=>['id'=> 'uPj70HUrRSUk-ixtt7iIGc']// Exit personnel information
    ];
    $result = $RongSDK->getGroup()->quit($group);
    Utils::dump("退出群组",$result);
}
quit();

/**
 * Disband the group
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'member'=>['id'=> 'group999']// Administrator Information
    ];
    $result = $RongSDK->getGroup()->dismiss($group);
    Utils::dump("解散群组",$result);
}
dismiss();

/**
 * Modify group information
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// Group ID
        'name'=>"watergroup"// group name
    ];
    $result = $RongSDK->getGroup()->update($group);
    Utils::dump("修改群信息",$result);
}
update();

