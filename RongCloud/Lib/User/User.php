<?php
/**
 * 用户模块
 * User=> hejinyu
 * Date=> 2018/7/23
 * Time=> 11=>41
 */
namespace RongCloud\Lib\User;

use RongCloud\Lib\User\Block\Block;
use RongCloud\Lib\User\Blacklist\Blacklist;
use RongCloud\Lib\User\MuteGroups\MuteGroups;
use RongCloud\Lib\User\Onlinestatus\Onlinestatus;
use RongCloud\Lib\User\MuteChatrooms\MuteChatrooms;
use Rongcloud\Lib\Utils;
use RongCloud\Lib\Request;

class User
{
    /**
     * 用户模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/';

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
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * @param $User array 用户注册
     * @param
     * $User = [
            'id'=> 'ujadk90ha',//用户id
            'name'=> 'Maritn',//用户名称
            'portrait'=> 'http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' //用户头像
        ];
     * @return array
     */
    public function register(array $User=[]){
        $conf = $this->conf['register'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'user',
                    'data'=> $User,
                    'verify'=> $this->verify['user']
                ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
                'id'=> 'userId',
                'portrait'=> 'portraitUri'
            ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $User array 用户信息更新
     * @param
     * $User = [
            'id'=> 'ujadk90ha',//用户id
            'name'=> 'Maritn',//用户名称
            'portrait'=> 'http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' //用户头像
        ];
     * @return array
     */
    public function update(array $User=[]){
        $conf = $this->conf['update'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['user']
        ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
            'portrait'=> 'portraitUri'
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 创建封禁对象
     *
     * @return Block
     */
    public function Block(){
        return new Block();
    }

    /**
     * 创建黑名单对象
     *
     * @return Blacklist
     */
    public function Blacklist(){
        return new Blacklist();
    }

    /**
     * 创建用户在线状态对象
     *
     * @return Onlinestatus
     */
    public function Onlinestatus(){
        return new Onlinestatus();
    }

    /**
     * 全局群组禁言
     *
     * @return MuteGroups
     */
    public function MuteGroups(){
        return new MuteGroups();
    }

    /**
     * 全局聊天室禁言
     *
     * @return MuteChatrooms
     */
    public function MuteChatrooms(){
        return new MuteChatrooms();
    }



}