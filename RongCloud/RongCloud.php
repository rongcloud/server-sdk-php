<?php
/**
 * RongCloud server SDK
 */
namespace RongCloud;

use RongCloud\Lib\Chatroom\Chatroom;
use RongCloud\Lib\Conversation\Conversation;
use RongCloud\Lib\Group\Group;
use RongCloud\Lib\Ultragroup\Ultragroup;
use RongCloud\Lib\Message\Message;
use RongCloud\Lib\Sensitive\Sensitive;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Push\Push;
use RongCloud\Lib\Entrust\Entrust;

error_reporting(0);
if (!defined('RONGCLOUOD_ROOT')) {
    define('RONGCLOUOD_ROOT', dirname(__FILE__) . '/');
    require('Autoloader.php');
}

// Whether to enable domain name switching true to enable (default) false to disable
if (!defined('RONGCLOUOD_DOMAIN_CHANGE')) {
    define('RONGCLOUOD_DOMAIN_CHANGE', true);
}

class RongCloud
{
    /**
 * Application appkey
 *
 * @var string
 */
    public static $appkey;

    /**
 * Application appSecret
 *
 * @var string
 */
    public static $appSecret;

    /**
 * Global data center API address, default to domestic data center
 *
 * @var string
 */
    public static $apiUrl;

    /**
 * CURLOPT_CONNECTTIMEOUT
 *
 * @var int
 */
    public static $connectTimeout = 20;

    /**
 * CURLOPT_TIMEOUT
 *
 * @var int
 */
    public static $timeout = 30;


    /**
 * User object
 *
 * @var  User
 */
    public $_user;

    /**
 * Message Object
 *
 * @var Message
 */
    public $_message;

    /**
 * Group object
 *
 * @var Group
 */
    public $_group;

    /**
 * Ultragroup Object
 *
 * @var Ultragroup
 */
    public $_ultragroup;

    /**
 * Conversation object
 *
 * @var Conversation
 */
    public $_conversation;

    /**
 * Chatroom object
 *
 * @var Chatroom
 */
    public $_chatroom;

    /**
 * Sensitive object
 *
 * @var Sensitive
 */
    public $_sensitive;

    /**
 * Push module object
 *
 * @var Push
 */
    public $_push;


    /**
 * Information Escrow Module Object
 *
 * @var Entrust
 */
    public $_entrust;
    

    /**
 * RongCloud constructor.
 * @param string $appKey Entity appKey application key
 * @param string $appSecret Entity appSecret application secret
 */
    public function __construct($appKey="",$appSecret="",$apiUrl="")
    {
        // Set key and secret
        if($appKey){
            self::$appkey = $appKey;
            self::$appSecret = $appSecret;
        }
        if($apiUrl) self::$apiUrl = $apiUrl;
        // Create User
        $this->_user = new User();

        // Create Group
        $this->_group = new Group();

        // Create Chatroom
        $this->_chatroom = new Chatroom();

        // Create Conversation
        $this->_conversation= new Conversation();

        // Create Message
        $this->_message = new Message();

        // Create Sensitive
        $this->_sensitive= new Sensitive();

        // Create Push
        $this->_push= new Push();

        // Create Ultragroup
        $this->_ultragroup = new Ultragroup();

        // Create Entrust
        $this->_entrust = new Entrust();
    }

    /**
 * Retrieve the user object
 *
 * @return User
 */
    public function getUser(){
        return $this->_user;
    }

    /**
 * Get the message object
 *
 * @return Message
 */
    public function getMessage(){
        return $this->_message;
    }

    /**
 * Get the group object
 *
 * @return Group
 */
    public function getGroup(){
        return $this->_group;
    }

    /**
 * Get the chatroom object
 *
 * @return Chatroom
 */
    public function getChatroom(){
        return $this->_chatroom;
    }

    /**
 * Get the conversation object
 *
 * @return Conversation
 */
    public function getConversation(){
        return $this->_conversation;
    }

    /**
 * Get sensitive word object
 *
 * @return Sensitive
 */
    public function getSensitive(){
        return $this->_sensitive;
    }

    /**
 * Get the push object
 *
 * @return Push
 */
    public function getPush(){
        return $this->_push;
    }

    /**
 * Get the ultragroup object
 *
 * @return Ultragroup
 */
    public function getUltragroup(){
        return $this->_ultragroup;
    }

    /**
 * Get the information entrust object
 *
 * @return Entrust
 */
    public function getEntrust(){
        return $this->_entrust;
    }

}