<?php


/**
 * Information Hosting Module
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
 * Information Hosting Module Path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Entrust/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * // Configuration file for validation
 *
 * @var string
 */
    private $verify = '';

    /**
 * // User constructor.
 */
    function __construct()
    {
        // // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }


    /**
 * // Group information module
 *
 * @return Group
 */
    public function Group()
    {
        return new Group();
    }

    /**
 * // Group information management module
 *
 * @return Manager
 */
    public function GroupManager()
    {
        return new Manager();
    }

    /**
 * Group information management - remark name module
 *
 * @return RemarkName
 */
    public function GroupRemarkName()
    {
        return new RemarkName();
    }
    
    /**
 * Group information trustee - member module
 *
 * @return Member
 */
    public function GroupMember()
    {
        return new Member();
    }

}
