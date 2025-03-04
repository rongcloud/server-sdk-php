<?php
/**
 * Super cluster module
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Create a super group
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);

    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'name'=> 'watergroup',// Supergroup Name
        'member'=>['id'=> 'group999'],// Create a userId
    ];
    $result = $RongSDK->getUltragroup()->create($group);
    Utils::dump("Create supergroup",$result);
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
    Utils::dump("Join the supergroup",$result);
}
joins();


/**
 * Exit super group
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'member'=>['id'=> 'uPj70HUrRSUk-ixtt7iIGc']// Exit personnel information
    ];
    $result = $RongSDK->getUltragroup()->quit($group);
    Utils::dump("Exit supergroup",$result);
}
quit();

/**
 * Disassemble super cluster
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Ultra group ID
    ];
    $result = $RongSDK->getUltragroup()->dismiss($group);
    Utils::dump("Disband supergroup",$result);
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
    Utils::dump("Modify group information",$result);
}
update();

/**
 * Whether the group member exists
 */
function isExist()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'member'=>"userId1"// Member ID
    ];
    $result = $RongSDK->getUltragroup()->isExist($group);
    Utils::dump("Whether the group member exists",$result);
}
isExist();

