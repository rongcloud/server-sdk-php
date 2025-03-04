<?php
/**
 * Group annotation
 */
namespace RongCloud\Lib\Group\Remark;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Remark {

    /**
 * Group module group backup
 *
 * @var string
 */
    private $jsonPath = 'Lib/Group/Remark/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Verify configuration file
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
 * Add group remark
 *
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'userId',//User ID
 * 'groupId'=> 'groupId',//Group ID
 * 'remark'=> 'Remark'//Group remark
 * ];
 * @return array
 */
    public function set(array $Group=[]){
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete group remark
 *
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1',//User ID
 * 'groupId'=> 'targetUserid'//Group ID
 * ];
 * @return array
 */
    public function del(array $Group=[]){
        $conf = $this->conf['del'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get group annotation
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1',//User ID
 * 'groupId'=> 'groupId'//Group ID
 * ];
 * @return array
 * @return  array
 */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}