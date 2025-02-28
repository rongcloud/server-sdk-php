<?php
/**
 * Conversation Module
 * conversation=> hejinyu
 * Date=> 2018/7/23
 * Time=> 11=>41
 */
namespace RongCloud\Lib\Conversation;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Conversation
{
    /**
 * // Session module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Conversation/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * // Configuration file for validation
 *
 * @var string
 */
    private $verify = '';

    /**
 * // Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 *  Screen Session Push
 *
 * @param array $Conversation Screen session push parameters
 * @param
 * $Conversation = [
 * 'type'=> 'PRIVATE',//Session type: PRIVATE, GROUP, DISCUSSION, SYSTEM
 * 'userId'=>'mka091amn',//Session owner
 * 'targetId'=>'adm1klnm'//Session ID
 * ];
 * @return array
 */
    public function mute(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'conversation',
                    'data'=> $Conversation,
                    'verify'=> $this->verify['conversation']
                ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 1;
        $Conversation = (new Utils())->rename($Conversation, [
                'type'=> 'conversationType',
                'userId'=> 'requestId'
            ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Receive Conversation Push
 *
 * @param array $Conversation Parameters for receiving Conversation Push
 * @param
 * $Conversation = [
 * 'type'=> 'PRIVATE',//Conversation type PRIVATE, GROUP, DISCUSSION, SYSTEM
 * 'userId'=>'mka091amn',//Conversation owner
 * 'targetId'=>'adm1klnm'//Conversation id
 * ];
 * @return array
 */
    public function unmute(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'conversation',
            'data'=> $Conversation,
            'verify'=> $this->verify['conversation']
        ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 0;
        $Conversation = (new Utils())->rename($Conversation, [
            'type'=> 'conversationType',
            'userId'=> 'requestId'
        ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get the conversation state without interruption
 *
 * @param array $Conversation Receive conversation Push parameters
 * @param
 * $Conversation = [
 * 'type'=> 'PRIVATE',// Conversation type PRIVATE, GROUP, DISCUSSION, SYSTEM
 * 'userId'=>'mka091amn',// Conversation owner
 * 'targetId'=>'adm1klnm'// Conversation id
 * ];
 * @return array
 */
    public function get(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'conversation',
            'data'=> $Conversation,
            'verify'=> $this->verify['conversation']
        ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 0;
        $Conversation = (new Utils())->rename($Conversation, [
            'type'=> 'conversationType',
            'userId'=> 'requestId'
        ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }


}