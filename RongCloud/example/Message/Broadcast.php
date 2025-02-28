<?php
/**
 * // Message module broadcast message
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Broadcast message recall
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'test',// Sender ID
        "objectName"=>'RC:RcCmd',// // Message type
        'content'=>json_encode([
            'uId'=>'xxxxx',// // The unique message identifier, obtained after sending a broadcast message via /push, returns the name as id.
            'isAdmin'=>'0',// // Whether it is an administrator, default is 0; when set to 1, IMKit SDK will display the gray bar as "Admin revoked a message" upon receiving this message.
            'isDelete'=>'0'// // Whether to delete the message, default is 0: when the message is revoked, the client will delete the message and replace it with a small gray bar revocation prompt message; when it is 1, after the message is deleted, it will not be replaced with a small gray bar prompt message.
        ])
    ];
    $Result = $RongSDK->getMessage()->Broadcast()->recall($message);
    Utils::dump("广播消息撤回",$Result);
}
recall();

