<?php

/**
 * Two-person message
 */

namespace RongCloud\Lib\Message\Person;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Person
{

    /**
     * @var string Path for two-person messaging
     */
    private $jsonPath = 'Lib/Message/Person/';

    /**
     * Request configuration file
     *
     * @var string
     */
    private $conf = '';

    /**
     * Configuration file for verification
     *
     * @var string
     */
    private $verify = '';

    /**
     * Person constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
     * @param array $Message Two-person message sending
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha',//Sender ID
     * 'targetId'=> 'markoiwm',//Recipient ID
     * "objectName"=>'RC:TxtMsg',//Message type: Text
     * 'content'=>['content'=>'Hello, Xiaoming']//Message Body
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
            'targetId' => 'toUserId'
        ]);
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Send different content messages to multiple users
     * @param
     * $Message = [
     * 'senderId'=> 'kamdnq', // Sender ID
     * 'objectName'=>'RC:TxtMsg', // Message type: text
     * 'template'=>['content'=>'{name}, language score {score} points'], // Template content
     * 'content'=>[
     * 'sea9901'=>[ // Recipient ID
     * 'data'=>['{name}'=>'Xiao Ming','{score}'=>'90'], // Template data
     * 'push'=>'{name}, your score is out', // Push notification content
     * ],
     * 'sea9902'=>[ // Recipient ID
     * 'data'=>['{name}'=>'Xiao Hong','{score}'=>'95'], // Template data
     * 'push'=>'{name}, your score is out', // Push notification content
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
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId' => 'fromUserId',
        ]);
        $newMessage = [
            'fromUserId' => $Message['fromUserId'],
            'objectName' => $Message['objectName'],
            "content" => $Message['template'],
        ];
        $Message['content'] = isset($Message['content']) ? json_decode($Message['content'], true) : [];
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
    /**
     * @param array $Message Two-person status message sending
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha', // Sender ID
     * 'targetId'=> 'markoiwm', // Receiver ID
     * "objectName"=>'RC:TxtMsg', // Message type: Text
     * 'content'=>['content'=>'Hello, Xiao Ming'] // Message Body
     * ];
     * @return array
     */
    public function sendStatusMessage(array $Message = [])
    {
        $conf = $this->conf['sendStatusMessage'];
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
     * @param array $Message Two-person message recall
     * @param
     * $Message = [
     * 'senderId'=> 'ujadk90ha', // Sender ID
     * 'targetId'=> 'markoiwm', // Receiver ID
     * "uId"=>'5GSB-RPM1-KP8H-9JHF', // Message unique identifier
     * 'sentTime'=>'1519444243981' // Sending time
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
        $Message['conversationType'] = ConversationType::t()['PRIVATE'];
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
        $conf = $this->conf['privateHistoryMsg'];
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
