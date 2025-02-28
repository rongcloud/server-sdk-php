<?php
/**
 * // Super group ban
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\Gag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Gag
{
    /**
 * // Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/Gag/';

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
 * // Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 *  Add super group ban
 *
 * @param array $Group Parameters for adding super group ban
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group ID
 * 'busChannel'=> 'busid', // Channel ID (can be empty)
 * 'members'=>[ // List of banned members
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
 *  Unblock
 *
 * @param array $Group Unblock parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Super group id
 * 'busChannel'=> 'busid',//Channel id can be empty
 * 'members'=>[ //Unblock member list
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
 * Query the list of banned members
 *
 * @param array $Group Parameters for lifting the ban
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group id
 * 'busChannel'=> 'busid', // Channel id, can be empty
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
            foreach ($result['members']?:[] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

}
