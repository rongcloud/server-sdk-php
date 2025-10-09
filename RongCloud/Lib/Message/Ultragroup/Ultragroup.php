<?php
/**
 * Supergroup Message
 */
namespace RongCloud\Lib\Message\Ultragroup;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Ultragroup {
    private $jsonPath = 'Lib/Message/Ultragroup/';

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
 *
 */
    private $verify = '';

    /**
 * Group constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * @param array $Message Supergroup message sending
 * @param
 * $Message = [
 * 'senderId'=> 'ujadk90ha',//Sender ID
 * 'targetId'=> ['markoiwm'],//Supergroup ID, up to three can be sent simultaneously
 * "objectName"=>'RC:TxtMsg',//Message type, text
 * 'content'=>['content'=>'Hello, Xiao Ming']//Message Body
 * ];
 * @return array
 */
    public function send(array $Message=[]){
        $conf = $this->conf['send'];
        if(isset($Message['content']) && is_array($Message['content'])){
            $Message['content'] = json_encode($Message['content']);
        }
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toGroupIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Message, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $Message Super group message @
 * @param
 * $Message = [
 * 'senderId'=> 'ujadk90ha', // Sender ID
 * 'targetId'=> ["markoiwm"], // Super group ID
 * "objectName"=>'RC:TxtMsg', // Message type: text
 * 'content'=>[ // Message content
 * 'content'=>'Hello, Xiao Ming',
 * 'mentionedInfo'=>[
 * 'type'=>'1', // @ function type, 1 represents @ all, 2 represents @ specified users
 * 'userIds'=>['kladd', 'almmn1'], // List of @ users, required when type is 2, can be empty when type is 1
 * 'pushContent'=>'Greeting message' // Custom @ message push content
 * ]
 * ];
 * @return array
 */
    public function sendMention(array $Message=[]){
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];;
        $content = $Message['content'];
        $mentionedInfo = $content['mentionedInfo'];
        if($mentionedInfo){
            $Message['content']['mentionedInfo'] =  (new Utils())->rename($mentionedInfo, [
                'userIds'=> 'userIdList',
            ]);
        }
        $Message['content'] = json_encode($Message['content']);
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toGroupIds'
        ]);
        $Message['isMentioned'] = 1;
        $result = (new Request())->Request($conf['url'],$Message, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $Message Supergroup message recall
 * @param
 * $Message = [
 * 'senderId'=> 'ujadk90ha', // Sender Id
 * 'targetId'=> 'markoiwm', // Supergroup Id
 * "uId"=>'5GSB-RPM1-KP8H-9JHF', // Unique identifier of the message
 * 'sentTime'=>'1519444243981' // Timestamp of the message
 * ];
 * @return array
 */
    public function recall(array $Message=[]){
        $conf = $this->conf['recall'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'uId'=> 'messageUID'
        ]);
        $Message['conversationType'] = ConversationType::t()['ULTRAGROUP'];
        $result = (new Request())->Request($conf['url'],$Message);
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
        $conf = $this->conf['ultraGroupHistoryMsg'];
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