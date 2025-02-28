<?php
/**
 * // Chat room user whitelist
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class User {

    /**
 * // Chat room whitelist user module path
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
 * // Configuration file for verification
 *
 * @var string
 */
    private $verify = '';

    /**
 * // Keepalive constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'user-api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Add chatroom user whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=> "chatroom1", // Chatroom ID
 * 'members'=>['abc','abcd'] // User list
 * ]
 * @return array
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members']];
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
            'id'=>'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Remove chatroom user whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=> "chatroom1",//chatroom id
 * 'members'=>['abc','abcd']//user list
 * ]
 * @return array
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members']];
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
            'id'=>'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get the chatroom user whitelist
 *
 * @param $Chatroom
 * $Chatroom = [
 *
 * ]
 * @return array
 */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
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
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members'] as $k=>$v){
                $result['members'][$k] = ['id'=>$v];
            }

        }
        return $result;
    }
}