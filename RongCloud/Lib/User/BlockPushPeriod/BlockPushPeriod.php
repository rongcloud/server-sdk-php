<?php
/**
 * User non-disturbance time period
 */
namespace RongCloud\Lib\User\BlockPushPeriod;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class BlockPushPeriod {

    /**
 * User quiet hours path
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/BlockPushPeriod/';

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
 * User constructor.
 */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add a do-not-disturb time period
 *
 * @param array $User Parameters for the banned user
 * @param
 * $User = [
 * 'id'=> 'ujadk90ha1', // User ID, unique identifier, maximum length 30 characters
 * 'startTime'=> "23:59:59" // Start time of do-not-disturb
 * 'period' => 50, // Do-not-disturb duration in minutes, calculated from the start time
 * 'level' => 1 // 1: Only notify for single chats and @ messages, including messages @ specific users and @ everyone. 5: Do not receive notifications, even for @ messages
 * ];
 * @return array
 */
    public function add(array $User=[]){
        $conf = $this->conf['add'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['user']
        ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
        ]);
        if(!isset($User['level'])){
            $User['level'] = 1;
        }
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete user's do-not-disturb time period
 *
 * @param array $User
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',//User ID, unique identifier, maximum length 30 characters
 * ];
 * @return array
 */
    public function remove(array $User=[]){
        $conf = $this->conf['remove'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['user']
        ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get user's do-not-disturb time period
 *
 * @param array $User
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',//User ID, unique identifier, maximum length 30 characters
 * ];
 * @return  array
 */
    public function getList(array $User=[]){
        $conf = $this->conf['getList'];
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}