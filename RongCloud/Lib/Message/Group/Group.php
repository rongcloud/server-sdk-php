<?php

/**
 * Group message
 */

namespace RongCloud\Lib\Message\Group;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Group
{
    private $jsonPath = 'Lib/Message/Group/';

    /**
     * Request configuration file
     *
     * @var string
     */
    private $conf = '';

    /**
     * Configuration file for validation
     *
     * @var string
     */
    private $verify = '';

    /**
     * Group constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
     * @param array $Message Group message sending
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender ID
     * 'targetId'=> 'markoiwm',//Group ID
     * "objectName"=>'RC:TxtMsg',//Message type: Text
     * 'content'=>['content'=>'Hello, Xiao Ming']//Message Body
     * ];
     * @return array
     */
    public function send(array $Message = [])
    {
        $conf = $this->conf['send'];
        if (isset($Message['content']) && is_array($Message['content'])) {
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
            'targetId' => 'toGroupId'
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Group message @
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender ID
     * 'targetId'=> 'markoiwm',//Group ID
     * "objectName"=>'RC:TxtMsg',//Message type Text
     * 'content'=>[//Message content
     * 'content'=>'Hello, Xiaoming',
     * 'mentionedInfo'=>[
     * 'type'=>'1',//@ function type, 1 indicates @ all, 2 indicates @ specified users
     * 'userIds'=>['kladd', 'almmn1'],//List of @ users, required when type is 2, can be empty when type is 1
     * 'pushContent'=>'Greeting message'//Custom @ message push content
     * ]
     * ];
     * @return array
     */
    public function sendMention(array $Message = [])
    {
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $Message['content'] = isset($Message['content']) ? json_decode($Message['content'], true) : [];;
        $content = $Message['content'];
        $mentionedInfo = $content['mentionedInfo'];
        if ($mentionedInfo) {
            $Message['content']['mentionedInfo'] =  (new Utils())->rename($mentionedInfo, [
                'userIds' => 'userIdList',
            ]);
        }
        $Message['content'] = json_encode($Message['content']);
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
            'targetId' => 'toGroupId'
        ]);
        $Message['isMentioned'] = 1;
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Group status message sending
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender ID
     * 'targetId'=> 'markoiwm',//Group ID
     * "objectName"=>'RC:TxtMsg',//Message type Text
     * 'content'=>['content'=>'Hello, Xiaoming']//Message Body
     * ];
     * @return array
     */
    public function sendStatusMessage(array $Message = [])
    {
        $conf = $this->conf['sendStatusMessage'];
        if (isset($Message['content']) && is_array($Message['content'])) {
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
            'targetId' => 'toGroupId'
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Group message recall
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',// Sender ID
     * 'targetId'=> 'markoiwm',// Group ID
     * "uId"=>'5GSB-RPM1-KP8H-9JHF',// Unique message identifier
     * 'sentTime'=>'1519444243981'// Message sending time
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
        $Message['conversationType'] = ConversationType::t()['GROUP'];
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
        $conf = $this->conf['groupHistoryMsg'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'historyMsg',
            'data' => $param,
            'verify' => $this->verify['historyMsg']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $param, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
    }
}
