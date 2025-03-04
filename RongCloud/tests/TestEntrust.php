<?php

/**
 * Group information hosting module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

/**
 * Create a group
 */
function testGroupCreate($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('Failed to create group, missing required parameter name', $result);

    $param['name'] = 'RC_NAME_1';
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('Failed to create group, missing required parameter owner', $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('Group creation successful', $result);
}
testGroupCreate($RongSDK);

/**
 * Set group resources
 */
function testGroupUpdate($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->update($param);
    Utils::dump("Set group resource failure, missing required parameter name", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'name' => 'RC_NAME_2',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->update($param);
    Utils::dump("Set group resources successfully", $result);
}
testGroupUpdate($RongSDK);

/**
 * Exit the group
 */
function testGroupQuit($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->quit($param);
    Utils::dump("Failed to exit the group, missing required parameter userIds", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->quit($param);
    Utils::dump("Successfully exited the group", $result);
}
testGroupQuit($RongSDK);

/**
 * Dissolve group
 */
function testGroupDismiss($RongSDK)
{
    $param = [
        'groupId' => 'CHIQ_GROUP_2'
    ];
    $result = $RongSDK->getEntrust()->Group()->dismiss($param);
    Utils::dump("Disband group success", $result);
}
testGroupDismiss($RongSDK);

/**
 * Join the group
 */
function testGroupJoin($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->join($param);
    Utils::dump("Failed to join group, missing required parameter userIds", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456']
    ];
    $result = $RongSDK->getEntrust()->Group()->join($param);
    Utils::dump("Group join successful", $result);
}
testGroupJoin($RongSDK);

/**
 * Transfer group
 */
function testGroupTransferOwner($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->transferOwner($param);
    Utils::dump("Transfer group failed, missing required parameter newOwner", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'newOwner' => '123',
        'isQuit' => 0,
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->transferOwner($param);
    Utils::dump("Group transfer successful", $result);
}
testGroupTransferOwner($RongSDK);

/**
 * Group hosting import
 */
function testGroupImport($RongSDK)
{
    $param = ['name' => 'RC_NAME_1'];
    $result = $RongSDK->getEntrust()->Group()->import($param);
    Utils::dump("Group hosting import failed, missing required parameter groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->import($param);
    Utils::dump("Group hosting import successful", $result);
}
testGroupImport($RongSDK);

/**
 * Pagination query application group information
 */
function testGroupQuery($RongSDK)
{
    $param = [
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->query($param);
    Utils::dump("Pagination query application group information succeeded", $result);
}
testGroupQuery($RongSDK);

/**
 * Query users added to a group by page
 */
function testGroupJoinedQuery($RongSDK)
{
    $param = ['role' => 0];
    $result = $RongSDK->getEntrust()->Group()->joinedQuery($param);
    Utils::dump("Failed to query the user's joined groups by page, missing required parameter userId", $result);

    $param = [
        'userId' => '10',
        'role' => 0,
        'pageToken' => 'xxxx',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->joinedQuery($param);
    Utils::dump("Pagination query for user-added groups successful", $result);
}
testGroupJoinedQuery($RongSDK);

/**
 * Batch query group data
 */
function testGroupProfileQuery($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->Group()->profileQuery($param);
    Utils::dump("Batch query group data failed, missing required parameter groupIds", $result);

    $param = [
        'groupIds' => ['RC_GROUP_1', 'CHIQ_GROUP_2']
    ];
    $result = $RongSDK->getEntrust()->Group()->profileQuery($param);
    Utils::dump("Batch query group data successful", $result);
}
testGroupProfileQuery($RongSDK);

/**
 * Set group administrator (Add group administrator)
 */
function testGroupManagerAdd($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupManager()->add($param);
    Utils::dump("Failed to set group administrator (add group administrator), missing required parameter groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->add($param);
    Utils::dump("Set group administrator (add group administrator) successful", $result);
}
testGroupManagerAdd($RongSDK);

/**
 * Remove group administrator
 */
function testGroupManagerRemove($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupManager()->remove($param);
    Utils::dump("Failed to remove group administrator, missing required parameter userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->remove($param);
    Utils::dump("Remove group administrator successfully", $result);
}
testGroupManagerRemove($RongSDK);

/**
 * Set member information
 */
function testGroupMemberSet($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->set($param);
    Utils::dump("Failed to set group member information, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'nickname' => 'rongcloud',
        'extra' => 'xxxxxx'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->set($param);
    Utils::dump("Set group member information successfully", $result);
}
testGroupMemberSet($RongSDK);

/**
 * Exit group
 */
function testGroupMemberKick($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->kick($param);
    Utils::dump("Failed to leave the group, missing required parameter userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kick($param);
    Utils::dump("Successfully kicked out of the group", $result);
}
testGroupMemberKick($RongSDK);

/**
 * Specify the user to kick out all groups
 */
function testGroupMemberKickAll($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("Specifies that the user has failed to exit all groups, missing the required parameter userId", $result);

    $param = [
        'userId' => '111'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("Specifies the user successfully exits all groups", $result);
}
testGroupMemberKickAll($RongSDK);

/**
 * Set user-specified group special attention user
 */
function testGroupMemberFollow($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->follow($param);
    Utils::dump("Set user specified group special attention user failure, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->follow($param);
    Utils::dump("Set user-specified group to particularly focus on successful users", $result);
}
testGroupMemberFollow($RongSDK);

/**
 * Remove a specific user from the specified group's special attention list
 */
function testGroupMemberUnFollow($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->unFollow($param);
    Utils::dump("Failed to remove the specified user from the group, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->unFollow($param);
    Utils::dump("Successfully delete the specified user from the group's special attention list", $result);
}
testGroupMemberUnFollow($RongSDK);

/**
 * Query the list of members in the user-specified group with special attention
 */
function testGroupMemberGetFollowed($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("Failed to query the list of members of the specified group that the user is particularly interested in, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("Query the user-specified group's special attention member list successfully", $result);
}
testGroupMemberGetFollowed($RongSDK);

/**
 * Retrieve member information by pagination
 */
function testGroupMemberQuery($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupMember()->query($param);
    Utils::dump("Failed to get group member information due to missing required parameter groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'type' => 0,
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->query($param);
    Utils::dump("Successfully retrieved group member information for pagination", $result);
}
testGroupMemberQuery($RongSDK);

/**
 * Get specified member information
 */
function testGroupMemberSpecificQuery($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("Failed to retrieve specified member information, missing required parameter userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("Successfully obtained the specified group member information", $result);
}
testGroupMemberSpecificQuery($RongSDK);

/**
 * Set the user-specified group name as the backup name
 */
function testGroupRemarkNameSet($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->set($param);
    Utils::dump("Failed to set the user-specified group name remark, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'remarkName' => 'rongcloud'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->set($param);
    Utils::dump("Set the user-specified group name annotation successfully", $result);
}
testGroupRemarkNameSet($RongSDK);

/**
 * Set the user-specified group name annotation
 */
function testGroupRemarkNameDelete($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("Failed to set the user-specified group name annotation, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("Set the user-specified group name annotation successfully", $result);
}
testGroupRemarkNameDelete($RongSDK);

/**
 * Query the specified group name annotation
 */
function testGroupRemarkNameQuery($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("Failed to query the user-specified group name remark, missing required parameter userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("Query the user-specified group name backup note successfully", $result);
}
testGroupRemarkNameQuery($RongSDK);
