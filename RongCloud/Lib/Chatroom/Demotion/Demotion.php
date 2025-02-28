<?php
/**
 * // Chat room message downgrade
 */
namespace RongCloud\Lib\Chatroom\Demotion;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Demotion {

    /**
 * // Chat room message degradation path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Demotion/';

    /**
 * // Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * Validation configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Demotion constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add application in-chat room downgrade message
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// Message type list
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'demotion',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectName',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Remove in-app chatroom downgrade messages
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// Message type list
 * ];
 * @return mixed|null
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'demotion',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectName',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get the downgrade message of the in-app chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 *
 * ];
 * @return mixed|null
 */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}