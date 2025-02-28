<?php
/**
 * Sensitive Word Management
 * Date=> 2018/7/23
 * Time=> 11=>41
 */
namespace RongCloud\Lib\Sensitive;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Sensitive
{

    /**
 * // Sensitive word module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Sensitive/';

    /**
 * // Request configuration file
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
 * Sensitive constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 *  Sensitive word addition
 *
 * @param array $Sensitive Sensitive word addition parameter
 * @param
 * $Sensitive = [
 * 'replace'=> '***',// Sensitive word replacement, maximum length not exceeding 32 characters, sensitive word masking can be empty
 * 'keyword'=>"abc",// Sensitive word
 * 'type'=>0// 0: Sensitive word replacement 1: Sensitive word masking
 * ];
 * @return array
 */
    public function add(array $Sensitive=[]){
        $Sensitive['replace'] = isset($Sensitive['replace'])?$Sensitive['replace']:"";
        $conf = $this->conf['add'];
        $verify = $this->verify['rule'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'rule',
            'data'=> $Sensitive,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Sensitive = (new Utils())->rename($Sensitive, [
            'keyword'=> 'word',
            'replace'=> 'replaceWord'
        ]);
        if(!isset($Sensitive['type'])){
            $Sensitive['type'] = 1;
        }
        if($Sensitive['type'] == 1){
            unset($Sensitive['type']);
            unset($Sensitive['replaceWord']);
        }
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
    /**
 * // Batch add sensitive words
 *
 * @param array $Sensitive Parameters for adding sensitive words
 * @param
 * $Sensitive = [
 * [
 * 'word'=>'abc',// Sensitive word
 * 'replaceWord'=>'***'// Replacement for sensitive word, maximum length not exceeding 32 characters, sensitive word masking can be empty
 * ]
 * ];
 * @return array
 */
    public function batchAdd(array $Sensitive = []) {
        $conf = $this->conf['batchAdd'];
        $verify = $this->verify['batchAdd'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'sensitive',
            'data' => $Sensitive,
            'verify' => $verify
        ]);
        if ($error) return $error;

        $result = (new Request())->Request($conf['url'], $Sensitive, 'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Sensitive word deletion
 *
 * @param array $Sensitive  Sensitive word deletion parameter
 * @param
 * $Sensitive = [
 * 'keywords'=>["bbb"]//Sensitive word deletion list
 * ];
 * @return array
 */
    public function remove(array $Sensitive=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['sensitive'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'sensitive',
            'data'=> $Sensitive,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Sensitive = (new Utils())->rename($Sensitive, [
            'keywords'=> 'words',
        ]);
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Sensitive word list
 *
 * @param array $Sensitive Sensitive word list parameter
 * @param
 * $Sensitive = [
 * 'type'=> 1,//Sensitive word type, 0: Sensitive word replacement, 1: Sensitive word filtering, empty to get all
 * ];
 * @return array
 */
    public function getList(array $Sensitive=[]){
        $Sensitive['type'] = isset($Sensitive['type'])?intval($Sensitive['type']):2;
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

}