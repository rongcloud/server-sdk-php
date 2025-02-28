<?php
/**
 * // Super cluster module
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Create a super group
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);

    $group = [
        'id'=> 'phpgroup1',// // Super group ID
        'name'=> 'watergroup',// Supergroup Name
        'member'=>['id'=> 'group999'],// // Create a userId
    ];
    $result = $RongSDK->getUltragroup()->create($group);
    Utils::dump("创建超级群",$result);
}
create();

/**
 * Join the super group
 */
function joins()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'member'=>['id'=> 'group999'],// Group member information
    ];
    $result = $RongSDK->getUltragroup()->joins($group);
    Utils::dump("加入超级群",$result);
}
joins();


/**
 * // Exit super group
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'member'=>['id'=> 'uPj70HUrRSUk-ixtt7iIGc']// // Exit personnel information
    ];
    $result = $RongSDK->getUltragroup()->quit($group);
    Utils::dump("退出超级群",$result);
}
quit();

/**
 * // Disassemble super cluster
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// // Ultra group ID
@param ultraGroupId The unique identifier for the ultra group.
    ];
    $result = $RongSDK->getUltragroup()->dismiss($group);
    Utils::dump("解散超级群",$result);
}
dismiss();

/**
 * Modify group information
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Supergroup ID
        'name'=>"watergroup"// group name
    ];
    $result = $RongSDK->getUltragroup()->update($group);
    Utils::dump("修改群信息",$result);
}
update();

/**
 * // Whether the group member exists
 */
function isExist()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'member'=>"userId1"// Member ID
    ];
    $result = $RongSDK->getUltragroup()->isExist($group);
    Utils::dump("群成员是否存在 ",$result);
}
isExist();

