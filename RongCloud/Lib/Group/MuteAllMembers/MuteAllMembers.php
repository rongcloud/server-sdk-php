<?php
/**
 * Specify the group-wide member ban
 * @author hejinyu
 */
namespace RongCloud\Lib\Group\MuteAllMembers;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class MuteAllMembers
{
    /**
 * Group module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Group/MuteAllMembers/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Validate configuration file
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
 * Add group ban
 *
 * @param array $Group Parameters for adding group ban
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//group id
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
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unblock users
 *
 * @param array $Group Unblock users parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//  Group ID
 * 'members'=>[//  List of users to unblock
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
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of banned members
 *
 * @param array $Group Unban parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//group id
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
        return $result;
    }

}
