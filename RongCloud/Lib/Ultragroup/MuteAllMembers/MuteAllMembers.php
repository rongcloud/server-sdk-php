<?php
/**
 * // Specify a supergroup ban for all members
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\MuteAllMembers;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class MuteAllMembers
{
    /**
 * Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/MuteAllMembers/';

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
 * Set super group ban
 *
 * @param array $Group Add super group ban parameters
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group id
 * 'busChannel'=> 'busid', // Channel id can be empty
 * 'status'=> true, // Ultra group ban status true for ban 0 for cancel
 * ];
 * @return array
 */
    public function set(array $Group=[]){
        $conf = $this->conf['add'];
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

    /**
 * Query the mute status of a super group
 *
 * @param array $Group ultra group parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//super group id
 * 'busChannel'=> 'busid',//channel id can be empty
 * ];
 * @return array
 */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
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
