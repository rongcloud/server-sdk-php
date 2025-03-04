<?php
/**
 * Chatroom Keepalive
 */
namespace RongCloud\Lib\Chatroom\Keepalive;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Keepalive {

    /**
 * Chat room keep-alive path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Keepalive/';

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
 * Keepalive constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add a chatroom for live chat
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//  chatroom id
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id'=>'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete chatroom
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//chatroom id
 * ];
 * @return mixed|null
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id'=>'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get the chatroom for preserving
 *
 * @param $Chatroom
 * $Chatroom = [
 *
 * ];
 * @return mixed|null
 */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200 || $result['code'] == 0){
            $result = (new Utils())->rename($result,['chatroomIds'=>'chatrooms']);
            $result['code'] = 200;
        }
        return $result;
    }
}