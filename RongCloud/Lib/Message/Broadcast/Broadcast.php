<?php
/**
 * Broadcast message
 */
namespace RongCloud\Lib\Message\Broadcast;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Broadcast {

    /**
 * @var string The path of the broadcast message
 */
    private $jsonPath = 'Lib/Message/Broadcast/';

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
 * System constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * @param array $Message Broadcast message recall
 * @param
 * $message = [
 * 'senderId'=> 'test',//  Sender ID
 * "objectName"=>'RC:RcCmd',//  Message type
 * 'content'=>[
 * 'uId'=>'xxxxx',//  Unique message identifier, obtained after sending a broadcast message via /push, returned as id.
 * 'type'=>'SYSTEM',//  System session
 * 'isAdmin'=>'0',//  Whether it is an administrator, default is 0; when set to 1, the IMKit SDK will display a gray bar as "Admin recalled a message" upon receiving this message.
 * 'isDelete'=>0]//  Whether to delete the message, default is 0. When recalling this message, the client will delete it and replace it with a gray bar recall prompt message; when set to 1, the message will be deleted without being replaced by a gray bar prompt message.
 * ];
 * @return array
 */
    public function recall(array $Message=[]){
        $conf = $this->conf['broadcast'];
        $verify = $this->verify['broadcast'];
        if(isset($verify['targetId'])){
            unset($verify['targetId']);
        }
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];
        $content = $Message['content'];
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $content = (new Utils())->rename($content , [
            'uId'=>'messageUId'
        ]);
        $content['conversationType'] = 6;
        $Message['content'] = json_encode($content);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

}