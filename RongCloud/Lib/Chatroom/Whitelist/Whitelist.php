<?php
/**
 * 聊天室白名单
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Chatroom\Whitelist\User;
use RongCloud\Lib\Chatroom\Whitelist\Message;

class Whitelist {

    /**
     * 获取连天使白名单消息对象
     *
     * @return Message
     */
    public function Message(){
        return new Message();
    }

    /**
     * 获取连天使白名单用户对象
     *
     * @return User
     */
    public function User(){
        return new User();
    }






}