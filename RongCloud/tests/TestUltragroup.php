<?php
/**
 * Super cluster module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testGroup($RongSDK){
    $Group = $RongSDK->getUltragroup();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'name'=> 'watergroup',// Super group name
        'member'=>['id'=> 'group999'],// Create a userId
    ];
    Utils::dump("Create super group success",$Group->create($params));

    Utils::dump("Create super group error",$Group->create());

    $params = [
        'id'=> 'watergroup',// Supergroup ID
        'member'=>['id'=> 'group999'],// Group member information
    ];
    Utils::dump("Joined the super group successfully",$Group->joins($params));

    Utils::dump("Error adding supergroup member",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("Error in adding super group ID",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',// Super group ID
        'member'=>['id'=> 'group999']// Exit personnel information
    ];
    Utils::dump("Exit supergroup successfully",$Group->quit($params));

    Utils::dump("Error in exiting super group ID",$Group->quit());

    $params = [
        'id'=> 'watergroup',// Supergroup ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("Modify group information successfully",$Group->update($params));

    $params = [
        'id'=> '',// Super group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("Modify group message ID error",$Group->update($params));

    $params = [
        'id'=> 'watergroup',// Super group ID
        'name'=>""// group name
    ];
    Utils::dump("Modify group information name error",$Group->update($params));


    $params = [
        'id'=> 'watergroup',// ultra group id
    ];
    Utils::dump("Disband the supergroup successfully",$Group->dismiss($params));

    Utils::dump("Resolve supergroup ID error",$Group->dismiss());
    $params = [
        'id'=> 'watergroup',// Super group ID
        'member'=>"userId1"// Member ID
    ];

    Utils::dump("Whether the super group member exists successfully",$Group->isExist($params));

    Utils::dump("Whether the super group member exists ID error",$Group->isExist());



}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getUltragroup()->Gag();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[//  Prohibited personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("Add super group ban word success",$Group->add($params));

    Utils::dump("Add super group ban parameter error",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Supergroup ID
        'members'=>[//  Forbidden personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("Unblocking successful",$Group->remove($params));

    Utils::dump("Remove prohibition parameter error",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("Remove forbidden word members error",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// ultra group id
    ];
    Utils::dump("Query the banned member list successfully",$Group->getList($params));

    Utils::dump("Query forbidden word list parameter error",$Group->getList());
}

testGroupGag($RongSDK);



function testGroupMuteAllMembers($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteAllMembers();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'status'=>true
    ];
    Utils::dump("Add specified supergroup full ban success",$Group->set($params));

    Utils::dump("Add specified super group all forbidden parameters error",$Group->set());

    $params = [
        'id'=> 'watergroup1',// ultra group id
    ];
    Utils::dump("Successfully queried the complete ban list of the specified supergroup.",$Group->get($params));
}

testGroupMuteAllMembers($RongSDK);

function testGroupMuteWhiteList($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteWhiteList();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[//  Prohibited whitelist personnel list
            ['id'=> 'group9994']
        ],
    ];
    Utils::dump("Successfully added to the super group ban list whitelist",$Group->add($params));

    Utils::dump("Add super group ban whitelist parameter error",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[//  Prohibited whitelist personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("Successfully removed from the blocklist",$Group->remove($params));

    Utils::dump("Remove the whitelist parameter error from the prohibition list",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("Unblock whitelist members error",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// Ultra group ID
    ];
    Utils::dump("Querying the banned words whitelist member list successfully",$Group->getList($params));

    Utils::dump("Query forbidden word whitelist member list parameter error",$Group->getList());
}

testGroupMuteWhiteList($RongSDK);

function testGroupBusChannel($RongSDK){
    $Group = $RongSDK->getUltragroup()->BusChannel();
    $params = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=> 'busChannel',// Super Group Channel
        'type'=>0
    ];
    Utils::dump("Add super group channel successfully",$Group->add($params));

    Utils::dump("Error in adding super group channel parameters",$Group->add());

    Utils::dump("Query super group channel list successfully",$Group->getList("phpgroup1"));

    Utils::dump("Successfully deleted the super group channel",$Group->remove($params));

    Utils::dump("Delete super group channel error",$Group->remove());

    Utils::dump("Query super group channel list parameter error",$Group->getList());

    Utils::dump("Supergroup channel type switch succeeded",$Group->change($params));

    Utils::dump("Super group channel type switching parameter error",$Group->change());

    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>'',
        'members'=>[//  Add supergroup private channel member
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];

    Utils::dump("Super Group Private Channel Member Addition",$Group->addPrivateUsers($group));

    Utils::dump("Error in adding supergroup private channel member parameters",$Group->addPrivateUsers());

    Utils::dump("Super group private channel member removal",$Group->removePrivateUsers($group));

    Utils::dump("Super group private channel member removal parameter error",$Group->removePrivateUsers());

    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>'',
    ];

    Utils::dump("Super group private channel member acquisition success",$Group->getPrivateUserList($group));

    Utils::dump("Super group private channel member parameter acquisition error",$Group->getPrivateUserList());

}

testGroupBusChannel($RongSDK);

function testGroupNotdisturb($RongSDK){
    $Group = $RongSDK->getUltragroup()->Notdisturb();
    $params = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=> 'busChannel',// Super group channel
        'unpushLevel'=>1
    ];
    Utils::dump("Set super group do not disturb",$Group->set($params));

    Utils::dump("Set super cluster anti-disturbance parameter error",$Group->set());

    $params = [
        'id'=> 'phpgroup1',// Super Group ID
        'busChannel'=> 'busChannel',// Super group channel
    ];
    Utils::dump("Query super group do not disturb",$Group->get($params));
}

testGroupNotdisturb($RongSDK);

