<?php
/**
 * Super group ban whitelist
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\MuteWhiteList;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class MuteWhiteList
{
    /**
 * Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/MuteWhiteList/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Validation configuration file
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
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add super group mute whitelist
 *
 * @param array $Group Add super group mute whitelist parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//super group id
 * 'busChannel'=> 'busid',//channel id can be empty
 * 'members'=>[ //mute member list
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unblock whitelist
 *
 * @param array $Group Unblock whitelist parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id, can be empty
 * 'members'=>[ //List of unblocked members
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the forbidden word whitelist member list
 *
 * @param array $Group  Parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id  Can be empty
 * ];
 * @return array
 */
    public function getList(array $Group=[]){
        $conf = $this->conf['getList'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
        }
        return $result;
    }

}
