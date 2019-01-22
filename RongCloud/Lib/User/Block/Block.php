<?php
/**
 * 用户关系 封禁用户
 */
namespace RongCloud\Lib\User\Block;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use Rongcloud\Lib\Utils;

class Block {

    /**
     * 用户模块封禁用户路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Block/';

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
     * 添加封禁用户
     *
     * @param $User array 封禁用户参数
     * @param
     * $User = [
            'id'=> 'ujadk90ha1',//封禁用户id 唯一标识，最大长度 30 个字符
            'minute'=> 20 //封禁时长 1 - 1 * 30 * 24 * 60 分钟
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
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *解除用户封禁
     *
     * @param $User array 解禁参数
     * @param
     *  $user = [
            'id'=> 'ujadk90ha',//解禁用户id 唯一标识，最大长度 30 个字符
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
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *获取封禁用户列表
     *
     * @param $User array 封禁用户列表参数
     * @param
     * $user = [
            ];
     * @return  array
     */
    public function getList(array $User=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$User);
//        foreach ($result[''])
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}