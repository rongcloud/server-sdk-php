<?php
/**
 * Chatroom allowlist
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Chatroom\Whitelist\User;
use RongCloud\Lib\Chatroom\Whitelist\Message;

class Whitelist {

    /**
 * // Get the whitelist message object for LianTian
 *
 * @return Message
 */
    public function Message(){
        return new Message();
    }

    /**
 * // Get the User object for the whitelist user in LianTian
 *
 * @return User
 */
    public function User(){
        return new User();
    }






}