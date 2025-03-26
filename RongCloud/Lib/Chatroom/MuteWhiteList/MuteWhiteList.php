<?php
/**
 * Global chat room ban
 */
namespace RongCloud\Lib\Chatroom\MuteWhiteList;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class MuteWhiteList {

    /**
 * Chatroom global mute path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/MuteWhiteList/';

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
 * MuteWhiteList constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add a chatroom-wide mute whitelist
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'members'=> [
 * ['id'=>'seal9901']// member id
 * ],
 * 'id'=>"chatroomId"// chatroom id
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members'],'id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Chatroom['members'] as &$v){
            $v = $v['id'];
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'members'=>'userId',
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Remove all banned members from the chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'members'=> [
 * ['id'=>'seal9901']//member id
 * ],
 * 'id'=>"chatroomId"//chatroom id
 * ];
 * @return mixed|null
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members'],"id"=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Chatroom['members'] as &$v){
            $v = $v['id'];
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'members'=>'userId',
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get the chatroom's global ban whitelist
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=>"chatroomId"//Chatroom ID
 * ];
 * @return mixed|null
 */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $verify = $this->verify['chatroom'] ;
        $verify = ["id"=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}