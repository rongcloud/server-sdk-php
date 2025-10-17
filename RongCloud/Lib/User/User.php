<?php

/**
 * User Module
 * User=> hejinyu
 * Date=> 2018/7/23
 * Time=> 11=>41
 */

namespace RongCloud\Lib\User;

use RongCloud\Lib\User\Tag\Tag;
use RongCloud\Lib\User\Block\Block;
use RongCloud\Lib\User\Blacklist\Blacklist;
use RongCloud\Lib\User\Whitelist\Whitelist;
use RongCloud\Lib\User\MuteGroups\MuteGroups;
use RongCloud\Lib\User\Onlinestatus\Onlinestatus;
use RongCloud\Lib\User\MuteChatrooms\MuteChatrooms;
use RongCloud\Lib\User\Chat\Ban;
use RongCloud\Lib\User\Remark\Remark;
use RongCloud\Lib\User\BlockPushPeriod\BlockPushPeriod;
use RongCloud\Lib\User\Profile\Profile;
use RongCloud\Lib\Utils;
use RongCloud\Lib\Request;

class User
{
    /**
     * User module path
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/';

    /**
     * Request configuration file
     *
     * @var string
     */
    private $conf = '';

    /**
     * Verification configuration file
     *
     * @var string
     */
    private $verify = '';

    /**
     * User constructor.
     */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
     *  @param array $User User registration
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha', // User ID
     * 'name'=> 'Maritn', // User name
     * 'portrait'=> 'http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' // User avatar
     * ];
     * @return array
     */
    public function register(array $User = [])
    {
        $conf = $this->conf['register'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
            'portrait' => 'portraitUri'
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $bodyParameter = (new Request())->getQueryFields($User);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }

    /**
     * Token invalidation
     *
     * @param array $User User information
     * @param
     * $User = [
     * 'id'=> ['ujadk90ha1'],   // User IDs that need to have their tokens invalidated, supports setting up to 20 IDs.
     * 'time'=> 1623123911000  // Expiration timestamp accurate to milliseconds, all tokens obtained by the user before this timestamp will be invalidated. Tokens in use by connected users before this timestamp will not be immediately invalidated, but will be unable to reconnect after disconnection.
     * ];
     * @return array
     */
    public function expire(array $User = [])
    {
        $conf = $this->conf['expire'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['expire']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId'
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $bodyParameter = (new Request())->getQueryFields($User);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }

    /**
     * @param array $User User information update
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha', // User ID
     * 'name'=> 'Maritn', // User name
     * 'portrait'=> 'http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' // User avatar
     * ];
     * @return array
     */
    public function update(array $User = [])
    {
        $conf = $this->conf['update'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
            'portrait' => 'portraitUri'
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $User Query user information
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha',//User ID
     * ];
     * @return array
     */
    public function get(array $User = [])
    {
        $conf = $this->conf['get'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if ($result['code'] == 200) {
            $result = (new Utils())->rename($result, [
                'userName' => 'name',
                'userPortrait' => 'portrait',
            ]);
        }
        return $result;
    }

    /**
     * @param array $User User deregistration
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha',//User ID
     * ];
     * @return array
     */
    public function abandon(array $User = [])
    {
        $conf = $this->conf['cancel_set'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $User Query for deactivated users
     * @param
     * @return array
     */
    public function abandonQuery(array $params = ["page" => 1, "size" => 50])
    {
        $conf = $this->conf['cancel_query'];

        $User = (new Utils())->rename($params, [
            'page' => 'pageNo',
            'size' => 'pageSize'
        ]);

        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $User Deactivate user activation
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha',//User ID
     * ];
     * @return array
     */
    public function activate(array $User = [])
    {
        $conf = $this->conf['active'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * Reactivate user ID
     * @param array $User User ID
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha', // User ID
     * ];
     * @return array
     */
    public function reactivate(array $User = [])
    {
        $conf = $this->conf['reactivate'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $User Query the group where the user is located
     * @param
     * $User = [
     * 'id'=> 'ujadk90ha',//User ID
     * ];
     * @return array
     */
    public function getGroups(array $User = [])
    {
        $conf = $this->conf['getGroups'];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'user',
                'data' => $User,
                'verify' => $this->verify['user']
            ]
        );
        if ($error) {
            return $error;
        }
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    public function query(array $params = ["page" => 1, "pageSize" => 20, "order" => 0]) {
        $conf = $this->conf['user_query'];
        $User = (new Utils())->rename($params, [
            'size' => 'pageSize'
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    public function del(array $params) {
        $conf = $this->conf['user_del'];
        $User = (new Utils())->rename($params, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * Create a block object
     *
     * @return Block
     */
    public function Block()
    {
        return new Block();
    }

    /**
     * Create a blacklist object
     *
     * @return Blacklist
     */
    public function Blacklist()
    {
        return new Blacklist();
    }

    /**
     * Create an online status object for the user
     *
     * @return Onlinestatus
     */
    public function Onlinestatus()
    {
        return new Onlinestatus();
    }

    /**
     * Global group muting
     *
     * @return MuteGroups
     */
    public function MuteGroups()
    {
        return new MuteGroups();
    }

    /**
     * Global chatroom mute
     *
     * @return MuteChatrooms
     */
    public function MuteChatrooms()
    {
        return new MuteChatrooms();
    }

    /**
     * User tag
     *
     * @return Tag
     */
    public function Tag()
    {
        return new Tag();
    }

    /**
     * Create a whitelist object
     *
     * @return Whitelist
     */
    public function Whitelist()
    {
        return new Whitelist();
    }

    /**
     * User mute ban
     *
     * @return Ban
     */
    public function Ban()
    {
        return new Ban();
    }

    /**
     * User push remark
     *
     * @return Remark
     */
    public function Remark()
    {
        return new Remark();
    }

    /**
     * User quiet time period
     *
     * @return Remark
     */
    public function BlockPushPeriod()
    {
        return new BlockPushPeriod();
    }

    /**
     * User Profile Hosting
     *
     * @return Profile
     */
    public function Profile()
    {
        return new Profile();
    }
}
