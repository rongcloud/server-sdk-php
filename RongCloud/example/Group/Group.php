<?php
/**
 * 群组模块
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 群组信息同步
 */
function sync()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'uPj70HUrRSUk-ixtt7iIGc',//用户id
        'groups'=>[['id'=> 'php group1', 'name'=> 'watergroup']]//用户群组信息
    ];
    $result = $RongSDK->getGroup()->sync($group);
    Utils::dump("群组信息同步",$result);
}
sync();

/**
 * 创建群组
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'name'=> 'watergroup',//群组名称
        'members'=>[          //群成员 列表
            ['id'=> 'uPj70HUrRSUk-ixtt7iIGc'],['id'=>'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];
    $result = $RongSDK->getGroup()->create($group);
    Utils::dump("创建群组",$result);
}
create();

/**
 * 获取群信息
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
    ];
    $result = $RongSDK->getGroup()->get($group);
    Utils::dump("获取群信息",$result);
}
get();

/**
 * 加入群组
 */
function joins()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'name'=>"watergroup",//群组名称
        'member'=>['id'=> 'group999'],//群成员信息
    ];
    $result = $RongSDK->getGroup()->joins($group);
    Utils::dump("加入群组",$result);
}
joins();

/**
 * 退出群组
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'member'=>['id'=> 'uPj70HUrRSUk-ixtt7iIGc']//退出人员信息
    ];
    $result = $RongSDK->getGroup()->quit($group);
    Utils::dump("退出群组",$result);
}
quit();

/**
 * 解散群组
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'member'=>['id'=> 'group999']//管理员信息
    ];
    $result = $RongSDK->getGroup()->dismiss($group);
    Utils::dump("解散群组",$result);
}
dismiss();

/**
 * 修改群信息
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',//群组 id
        'name'=>"watergroup"//群名称
    ];
    $result = $RongSDK->getGroup()->update($group);
    Utils::dump("修改群信息",$result);
}
update();

