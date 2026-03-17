<?php
/**
 * User module - Friend profile (get user friend list, check friend relationship)
 */

require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Get user friend list
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => 'id1',  // Operator user id, required
        // 'pageToken' => 'XM2AKD1B2AH', // Page token, pass on next request the pageToken from previous response
        // 'size'      => 50,            // Page size, default 50, max 100
        // 'order'     => 0              // 0 ascending by add time, 1 descending by add time
    ];
    $result = $RongSDK->getUser()->Friend()->get($params);
    Utils::dump("Get user friend list", $result);
}
get();

/**
 * Check friend relationship between operator and target users
 */
function check()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId'    => 'id1',                  // Operator user id, required
        'targetIds' => ['id2', 'id3', 'id4'], // Target user ids to check, max 100
    ];
    $result = $RongSDK->getUser()->Friend()->check($params);
    Utils::dump("Check friend relationship", $result);
}
check();
