<?php
/**
 * 用户免打扰时间段
 */
namespace RongCloud\Lib\User\BlockPushPeriod;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class BlockPushPeriod {

    /**
     * 用户免打扰时间段路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/BlockPushPeriod/';

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
     * 添加免打扰时间段
     *
     * @param $User array 封禁用户参数
     * @param
     * $User = [
            'id'=> 'ujadk90ha1',//用户id 唯一标识，最大长度 30 个字符
            'startTime'=> "23:59:59" //免打扰开始时间
            'period' => 50,//免打扰分钟数 以免打扰时间开始计算
            'level' => 1 //1仅针对单聊及 @ 消息进行通知，包括 @指定用户和 @所有人的消息。  5不接收通知，即使为 @ 消息也不推送通知
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
        if(!isset($User['level'])){
            $User['level'] = 1;
        }
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *删除用户免打扰时间段
     *
     * @param $User array
     * @param
     *  $user = [
            'id'=> 'ujadk90ha',//用户id 唯一标识，最大长度 30 个字符
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
     *获取用户免打扰时间段
     *
     * @param $User array
     * @param
     * $user = [
        'id'=> 'ujadk90ha',//用户id 唯一标识，最大长度 30 个字符
    ];
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