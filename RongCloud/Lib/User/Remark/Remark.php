<?php
/**
 * User backup note
 */
namespace RongCloud\Lib\User\Remark;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Remark {

    /**
 * User Module User Notes
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Remark/';

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
 * User constructor.
 */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add user remark
 *
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1',//User ID
 * 'remark'=> [
 * ["id"=>'userid',"remark"=>'Remark2'],
 * ["id"=>'userid2',"remark"=>'Remark2']
 * ]//User remark
 * ];
 * @return array
 */
    public function set(array $User=[]){
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete user remark
 *
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1',//User ID
 * 'targetId'=> 'targetUserid'//User remark
 * ];
 * @return array
 */
    public function del(array $User=[]){
        $conf = $this->conf['del'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get user annotation
 * @param array $User
 * @param
 * $User = [
 * 'userId'=> 'ujadk90ha1', // User ID
 * 'size'=> 50 // Default 50
 * 'page' => 1 // Default first page
 * ];
 * @return array
 * @return  array
 */
    public function get(array $User=[]){
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}