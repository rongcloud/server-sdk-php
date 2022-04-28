<?php
/**
 * 超级群模块
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 创建超级群
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);

    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'name'=> 'watergroup',//超级群名称
        'member'=>['id'=> 'group999'],//创建人userId
    ];
    $result = $RongSDK->getUltragroup()->create($group);
    Utils::dump("创建超级群",$result);
}
create();

/**
 * 加入超级群
 */
function joins()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'member'=>['id'=> 'group999'],//群成员信息
    ];
    $result = $RongSDK->getUltragroup()->joins($group);
    Utils::dump("加入超级群",$result);
}
joins();


/**
 * 退出超级群
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'member'=>['id'=> 'uPj70HUrRSUk-ixtt7iIGc']//退出人员信息
    ];
    $result = $RongSDK->getUltragroup()->quit($group);
    Utils::dump("退出超级群",$result);
}
quit();

/**
 * 解散超级群
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
    ];
    $result = $RongSDK->getUltragroup()->dismiss($group);
    Utils::dump("解散超级群",$result);
}
dismiss();

/**
 * 修改群信息
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'name'=>"watergroup"//群名称
    ];
    $result = $RongSDK->getUltragroup()->update($group);
    Utils::dump("修改群信息",$result);
}
update();

/**
 * 群成员是否存在
 */
function isExist()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'member'=>"userId1"//成员id
    ];
    $result = $RongSDK->getUltragroup()->isExist($group);
    Utils::dump("群成员是否存在 ",$result);
}
isExist();

