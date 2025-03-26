<?php
/**
 * Group module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testGroup($RongSDK){
    $Group = $RongSDK->getGroup();
    $params = [
        'id'=> 'ujadk90ha',// User ID
        'groups'=>[['id'=> 'group9998', 'name'=> 'RongCloud']]// User group information
    ];
    Utils::dump("Group information synchronized successfully",$Group->sync($params));

    Utils::dump("Set the user's session push screen ID error",$Group->sync());

    $params = [
        'id'=> 'watergroup1',// Group ID
        'name'=> 'watergroup',// Group name
        'members'=>[          // Member List
            ['id'=> 'group9991111113']
        ]
    ];
    Utils::dump("Create group success",$Group->create($params));

    Utils::dump("Create group error",$Group->create());

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>"watergroup",// Group Name
        'member'=>['id'=> 'group999'],// Group member information
    ];
    Utils::dump("Join group successfully",$Group->joins($params));

    Utils::dump("Join group member error",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("Incorrect group ID",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',// Group ID
        'member'=>['id'=> 'group999']// Exit personnel information
    ];
    Utils::dump("Exit group successfully",$Group->quit($params));

    Utils::dump("Invalid group ID",$Group->quit());

    $params = [
        'id'=> 'watergroup',// Group ID
        'member'=>['id'=> 'group999']// Exiting personnel information
    ];
    Utils::dump("Group disbanded successfully",$Group->dismiss($params));

    Utils::dump("Cluster ID error",$Group->dismiss());

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("Successfully modified group information",$Group->update($params));

    $params = [
        'id'=> '',// Group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("Modify group information ID error",$Group->update($params));

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>""// group name
    ];
    Utils::dump("Modify group information name error",$Group->update($params));

}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getGroup()->Gag();
    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[//  Forbidden personnel list
            ['id'=> 'group9994']
        ],
        'minute'=>500  // Forbidden duration
    ];
    Utils::dump("Add group mute success",$Group->add($params));

    Utils::dump("@param Error in adding group ban word parameter",$Group->add());

    $params = [
        'id'=> 'watergroup1',
        'members'=>[
            ['id'=> 'group9994']
        ],
        'minute'=>0
    ];
    Utils::dump("Add group ban minute error",$Group->add($params));

    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[//  Forbidden personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("Successfully lifted the ban",$Group->remove($params));

    Utils::dump("Remove forbidden parameter error",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("Remove ban error for members",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("Query banned member list successfully",$Group->getList($params));

    Utils::dump("Query forbidden member list parameter error",$Group->getList());
}

testGroupGag($RongSDK);



function testGroupMuteAllMembers($RongSDK){
    $Group = $RongSDK->getGroup()->MuteAllMembers();
    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("Add the specified group to the full ban list successfully",$Group->add($params));

    Utils::dump("Add specified group-wide ban parameter error",$Group->add());

    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("Unban all members of the specified group successfully",$Group->remove($params));

    Utils::dump("Remove all ban parameters error for the specified group",$Group->remove());

    $params = [

    ];
    Utils::dump("Query the complete list of banned words for the specified group successfully",$Group->getList($params));
}

testGroupMuteAllMembers($RongSDK);


function testGroupMuteWhiteList($RongSDK){
    $Group = $RongSDK->getGroup()->MuteWhiteList();
    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[//  Prohibited personnel list
            ['id'=> 'group9994']
        ],
    ];
    Utils::dump("Successfully added to group blocklist",$Group->add($params));

    Utils::dump("Add group blocklist parameter error",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[//  Forbidden personnel whitelist
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("Unblock the whitelist successfully",$Group->remove($params));

    Utils::dump("Remove the error of the banned whitelist parameter",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("Remove the ban whitelist members error",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// @param group id
    ];
    Utils::dump("Query the forbidden word whitelist member list successfully",$Group->getList($params));

    Utils::dump("Query forbidden whitelist member list parameter error
@param error",$Group->getList());
}

testGroupMuteWhiteList($RongSDK);

function testGroupRemark($RongSDK){
    $Group = $RongSDK->getGroup()->Remark();
    $params = [
        'userId'=> 'ujadk90ha1',// @param personnel id
        'groupId'=>'groupId',//  Group ID
        'remark'=> 'personRemark'// Group annotation
    ];
    Utils::dump("Add group member successfully",$Group->set($params));

    Utils::dump("Add group member parameter error",$Group->set());

    $params = [
        'userId'=> 'ujadk90ha1',// Staff ID
        'groupId'=>'groupId',//  Group ID
    ];
    Utils::dump("Remove group member backup success",$Group->del($params));

    Utils::dump("Remove group member parameter error",$Group->del());

    Utils::dump("Get group member backup success",$Group->get($params));

    Utils::dump("Get group member parameter error",$Group->get());
}

testGroupRemark($RongSDK);
