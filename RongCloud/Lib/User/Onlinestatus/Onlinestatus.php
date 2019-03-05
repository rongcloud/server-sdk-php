<?php
/**
 * 用户模块 用户在线状态
 */
namespace RongCloud\Lib\User\Onlinestatus;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use Rongcloud\Lib\Utils;

class Onlinestatus {

    /**
     * 用户模块用户状态
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Onlinestatus/';

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
     * 检查用户在线状态
     *
     * @param $User array 检查用户在线状态参数
     * @param
     * $User = [
            'id'=> 'ujadk90ha1',//用户id 唯一标识，最大长度 30 个字符
        ];
     * @return array
     */
    public function check(array $User=[]){
        $conf = $this->conf['get'];
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