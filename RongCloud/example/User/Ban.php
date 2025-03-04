<?php

/**
 * User module whitelist instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Set user single chat ban
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => ['kkj9o01', 'kkj9o02'],  // Banned user Ids, supports batch setting, with a maximum of no more than 1000.
        'state' => 1,                    // Forbidden status, 0 Remove forbidden. 1 Add forbidden
        'type' => 'PERSON',              // conversation type, currently supports single conversation PERSON
    ];
    $res = $RongSDK->getUser()->Ban()->set($user);
    Utils::dump("Set user mute status", $res);
}
set();

/**
 * Query the list of users with single chat ban remarks
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'num'       => 101,     // Get the number of rows, default is 100, maximum support is 200.
        'offset'    => 0,       // The starting position for the query, default is 0.
        'type'      => 'PERSON'//  Conversation type, currently supports single conversation PERSON.
    ];
    $res = $RongSDK->getUser()->Ban()->getList($param);
    Utils::dump("Query the list of users banned from single chat", $res);
}
getList();
