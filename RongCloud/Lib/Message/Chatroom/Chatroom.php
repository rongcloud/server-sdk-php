<?php

/**
 * Chat room message
 */

namespace RongCloud\Lib\Message\Chatroom;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
use RongCloud\Lib\ConversationType;

class Chatroom
{
    private $jsonPath = 'Lib/Message/Chatroom/';

    /**
     * Request configuration file
     *
     * @var string
     */
    private $conf = '';

    /**
     * Verify configuration file
     *
     * @var string
     */
    private $verify = '';

    /**
     * Chatroom constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
     * @param array $Message Chat room message sending
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',// Sender ID
     * 'targetId'=> 'kkj9o01',// Chat room ID
     * "objectName"=>'RC:TxtMsg',// Message type - text
     * 'content'=>['content'=>'Hello, host']// Message content
     * ];
     * @return array
     */
    public function send(array $Message = [])
    {
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
            'targetId' => 'toChatroomId'
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Chatroom broadcast message
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender ID
     * "objectName"=>'RC:TxtMsg',//Message type: text
     * 'content'=>['content'=>'Hello, host']//Message content
     * ];
     * @return array
     */
    public function broadcast(array $Message = [])
    {
        $conf = $this->conf['broadcast'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
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
     * @param array $Message Chat room message recall
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender Id
     * 'targetId'=> 'markoiwm',//Chat room Id
     * "uId"=>'5GSB-RPM1-KP8H-9JHF',//Unique identifier of the message
     * 'sentTime'=>'1519444243981'//Message sending time
     * ];
     * @return array
     */
    public function recall(array $Message = [])
    {
        $conf = $this->conf['recall'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
            'uId' => 'messageUID'
        ]);
        $Message['conversationType'] = ConversationType::t()['CHATROOM'];
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * getHistoryMsg
     *
     * @param array $param = [
     * 'userId'=> 'ujadk90ha', 
     * 'targetId'=> 'markoiwm', 
     * "startTime"=> 1759130000000, 
     * 'endTime'=> 1759140981000,
     * 'includeStart'=> true
     * ];
     * @return array
     */
    public function getHistoryMsg(array $param = [])
    {
        $conf = $this->conf['chatroomHistoryMsg'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'historyMsg',
            'data' => $param,
            'verify' => $this->verify['historyMsg']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $param, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
