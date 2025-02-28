<?php
/**
 * // Chatroom member ban speech
 */
namespace RongCloud\Lib\Chatroom\Gag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Gag {

    /**
 * // Chatroom member ban path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Gag/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * // Verify configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Gag constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * // Add member mute
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha', // Chatroom ID
 * 'members'=> [
 * ['id'=>'seal9901'] // Muted member ID
 * ],
 * 'minute'=>30 // Mute duration in minutes
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members'],'minute'=>$verify['minute']];
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unmute chatroom members
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//Chatroom id
 * 'members'=> [
 * ['id'=>'seal9901']//Member id
 * ]
 * ];
 * @return mixed|null
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
 * Get the list of banned members in a chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//chatroom id
 * ];
 * @return mixed|null
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members'] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }
}