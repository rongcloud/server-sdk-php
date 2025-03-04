<?php
/**
 * Session module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testConversation($RongSDK){
    $Conversation = $RongSDK->getConversation();
    $params = [
        'type'=> 'PRIVATE',// Session types PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'mka091amn',// Session Owner
        'targetId'=>'adm1klnm'// session id
    ];
    Utils::dump("Set user's session screen push success",$Conversation->mute($params));

    Utils::dump("Set the user's session screen push type error",$Conversation->mute());

    $params = [
        'type'=> 'PRIVATE',// Conversation types PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'mka091amn',// Session owner
        'targetId'=>'adm1klnm'// Session ID
    ];
    Utils::dump("Set the user's session to successfully receive Push",$Conversation->unmute($params));

    Utils::dump("Set the user's session to receive Push type errors",$Conversation->unmute());

}

testConversation($RongSDK);


