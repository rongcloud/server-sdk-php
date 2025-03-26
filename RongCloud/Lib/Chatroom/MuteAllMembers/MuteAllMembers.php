<?php
/**
 * Global mute in the chat room
 */
namespace RongCloud\Lib\Chatroom\MuteAllMembers;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class MuteAllMembers {

    /**
 * Chat room global mute path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/MuteAllMembers/';

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
 * MuteAllMembers constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add a global mute for the chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 * ['id'=>'seal9901']//chatroom id
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Remove global ban
 *
 * @param array $Chatroom
 * $Chatroom = [
 * ['id'=>'seal9901']//chatroom id
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
    /**
 * Global ban status check
 *
 * @param array $Chatroom
 * $Chatroom = [
 * ['id'=>'seal9901']//chatroom id
 * ];
 * @return mixed|null
 */
    public function check(array $Chatroom=[]){
        $conf = $this->conf['check'];
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get the list of global mute status for the chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 *
 * ];
 * @return mixed|null
 */
    public function getList($page = 1, $size = 50){
        $conf = $this->conf['getList'];
        $Chatroom = ["page"=>$page, "size"=>$size];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}