<?php
/**
 * Super group channel
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\BusChannel;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class BusChannel
{
    /**
 * Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/BusChannel/';

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
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add super group channel
 *
 * @param array $Group Parameters for adding a super group channel
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group ID
 * 'busChannel'=> 'busid' // Channel ID
 * 'type'=>0 // 0 Public channel, 1 Private channel
 * ];
 * @return array
 */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
 * Delete super group channel
 *
 * @param array $Group Parameters for deleting the super group channel
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group id
 * 'busChannel'=> 'busid', // Channel id, can be empty
 * ];
 * @return array
 */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
 * Query channel list
 *
 * @param
 * @return array
 */
    public function getList($groupId = "", $page = 1, $limit = 20){
        $conf = $this->conf['getList'];
        $Group = ["page"=> $page, "limit"=>$limit,"groupId"=>$groupId];
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Super group channel type switch
 *
 * @param array $Group Super group channel type switch parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid'//Channel id
 * 'type'=>0 // 0 Public channel, 1 Private channel
 * ];
 * @return array
 */
    public function change(array $Group=[]){
        $conf = $this->conf['change'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
 * Add super group private channel members
 *
 * @param array $Group Add super group private channel members parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id can be empty
 * 'members'=>[ //Add super group private channel members
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function addPrivateUsers(array $Group=[]){
        $conf = $this->conf['privateUserAdd'];
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
 * Remove private channel members
 *
 * @param array $Group Parameters for removing private channel members
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id, can be empty
 * 'members'=>[ //List of private channel members to remove
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function removePrivateUsers(array $Group=[]){
        $conf = $this->conf['privateUserRemove'];
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
 * Query private channel member list
 *
 * @param array $Group  Parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id  Can be empty
 * 'page'=> 1,
 * 'pageSize'=>1000,
 * ];
 * @return array
 */
    public function getPrivateUserList(array $Group=[]){
        $conf = $this->conf['getPrivateUsers'];
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
        return $result;
    }

}
