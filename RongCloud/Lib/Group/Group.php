<?php
/**
 * 群组模块
 * @author hejinyu
 */
namespace RongCloud\Lib\Group;

use RongCloud\Lib\Group\Gag\Gag;
use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;
class Group
{
    /**
     * 群组模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Group/';

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
     * Conversation constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * 同步群组信息
     *
     * @param $Group array 同步群组信息 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//用户id
            'groups'=>[['id'=> 'group9998', 'name'=> 'RongCloud']]//用户群组信息
        ];
     * @return array
     */
    public function sync(array $Group=[]){
        $conf = $this->conf['sync'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'user',
                    'data'=> $Group,
                    'verify'=> $this->verify['user']
                ]);
        if($error) return $error;
        $data = [];
        $data['group'] = array_column($Group['groups'],'name', 'id');
        $data['userId'] = $Group['id'];
        $result = (new Request())->Request($conf['url'],$data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 创建群组
     *
     * @param $Group array 创建群组 参数
     * @param
     * $Group = [
            'id'=> 'watergroup1',//群组 id
            'name'=> 'watergroup',//群组名称
            'members'=>[          //群成员 列表
                ['id'=> 'group9991111113']
            ]
        ];
     * @return array
     */
    public function create(array $Group=[]){
        $conf = $this->conf['create'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['group']
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
            'members'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 加入群组
     *
     * @param $Group array 加入群组 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//群组 id
            'name'=>"watergroup",//群组名称
            'member'=>['id'=> 'group999'],//群成员信息
        ];
     * @return array
     */
    public function joins(array $Group=[]){
        $conf = $this->conf['join'];
        $verify = $this->verify['group'];
        unset($verify['memberIds'],$verify['name']);
        $verify = array_merge($verify,$this->verify['member']);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 退出群组
     *
     * @param $Group array 退出群组 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//群组 id
            'member'=>['id'=> 'group999'],//群成员信息
        ];
     * @return array
     */
    public function quit(array $Group=[]){
        $conf = $this->conf['quit'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $verify = array_merge($verify,$this->verify['member']);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 解散群组
     *
     * @param $Group array 解散群组 参数
     * @param
     * $Group = [
        'id'=> 'watergroup',//群组 id
        'member'=>['id'=> 'group999'],//管理员信息
        ];
     * @return array
     */
    public function dismiss(array $Group=[]){
        $conf = $this->conf['dismiss'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 修改群信息
     *
     * @param $Group array 修改群信息 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//群组 id
            'name'=>"watergroup"//群名称
        ];
     * @return array
     */
    public function update(array $Group=[]){
        $conf = $this->conf['update'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'],'name'=>$verify['name']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取群信息
     *
     * @param $Group array 获取群信息 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//群组 id
        ];
     * @return array
     */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200) {
            $result = (new Utils())->rename($result, [
                'users'=> 'members',
            ]);
        }
        return $result;
    }

    /**
     * 创建群组禁言对象
     *
     * @return Gag
     */
    public function Gag(){
        return new Gag();
    }

}