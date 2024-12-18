<?php
/**
 * 用户关系 白名单
 * User: hejinyu
 * Date: 2018/7/23
 * Time: 11:41
 */
namespace RongCloud\Lib\User\Whitelist;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Whitelist {

    /**
     * 用户模块白名单路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Whitelist/';

    /**
     * 请求配置文件
     *
     * @var string
     */
    private $conf = "";

    /**
     * 校验配置文件
     *
     * @var string
     */
    private $verify = "";

    /**
     * User constructor.
     */
    function __construct()
    {
        //初始化请求配置和校验文件路径
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
     * @param $User array 添加白名单
     * @param
     * $user = [
            'id'=> 'ujadk90ha',//用户 id
            'whitelist'=> ['kkj9o01'] //需要添加白名单的人员列表
        ];
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
     * @param $User array 移除白名单
     * @param
     * $user = [
            'id'=> 'ujadk90ha',//用户 id
            'whitelist'=> ['kkj9o01'] //需要移除白名单的人员列表
        ];
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
     * @param $User array 获取某个用户的白名单列表
     * @param
     * $user = [
            'id'=> 'ujadk90ha',//用户 id
            'size'=> 1000,//分页获取白名单用户时每页行数，不传时默认为 1000 条，最大不超过 1000 条
            'pageToken'=> ''//分页信息，上一次请求返回 next ，不传时不做分页处理，默认获取前 1000 个用户列表，按加入白名单时间倒序排序。
        ];
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