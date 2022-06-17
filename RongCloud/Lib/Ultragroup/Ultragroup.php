<?php
/**
 * 超级群模块
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup;

use RongCloud\Lib\Ultragroup\Gag\Gag;
use RongCloud\Lib\Ultragroup\MuteAllMembers\MuteAllMembers;
use RongCloud\Lib\Ultragroup\MuteWhiteList\MuteWhiteList;
use RongCloud\Lib\Ultragroup\Expansion\Expansion;
use RongCloud\Lib\Ultragroup\BusChannel\BusChannel;
use RongCloud\Lib\Ultragroup\Notdisturb\Notdisturb;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Ultragroup
{
    /**
     * 超级群模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Ultragroup/';

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
     * 创建超级群
     *
     * @param $Group array 创建超级群 参数
     * @param
     * $Group = [
            'id'=> 'watergroup1',//超级群 id
            'name'=> 'watergroup',//超级群名称
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
     * 加入超级群
     *
     * @param $Group array 加入超级群 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//超级群 id
            'name'=>"watergroup",//超级群名称
            'member'=>['id'=> 'group999'],//群成员信息
        ];
     * @return array
     */
    public function joins(array $Group=[]){
        $conf = $this->conf['join'];
        $verify = $this->verify['group'];
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
     * 退出超级群
     *
     * @param $Group array 退出超级群 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//超级群 id
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
     * 解散超级群
     *
     * @param $Group array 解散超级群 参数
     * @param
     * $Group = [
        'id'=> 'watergroup',//超级群 id
        'member'=>['id'=> 'group999'],//管理员信息
        ];
     * @return array
     */
    public function dismiss(array $Group=[]){
        $conf = $this->conf['dis'];
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
            'id'=> 'watergroup',//超级群 id
            'name'=>"watergroup"//群名称
        ];
     * @return array
     */
    public function update(array $Group=[]){
        $conf = $this->conf['refresh'];
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
     * 超级群成员是否存在
     *
     * @param $Group array 修改群信息 参数
     * @param
     * $Group = [
            'id'=> 'watergroup',//超级群 id
            'member'=>"userId" //成员id
            ];
     * @return array
     */
    public function isExist(array $Group=[]){
        $conf = $this->conf['isExist'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'],'member'=>$verify['member']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }


    /**
     * 创建超级群禁言对象
     *
     * @return Gag
     */
    public function Gag(){
        return new Gag();
    }

    /**
     * 创建指定超级群全员禁言
     *
     * @return MuteAllMembers
     */
    public function MuteAllMembers(){
        return new MuteAllMembers();
    }
    /**
     * 创建指定超级群全员禁言
     *
     * @return MuteWhiteList
     */
    public function MuteWhiteList(){
        return new MuteWhiteList();
    }

    /**
     * 超级群扩展
     *
     * @return Expansion
     */
    public function Expansion(){
        return new Expansion();
    }

    /**
     * 超级群扩展
     *
     * @return BusChannel
     */
    public function BusChannel(){
        return new BusChannel();
    }

    /**
     * 超级群扩免打扰
     *
     * @return Notdisturb
     */
    public function Notdisturb(){
        return new Notdisturb();
    }


}