<?php
/**
 * // Banned user relationship
 */
namespace RongCloud\Lib\User\Tag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Tag {

    /**
 * User module User label
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Tag/';

    /**
 * // Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * // Configuration file for validation
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
 * Add user tags
 *
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1',//User ID
 * 'tags'=> ['Tag1','Tag2']//User tags
 * ];
 * @return array
 */
    public function set(array $User=[]){
        $conf = $this->conf['setTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['tag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Batch add user tags
 *
 * @param array $User
 * @param
 * $User = [
 * 'userIds'=> ['ujadk90ha1','ujadk90ha1'],//User ID list
 * 'tags'=> ['Tag1','Tag2']//User tags
 * ];
 * @return array
 */
    public function batchset(array $User=[]){
        $conf = $this->conf['batchSetTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['batchTag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get user tags
 * @param array $User
 * @param
 * $User = [
 * 'userIds'=> ['ujadk90ha1','ujadk90ha1'],//User ID list
 * ];
 * @return array
 * @return  array
 */
    public function get(array $User=[]){
        $conf = $this->conf['getTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['getTag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}