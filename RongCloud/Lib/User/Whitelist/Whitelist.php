<?php
/**
 * User relationship allowlist
 * User: hejinyu
 * Date: 2018/7/23
 * Time: 11:41
 */
namespace RongCloud\Lib\User\Whitelist;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Whitelist {

    /**
 * User module whitelist path
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Whitelist/';

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
 * @param array $User Add whitelist
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',// User ID
 * 'whitelist'=> ['kkj9o01'] // List of personnel to be added to the whitelist
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
            'whitelist'=> 'whiteUserId'
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * @param array $User Remove whitelist
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',// User ID
 * 'whitelist'=> ['kkj9o01'] // List of personnel to be removed from the whitelist
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
            'whitelist'=> 'whiteUserId'
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 *  @param array $User Get the whitelist of a specific user
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',//User ID
 * 'size'=> 1000,//Number of rows per page when fetching the whitelist, defaults to 1000 if not provided, maximum does not exceed 1000
 * 'pageToken'=> ''//Pagination information, returns 'next' from the previous request, no pagination if not provided, defaults to fetching the first 1000 users in reverse chronological order of addition to the whitelist.
 * ];
 * @return array
 */
    public function getList(array $User=[]){
        $conf = $this->conf['getList'];
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
}