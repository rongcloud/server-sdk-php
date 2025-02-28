<?php
/**
 * // Chatroom member banned words
 */
namespace RongCloud\Lib\User\MuteChatrooms;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class MuteChatrooms {

    /**
 * // Chat room member banned path
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/MuteChatrooms/';

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
 * // Gag constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Add member mute
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'members'=> [
 * ['id'=>'seal9901']//Muted member id
 * ],
 * 'minute'=>30//Mute duration
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members'],'minute'=>$verify['minute']];
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
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Unban chatroom members
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'members'=> [
 * ['id'=>'seal9901']// member id
 * ]
 * ];
 * @return mixed|null
 */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members']];
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
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get the list of banned members in a chatroom
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
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members'] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }
}