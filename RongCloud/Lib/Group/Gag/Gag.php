<?php
/**
 * Group Mute
 * @author hejinyu
 */
namespace RongCloud\Lib\Group\Gag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Gag
{
    /**
 * Group module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Group/Gag/';

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
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add group mute
 *
 * @param array $Group Add group mute parameters
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//Group ID
 * 'members'=>[ //Muted members list
 * ['id'=> 'ujadk90ha']
 * ]
 * ,
 * 'minute'=>50  //\tMute duration in minutes
 * ];
 * @return array
 */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $verify = array_merge($verify , ['minute'=>$this->verify['minute']]);
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
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unblock
 *
 * @param array $Group Unblock parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',// Group id
 * 'members'=>[ // Unblock members list
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
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of banned members
 *
 * @param array $Group Parameters for unbanning
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
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members']?:[] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

}
