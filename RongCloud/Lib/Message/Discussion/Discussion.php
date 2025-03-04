<?php
/**
 * Discussion group message
 */
namespace RongCloud\Lib\Message\Discussion;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Discussion {
    private $jsonPath = 'Lib/Message/Discussion/';

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
 * Discussion constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * @param array $Message Discussion group message sending
 * @param
 * $Message = [
 * 'senderId'=> 'ujadk90ha',//Sender ID
 * 'targetId'=> ['kkj9o01'],//Discussion group, multiple IDs
 * "objectName"=>'RC:TxtMsg',//Message type Text
 * 'content'=>json_encode(['content'=>'Hello, host'])//Message Body
 * ];
 * @return array
 */
    public function send($Message){
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toChatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $Message Discussion group broadcast message
 * @param
 * $Message = [
 * 'senderId'=> 'ujadk90ha',//Sender ID
 * "objectName"=>'RC:TxtMsg',//Message type: text
 * 'content'=>json_encode(['content'=>'Hello, host']) //Message Body
 * ];
 * @return array
 */
    public function broadcast($Message){
        $conf = $this->conf['broadcast'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}