<?php
/**
 * Message Module
 */
namespace RongCloud\Lib\Message;

use RongCloud\Lib\Message\Chatroom\Chatroom;
use RongCloud\Lib\Message\Discussion\Discussion;
use RongCloud\Lib\Message\Group\Group;
use RongCloud\Lib\Message\Ultragroup\Ultragroup;
use RongCloud\Lib\Message\History\History;
use RongCloud\Lib\Message\Person\Person;
use RongCloud\Lib\Message\System\System;
use RongCloud\Lib\Message\Broadcast\Broadcast;
use RongCloud\Lib\Message\Expansion\Expansion;

class Message
{

    /**
 * // Create a chatroom object
 *
 * @return Chatroom
 */
    public function Chatroom(){
        return new Chatroom();
    }

    /**
 * // Create a chat room object
 *
 * @return Discussion
 */
    public function Discussion(){
        return new Discussion();
    }

    /**
 * Create a chat room object
 *
 * @return Group
 */
    public function Group(){
        return new Group();
    }

    /**
 * Create a chat room object
 *
 * @return History
 */
    public function History(){
        return new History();
    }


    /**
 * // Create a chat room object
 *
 * @return Person
 */
    public function Person(){
        return new Person();
    }

    /**
 * // Create a chat room object
 *
 * @return System
 */
    public function System(){
        return new System();
    }

    /**
 * Create a broadcast message object
 *
 * @return Broadcast
 */
    public function Broadcast(){
        return new Broadcast();
    }

    /**
 * // Create a broadcast message object
 *
 * @return Expansion
 */
    public function Expansion(){
        return new Expansion();
    }

    /**
 * // Create a supergroup message object
 *
 * @return Expansion
 */
    public function Ultragroup(){
        return new Ultragroup();
    }
}