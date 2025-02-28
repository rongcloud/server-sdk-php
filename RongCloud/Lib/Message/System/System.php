<?php

/**
 * system message
 */

namespace RongCloud\Lib\Message\System;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class System
{

    /**
 * @var string System message path
 */
    private $jsonPath = 'Lib/Message/System/';

    /**
 * // Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * // Configuration file for validation
 *
 * @var string
 */
    private $verify = '';

    /**
 * // System constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
 * @param array $Message System message delivery
 * @param
 * $Message = [
 * 'senderId'=> '__system__',//Sender ID
 * 'targetId'=> 'markoiwm',//Receiver ID
 * "objectName"=>'RC:TxtMsg',//Message type Text
 * 'content'=>['content'=>'Hello, Xiao Ming']//Message Body
 * ];
 * @return array
 */
    public function send(array $Message = [])
    {
        $conf = $this->conf['send'];
        if (isset($Message['content'])) {
            $Message['content'] = json_encode($Message['content']);
        }
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
            'targetId' => 'toUserId'
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $Message Push-only Notification
 * @param
 * $Message = [
 * 'userIds'=> ["user1","user2"],//Receiver ID
 * 'notification'=> [
 * "title"=>"Title",
 * "pushContent"=>"this is a push",
 * "ios"=>
 * [
 * "thread-id"=>"223",
 * "apns-collapse-id"=>"111",
 * "extras"=> ["id"=>"1","name"=>"2"]
 * ],
 * "android"=> [
 * "hw"=>[
 * "channelId"=>"NotificationKanong",
 * "importance"=> "NORMAL",
 * "image"=>"https://example.com/image.png"
 * ],
 * "mi"=>[
 * "channelId"=>"rongcloud_kanong",
 * "large_icon_uri"=>"https=>//example.com/image.png"
 * ],
 * "oppo"=>[
 * "channelId"=>"rc_notification_id"
 * ],
 * "vivo"=>[
 * "classification"=>"0"
 * ],
 * "extras"=> ["id"=> "1","name"=> "2"]
 * ]
 * ]
 * ];
 * @return array
 */
    public function pushUser(array $Message = [])
    {
        $conf = $this->conf['pushUser'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['pushUser']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $Message, "json");
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $Message System broadcast message
 * @param
 * $Message = [
 * 'senderId'=> '__system__',//Sender ID
 * "objectName"=>'RC:TxtMsg',//Message type
 * 'content'=>['content'=>'Hello, Xiao Ming']//Message content
 * ];
 * @return array
 */
    public function broadcast(array $Message = [])
    {
        $conf = $this->conf['broadcast'];
        if (isset($Message['content'])) {
            $Message['content'] = json_encode($Message['content']);
        }
        $verify = $this->verify['broadcast'];
        if (isset($verify['targetId'])) {
            unset($verify['targetId']);
        }
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $verify
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Broadcast to online users
 *
 * @param array $Message
 * @param
 * $Message = [
 * 'senderId'=> '__system__',//Sender ID
 * "objectName"=>'RC:TxtMsg',//Message type
 * 'content'=>['content'=>'Hello, Xiaoming']//Message content
 * ];
 * @return array
 */
    public function onlineBroadcast(array $Message = [])
    {
        $conf = $this->conf['onlineBroadcast'];
        if (isset($Message['content'])) {
            $Message['content'] = json_encode($Message['content']);
        }
        $verify = $this->verify['broadcast'];
        if (isset($verify['targetId'])) {
            unset($verify['targetId']);
        }
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $verify
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $bodyParameter = (new Request())->getQueryFields($Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }
    /**
 * @param array $Message System template message
 * @param
 * $Message = [
 * 'senderId'=> '__system__', // Sender ID
 * 'objectName'=>'RC:TxtMsg', // Message type: Text
 * 'template'=>['content'=>'{name}, language score {score} points'], // Template content
 * 'content'=>[
 * 'sea9901'=>[ // Recipient ID
 * 'data'=>['{name}'=>'Xiao Ming','{score}'=>'90'], // Template data
 * 'push'=>'{name} your score is out', // Push notification content
 * ],
 * 'sea9902'=>[ // Recipient ID
 * 'data'=>['{name}'=>'Xiao Hong','{score}'=>'95'], // Template data
 * 'push'=>'{name} your score is out', // Push notification content
 * ]
 * ]
 * ];
 * @return array
 */
    public function sendTemplate(array $Message = [])
    {
        $conf = $this->conf['sendTemplate'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['tplMsg']
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
        ]);
        $Message['content'] = isset($Message['content']) ? json_decode($Message['content'], true) : [];
        $newMessage = [
            'fromUserId' => $Message['fromUserId'],
            'objectName' => $Message['objectName'],
            "content" => $Message['template'],
        ];
        foreach ($Message['content'] as $userId => $v) {
            $newMessage['toUserId'][] = $userId;
            $newMessage['values'][] = $v['data'];
            $newMessage['pushData'][] = isset($v['pushData']) ? $v['pushData'] : '';
            $newMessage['pushContent'][] = $v['push'];
        }

        $result = (new Request())->Request($conf['url'], $newMessage, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
