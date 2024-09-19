<?php

/**
 * 用户托管
 */

namespace RongCloud\Lib\User\Profile;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Profile
{

    /**
     * 用户托管
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Profile/';

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
     * Profile constructor.
     */
    function __construct()
    {
        //初始化请求配置和校验文件路径
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
     * 用户资料设置
     * 
     * @param array
     * $params = [
            'userId' => 'ujadk90ha1', //用户id
            'userProfile' => [],      //用户基本信息(默认最多20个)
            'userExtProfile' => []    //用户扩展信息(key的长度不超过 32 个字符，key的前缀必须加ext_， value的长度，value不超过 256 个字符，默认最多20个)
        ];
     * @return array
     */
    public function set(array $params = [])
    {
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['set']
        ]);
        if ($error) return $error;
        if (isset($params['userProfile'])) {
            if (is_array($params['userProfile'])) {
                $params['userProfile'] = json_encode($params['userProfile'], JSON_UNESCAPED_UNICODE);
            }
        }
        if (isset($params['userExtProfile'])) {
            if (is_array($params['userExtProfile'])) {
                $params['userExtProfile'] = json_encode($params['userExtProfile'], JSON_UNESCAPED_UNICODE);
            }
        }
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 用户托管信息清除
     *
     * @param array
     * $params = [
            'userId'=> ['ujadk90ha1','ujadk90ha1'],//用户id 列表，一次最多20个用户
        ];
     * @return array
     */
    public function clean(array $params = [])
    {
        $conf = $this->conf['clean'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['clean']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 批量查询用户资料
     *
     * @param array
     * $params = [
            'userId'=> ['ujadk90ha1','ujadk90ha1'],//用户id 列表，最多一次100个
        ];
     * @return array
     */
    public function batchQuery(array $params = [])
    {
        $conf = $this->conf['batchQuery'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['batchQuery']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 分页获取应用全部用户列表
     *
     * @param array
     * $params = [
            'page'  => 1,   //默认1
            'size'  => 20,  //默认20，最大100
            'order' => 0,   //根据注册时间的排序机制，默认正序，0为正序，1为倒序
        ];
     * @return array
     */
    public function query(array $params = [])
    {
        $conf = $this->conf['query'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['query']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
