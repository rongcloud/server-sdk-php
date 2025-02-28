<?php
/**
 * // Chat room message whitelist
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Message {

    /**
 * // Chat room message whitelist path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Whitelist/';

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
 * Message constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'message-api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add chatroom message whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'msgs'=> ["RC:TxtMsg"]//Message type list
 * ]
 * @return array
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectnames',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete chatroom message whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'msgs'=> ["RC:TxtMsg"]//Message type list
 * ]
 * @return array
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectnames',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get the chatroom message whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 *
 * ]
 * @return array
 */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['whitlistmsgType'=>'objectNames']);

        }
        return $result;
    }
}