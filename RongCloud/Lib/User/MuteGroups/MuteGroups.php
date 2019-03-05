<?php
/**
 * 用户模块 全局群成员禁言服务
 */
namespace RongCloud\Lib\User\MuteGroups;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use Rongcloud\Lib\Utils;

class MuteGroups {

    /**
     * 用户模块 全局群成员禁言服务
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/MuteGroups/';

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
     * 添加群组禁言
     *
     * @param $Group array 添加群组禁言 参数
     * @param
     * $Group = [
                'members'=>[ //禁言人员列表
                    ['id'=> 'ujadk90ha']
                ],
                'minute'=>50  //	禁言时长
        ];
     * @return array
     */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['members'=>$verify['members']];
        $verify = array_merge($verify , ['minute'=>$this->verify['minute']]);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 解除禁言
     *
     * @param $Group array 解除禁言 参数
     * @param
     * $Group = [
                'members'=>[ //解除禁言人员列表
                    ['id'=> 'ujadk90ha']
                ]
            ];
     * @return array
     */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 查询禁言成员列表
     *
     * @param $Group array 查询禁言成员列表
     * @param
     * $Group = [
        ];
     * @return array
     */
    public function getList(array $Group=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members']?:[] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

}