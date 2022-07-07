<?php
/**
 * 超级群频道
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\BusChannel;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class BusChannel
{
    /**
     * 超级群模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Ultragroup/BusChannel/';

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
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
     * 添加超级群频道
     *
     * @param $Group array 添加超级群频道 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'busChannel'=> 'busid'//频道 id
                'type'=>0 // 0 共有频道，1 私有频道
            ];
     * @return array
     */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
     * 删除超级群频道
     *
     * @param $Group array 删除超级群频道 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'busChannel'=> 'busid',//频道 id  可以为空
         ];
     * @return array
     */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
     * 查询频道列表
     *
     * @param
     * @return array
     */
    public function getList($groupId = "", $page = 1, $limit = 20){
        $conf = $this->conf['getList'];
        $Group = ["page"=> $page, "limit"=>$limit,"groupId"=>$groupId];
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 超级群频道类型切换
     *
     * @param $Group array 超级群频道类型切换 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//超级群 id
            'busChannel'=> 'busid'//频道 id
            'type'=>0 // 0 共有频道，1 私有频道
    ];
     * @return array
     */
    public function change(array $Group=[]){
        $conf = $this->conf['change'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'busChannel'=>$verify['busChannel']];
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
        return $result;
    }

    /**
     * 添加超级群私有频道成员
     *
     * @param $Group array 添加超级群私有频道成员 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'busChannel'=> 'busid',//频道 id  可以为空
                'members'=>[ //添加超级群私有频道成员
                ['id'=> 'ujadk90ha']
                ]
    ];
     * @return array
     */
    public function addPrivateUsers(array $Group=[]){
        $conf = $this->conf['privateUserAdd'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
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
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 移除私有频道成员
     *
     * @param $Group array 移除私有频道成员 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'busChannel'=> 'busid',//频道 id  可以为空
                'members'=>[ //移除私有频道成员列表
                    ['id'=> 'ujadk90ha']
                    ]
    ];
     * @return array
     */
    public function removePrivateUsers(array $Group=[]){
        $conf = $this->conf['privateUserRemove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
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
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 查询私有频道成员列表
     *
     * @param $Group array  参数
     * @param
     * $Group = [
        'id'=> 'ujadk90ha',//超级群 id
        'busChannel'=> 'busid',//频道 id  可以为空
        'page'=> 1,
        'pageSize'=>1000,
    ];
     * @return array
     */
    public function getPrivateUserList(array $Group=[]){
        $conf = $this->conf['getPrivateUsers'];
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
        return $result;
    }

}
