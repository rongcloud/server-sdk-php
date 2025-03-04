<?php

/**
 * User module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

/**
 * testUser
 *
 * @param RongCloud $RongSDK
 * @return void
 */
function testUser($RongSDK)
{
    $portrait = "  http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982";
    $User = $RongSDK->getUser();

    $params = [
        'id' => 'ujadk90had', // User ID
        'name' => 'test', // Username
        'portrait' => $portrait // User avatar
    ];
    Utils::dump("User registration successful", $User->register($params));

    Utils::dump("User registration ID error", $User->register());

    $params = [
        'id' => 'ujadk90had',
        'name' => '',
        'portrait' => $portrait
    ];
    Utils::dump("User registration name error", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => Utils::createRand(66),
        'portrait' => $portrait
    ];
    Utils::dump("User registration name length error", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '测试用户',
        'portrait' => Utils::createRand(513)
    ];
    Utils::dump("User registration portrait error", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '新用户',
        'portrait' => $portrait
    ];
    Utils::dump("User update successful", $User->update($params));

    Utils::dump("User update ID error", $User->update());

    $params = [
        'id' => 'ujadk90had',
        'name' => '',
        'portrait' => $portrait
    ];
    Utils::dump("User update name error", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => Utils::createRand(66),
        'portrait' => $portrait
    ];
    Utils::dump("User update name length error", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '测试用户',
        'portrait' => Utils::createRand(513)
    ];
    Utils::dump("User update portrait error", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("Successfully retrieved user information", $User->get($params));

    $params = [
        'id' => '55vW81Mni',
    ];
    Utils::dump("Query user's group membership success", $User->getGroups($params));


    $params = [
        'id' => ['55vW81Mni','kkj9o02'],
        'time' => 1623123911000
    ];
    Utils::dump("Token expired", $User->expire($params));

    $params = [
        'id' => '55vW81Mni',
    ];
    Utils::dump("Token invalid, failure time is a required parameter", $User->expire($params));
}

testUser($RongSDK);

function testUserBlock($RongSDK)
{
    $User = $RongSDK->getUser()->Block();

    $params = [
        'id' => 'ujadk90had', // User ID, unique identifier, maximum length of 30 characters
        'minute' => 20 // Blocking duration 1 - 1 * 30 * 24 * 60 minutes
    ];
    Utils::dump("User blocked successfully", $User->add($params));

    Utils::dump("Add banned user ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
        'minute' => 0
    ];
    Utils::dump("Add banned user minute error", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
        'minute' => 1 * 30 * 24 * 60 * 2
    ];
    Utils::dump("Add a banned user with minute size error", $User->add($params));


    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("User unblocked successfully", $User->remove($params));

    Utils::dump("Remove blocked user ID error", $User->remove());

    Utils::dump("User ban successful", $User->getList());
}

testUserBlock($RongSDK);

function testUserBlacklist($RongSDK)
{
    $User = $RongSDK->getUser()->Blacklist();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'blacklist' => ['ujadk90ha1d'] // Add blacklist personnel list
    ];
    Utils::dump("User blacklist added successfully", $User->add($params));

    Utils::dump("User blacklist ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("User blacklist error", $User->add($params));


    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'blacklist' => ['ujadk90ha1d'] // Add to blacklist personnel list
    ];
    Utils::dump("User blacklist removed successfully", $User->add($params));

    Utils::dump("Remove user blacklist ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("Remove user blacklist error", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("User blacklist retrieval successful", $User->getList($params));


    Utils::dump("Error in obtaining user blacklist ID", $User->getList());
}

testUserBlacklist($RongSDK);

function testUserOnlinestatus($RongSDK)
{
    $User = $RongSDK->getUser()->Onlinestatus();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
    ];
    Utils::dump("User online status retrieved successfully", $User->check($params));

    Utils::dump("User online status parameter error", $User->check());
}

testUserOnlinestatus($RongSDK);


function testUserMuteGroups($RongSDK)
{
    $Group = $RongSDK->getUser()->MuteGroups();
    $params = [
        'members' => [ // Forbidden personnel list
            ['id' => 'group9994']
        ],
        'minute' => 500   //Prohibition duration
    ];
    Utils::dump("Group mute added successfully", $Group->add($params));

    Utils::dump("Add group ban parameter error", $Group->add());

    $params = [
        'members' => [
            ['id' => 'group9994']
        ],
        'minute' => 0
    ];
    Utils::dump("Add group ban minute error", $Group->add($params));

    $params = [
        'members' => [ // Forbidden personnel list
            ['id' => 'group9994']
        ]
    ];
    Utils::dump("Group mute lifted successfully", $Group->remove($params));

    Utils::dump("Unblock group mute parameter error", $Group->remove());
    $params = [
        'members' => []
    ];
    Utils::dump("Remove group ban error for members", $Group->remove($params));

    $params = [];
    Utils::dump("Successfully queried the list of banned members in the group", $Group->getList($params));
}

testUserMuteGroups($RongSDK);

function testUserMuteChatrooms($RongSDK)
{
    $Chatroom = $RongSDK->getUser()->MuteChatrooms();
    $params = [
        'members' => [
            ['id' => 'seal9901'] // Personnel ID
        ],
        'minute' => 30 // Prohibited duration
    ];
    Utils::dump("Add chat room global ban success", $Chatroom->add($params));

    Utils::dump("Add chat room global ban parameter error", $Chatroom->add());

    $params = [
        'members' => [
            ['id' => 'seal9901'] // Personnel ID
        ],
    ];
    Utils::dump("Successfully lifted the global ban in the chat room", $Chatroom->remove($params));

    Utils::dump("Remove global chat ban error", $Chatroom->remove());

    $params = [];
    Utils::dump("Successfully retrieved the global banned word list for the chat room", $Chatroom->getList($params));
}
testUserMuteChatrooms($RongSDK);


function testUserTag($RongSDK)
{
    $Chatroom = $RongSDK->getUser()->Tag();
    $params = [
        'userId' => 'ujadk90ha1', // User ID
        'tags' => ['tag1', 'tag2'] // User label
    ];
    Utils::dump("User tag added successfully", $Chatroom->set($params));

    Utils::dump("Error in adding user tag parameter", $Chatroom->set());

    $params = [
        'userIds' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
        'tags' => ['tag1', 'tag2'] // User label
    ];
    Utils::dump("Batch adding user tags succeeded", $Chatroom->batchset($params));

    Utils::dump("Batch add user tag parameter error", $Chatroom->batchset());

    $params = [
        'userIds' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
    ];
    Utils::dump("Get user tag success", $Chatroom->get($params));

    Utils::dump("Get user tag parameter error", $Chatroom->get());
}
testUserTag($RongSDK);

function testUserWhitelist($RongSDK)
{
    $User = $RongSDK->getUser()->Whitelist();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'whitelist' => ['ujadk90ha1d'] // Add blacklist personnel list
    ];
    Utils::dump("User whitelist added successfully", $User->add($params));

    Utils::dump("User whitelist ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("User whitelist error", $User->add($params));


    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'whitelist' => ['ujadk90ha1d'] // Add blacklist personnel list
    ];
    Utils::dump("Remove user whitelist successfully", $User->add($params));

    Utils::dump("Remove user whitelist ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("Remove user whitelist error", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("User whitelist obtained successfully", $User->getList($params));


    Utils::dump("User whitelist ID retrieval error", $User->getList());
}

testUserWhitelist($RongSDK);


function testChatBan($RongSDK)
{
    $ban = $RongSDK->getUser()->Ban();
    $params = [
        'id' => ['kkj9o01', 'kkj9o02'],   //Banned user Id, supports batch setting, with a maximum of no more than 1000.
        'state' => 1,                     //Forbidden state, 0: Remove forbidden. 1: Add forbidden.
        'type' => 'PERSON',               //conversation type, currently supports single conversation PERSON
    ];
    Utils::dump("Set user single chat ban", $ban->set($params));
    $params = [
        'state' => 1,
        'type' => 'PERSON',
    ];
    Utils::dump("Set user single chat ban error", $ban->set($params));
    $param = [
        'num'       => 101,      //Get the number of rows, default is 100, maximum supported is 200.
        'offset'    => 0,        //The starting position for the query, default is 0.
        'type'      => 'PERSON' // Currently supports single-person conversation type PERSON.
    ];
    Utils::dump("Query single-chat banned user list", $ban->getList($param));
}

testChatBan($RongSDK);

function testUserRemark($RongSDK)
{
    $remark = $RongSDK->getUser()->Remark();
    $params = [
        'userId' => 'kkj9o01',
        'remarks'=>json_encode([["id"=>"userid1","remark"=>"remark1"]])
    ];
    Utils::dump("Set user remarks", $remark->set($params));
    $params = [
    ];
    Utils::dump("Set user backup note userId error", $remark->set($params));

    $params = [
        'userId' => 'kkj9o01',
        'targetId'=>"friendId"
    ];
    Utils::dump("Delete user remarks", $remark->del($params));
    $params = [
    ];
    Utils::dump("Delete user backup annotation userId error", $remark->del($params));
    $params = [
        'userId' => 'kkj9o01',
        'size'=>50,
        'page'=>1
    ];
    Utils::dump("Get user annotation list", $remark->get($params));
    $params = [
    ];
    Utils::dump("Get user annotation list userId error", $remark->get($params));
}

testUserRemark($RongSDK);



function testUserAbandon($RongSDK)
{
    $User = $RongSDK->getUser();
    $params = [
        'id' => 'kkj9o01',
    ];
    Utils::dump("deactivate users", $User->abandon($params));
    $params = [
    ];
    Utils::dump("Deactivate user ID error", $User->abandon($params));

    $params = [
        'id' => 'kkj9o01',
    ];
    Utils::dump("Deactivate user activation", $User->activate($params));
    $params = [
    ];
    Utils::dump("Error in deactivated user activation ID", $User->activate($params));


    $params = [
        'size'=>50,
        'page'=>1
    ];
    Utils::dump("List of unsubscribed users", $User->abandonQuery($params));
}

testUserAbandon($RongSDK);


function testBlockPushPeriod($RongSDK)
{
    $User = $RongSDK->getUser()->BlockPushPeriod();

    $params = [
        'id' => 'ujadk90had', // User ID unique identifier, maximum length 30 characters
        'startTime' => "23:59:59", //No interference start time
        'period'=>'600', //Do not disturb duration: minutes
        'level'=>1, //Do Not Disturb Level 1 only notifies for private chats and @ messages, including @ specified users and @ all messages. Does not receive notifications, even for @ messages.
    ];
    Utils::dump("Add a do-not-disturb period", $User->add($params));

    Utils::dump("Add do-not-disturb period ID error", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("Add error-free quiet period startTime", $User->add($params));


    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("Successfully removed the do-not-disturb period", $User->remove($params));

    Utils::dump("Remove the no-disturb period ID error", $User->remove());

    Utils::dump("Quiet hours acquisition succeeded", $User->getList($params));
}

testBlockPushPeriod($RongSDK);

/**
 * testProfile
 *
 * @param RongCloud $RongSDK
 * @return void
 */
function testProfile($RongSDK)
{
    $User = $RongSDK->getUser()->Profile();

    $params = [
        'userId' => 'ujadk90ha1', // User ID
        'userProfile' => [
            'name' => 'testName',
            'email' => 'tester@rongcloud.cn'
        ],   //User basic information
        'userExtProfile' => [
            'ext_Profile1' => 'testpro1'
        ]   //User extension information
    ];
    Utils::dump("User profile settings", $User->set($params));

    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
    ];
    Utils::dump("User custody information clearance", $User->clean($params));

    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
    ];
    Utils::dump("Batch query user information", $User->batchQuery($params));

    $params = [
        'page' => 1,
        'size' => 20,
        'order' => 0
    ];
    Utils::dump("Retrieve the full list of users for the application", $User->query($params));

}
testProfile($RongSDK);

/**
 * Paginate to retrieve the full list of application users
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'page' => 1,
        'size' => 20,
        'order' => 0
    ];
    $res =  $RongSDK->getUser()->Profile()->query($params);
    Utils::dump("Get the full list of users by pagination", $res);
}