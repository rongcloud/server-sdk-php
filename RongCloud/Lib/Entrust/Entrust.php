<?php


/**
 * 信息托管模块
 */
namespace RongCloud\Lib\Entrust;

use RongCloud\Lib\Entrust\Group\Group;
use RongCloud\Lib\Entrust\Group\RemarkName\RemarkName;
use RongCloud\Lib\Entrust\Group\Member\Member;
use RongCloud\Lib\Entrust\Group\Manager\Manager;
use RongCloud\Lib\Utils;
use RongCloud\Lib\Request;

class Entrust
{
    /**
     * 信息托管模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Entrust/';

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
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }


    /**
     * 群组信息模块
     *
     * @return Group
     */
    public function Group()
    {
        return new Group();
    }

    /**
     * 群组信息托管-管理模块
     *
     * @return Manager
     */
    public function GroupManager()
    {
        return new Manager();
    }

    /**
     * 群组信息托管-备注名模块
     *
     * @return RemarkName
     */
    public function GroupRemarkName()
    {
        return new RemarkName();
    }
    
    /**
     * 群组信息托管-成员模块
     *
     * @return Member
     */
    public function GroupMember()
    {
        return new Member();
    }

}
