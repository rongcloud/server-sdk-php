<?php
/**
 * 融云 server sdk
 */
namespace RongCloud;

use RongCloud\Lib\Chatroom\Chatroom;
use RongCloud\Lib\Conversation\Conversation;
use RongCloud\Lib\Group\Group;
use RongCloud\Lib\Message\Message;
use RongCloud\Lib\Sensitive\Sensitive;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Push\Push;

error_reporting(0);
if (!defined('RONGCLOUOD_ROOT')) {
    define('RONGCLOUOD_ROOT', dirname(__FILE__) . '/');
    require('Autoloader.php');
}

class RongCloud
{
    /**
     * 应用 appkey
     *
     * @var string
     */
    public static $appkey;

    /**
     * 应用 appSecret
     *
     * @var string
     */
    public static $appSecret;

    /**
     * 海外数据中心 api 地址 ，默认为国内数据中心
     *
     * @var string
     */
    public static $apiUrl;

    /**
     * 用户对象
     *
     * @var  User
     */
    public $_user;

    /**
     * 消息对象
     *
     * @var Message
     */
    public $_message;

    /**
     * 群组对象
     *
     * @var Group
     */
    public $_group;

    /**
     * 会话对象
     *
     * @var Conversation
     */
    public $_conversation;

    /**
     * 聊天室对象
     *
     * @var Chatroom
     */
    public $_chatroom;

    /**
     * 敏感词对象
     *
     * @var Sensitive
     */
    public $_sensitive;

    /**
     * 推送模块对象
     *
     * @var Push
     */
    public $_push;

    /**
     * RongCloud constructor.
     * @param string $appKey 实体 appKey 应用 key
     * @param string $appSecret 实体 appSecret 应用 秘钥
     */
    public function __construct($appKey="",$appSecret="",$apiUrl="")
    {
        //设置 key 和秘钥
        if($appKey){
            self::$appkey = $appKey;
            self::$appSecret = $appSecret;
        }
        if($apiUrl) self::$apiUrl = $apiUrl;
        //创建 User
        $this->_user = new User();

        //创建 Group
        $this->_group = new Group();

        //创建 Chatroome
        $this->_chatroom = new Chatroom();

        //创建 Conversation
        $this->_conversation= new Conversation();

        //创建 Message
        $this->_message = new Message();

        //创建 Sensitive
        $this->_sensitive= new Sensitive();

        //创建 Push
        $this->_push= new Push();
    }

    /**
     * 获取用户对象
     *
     * @return User
     */
    public function getUser(){
        return $this->_user;
    }

    /**
     * 获取消息对象
     *
     * @return Message
     */
    public function getMessage(){
        return $this->_message;
    }

    /**
     * 获取群组对象
     *
     * @return Group
     */
    public function getGroup(){
        return $this->_group;
    }

    /**
     * 获取聊天室对象
     *
     * @return Chatroom
     */
    public function getChatroom(){
        return $this->_chatroom;
    }

    /**
     * 获取会话对象
     *
     * @return Conversation
    */
    public function getConversation(){
        return $this->_conversation;
    }

    /**
     * 获取敏感词对象
     *
     * @return Sensitive
     */
    public function getSensitive(){
        return $this->_sensitive;
    }

    /**
     * 获取推送对象
     *
     * @return Push
     */
    public function getPush(){
        return $this->_push;
    }
}