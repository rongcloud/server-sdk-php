<?php
/**
 * 指定超级群全部成员禁言
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\MuteAllMembers;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class MuteAllMembers
{
    /**
     * 超级群模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Ultragroup/MuteAllMembers/';

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
     * 设置超级群禁言
     *
     * @param $Group array 添加超级群禁言 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'busChannel'=> 'busid',//频道 id  可以为空
                'status'=> true,//超级群 禁言状态   true 禁言  0 取消
         ];
     * @return array
     */
    public function set(array $Group=[]){
        $conf = $this->conf['add'];
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

    /**
     * 查询超级群禁言状态
     *
     * @param $Group array 超级群 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//超级群 id
            'busChannel'=> 'busid',//频道 id  可以为空
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
        return $result;
    }

}
