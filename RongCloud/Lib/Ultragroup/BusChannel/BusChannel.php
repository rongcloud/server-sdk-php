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

}
