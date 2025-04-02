<?php

/**
 * Request to send
 */

namespace RongCloud\Lib;

use RongCloud\RongCloud;

class Request
{
    private $appKey = '';
    private $appSecret = '';
    /**
 * Server API interface address
 * Singapore domain: api.sg-light-api.com, api-b.sg-light-api.com
 *
 * @var array
 */
    private $serverUrl = ['  http://api.rong-api.com/', 'http://api-b.rong-api.com/'];
    // private $serverUrl = ['http://api.sg-light-api.com/', 'http://api-b.sg-light-api.com/'];
    // private $serverUrl = 'https://api-rce-rcxtest.rongcloud.net/';
    private $smsUrl = '  http://api.sms.ronghub.com/';
    private $connectTimeout = 20;
    private $timeout = 30;

    public function __construct()
    {
        if (RongCloud::$appkey) {
            $this->appKey = RongCloud::$appkey;
        }
        if (RongCloud::$appSecret) {
            $this->appSecret = RongCloud::$appSecret;
        }
        if (RongCloud::$connectTimeout) {
            $this->connectTimeout = RongCloud::$connectTimeout;
        }
        if (RongCloud::$timeout) {
            $this->timeout = RongCloud::$timeout;
        }
        if (RongCloud::$apiUrl) {
            $this->serverUrl = RongCloud::$apiUrl;
        } else {
            RongCloud::$apiUrl = $this->serverUrl;
        }
        $this->serverUrl = $this->resetServerUrl();
    }

    /**
 * Server URL multi-domain switching
 */
    private function resetServerUrl($nextUrl = "")
    {
        if (is_array(RongCloud::$apiUrl)) {
            $urlList = RongCloud::$apiUrl;
            sort($urlList);
            RongCloud::$apiUrl = $urlList;
        }
        if (is_array(RongCloud::$apiUrl) && count(RongCloud::$apiUrl) == 1) {
            return RongCloud::$apiUrl[0];
        }
        if (is_string(RongCloud::$apiUrl)) {
            return RongCloud::$apiUrl;
        }
        if(RONGCLOUOD_DOMAIN_CHANGE != true){
            return RongCloud::$apiUrl[0];
        }
        ob_start(); // 启用输出缓冲
        $seesionId = "RongCloudServerSDKUrl";
        if (!session_id()) {
            @session_start();
        }
        $oldSessionId = session_id();
        session_write_close();
        // Switch to SDK session
        session_id($seesionId);
        session_start();

        if (!isset($_SESSION['curl'])) {
            $_SESSION['curl'] = RongCloud::$apiUrl[0];
        }
        if ($nextUrl) {
            $_SESSION['curl'] = $nextUrl;
        }

        $currentUrl = isset($_SESSION['curl']) ? $_SESSION['curl'] : RongCloud::$apiUrl[0];
        session_write_close();
        unset($_SESSION);
        // Switch to the original SESSION
        session_id($oldSessionId);
        session_start();
        setcookie("PHPSESSID", $oldSessionId);
        ob_end_flush(); // 结束输出缓冲并发送输出
        return $currentUrl;
    }

    /**
 * Set the next domain as the multi-domain
 * @param string $url
 */
    private function getNextUrl($url = "")
    {
        $urlList = RongCloud::$apiUrl;
        if (is_array($urlList) && in_array($url, $urlList)) {
            $currentKey = array_search($url, $urlList);
            $nextUrl    = isset($urlList[$currentKey + 1]) ? $urlList[$currentKey + 1] : $urlList[0];
            $this->resetServerUrl($nextUrl);
        }
        return true;
    }

    /**
 * Create HTTP header parameters
 * @param array $data
 * @return bool
 */
    private function createHttpHeader($request_id)
    {
        $nonce     = mt_rand();
        $timeStamp = time();
        $sign      = sha1($this->appSecret . $nonce . $timeStamp);
        return [
            'RC-App-Key:' . $this->appKey,
            'RC-Nonce:' . $nonce,
            'RC-Timestamp:' . $timeStamp,
            'RC-Signature:' . $sign,
            'X-Request-ID:' . $request_id
        ];
    }

    /**
 *  Send request
 *
 * @param Interface $action method
 * @param Request $params parameters
 * @param string $contentType Interface return data type, default json
 * @param string $module Interface request module, default im
 * @param string $httpMethod Interface request method, default POST
 * @return int|mixed
 */
    public function Request($action, $params, $contentType = 'urlencoded', $module = 'im', $httpMethod = 'POST')
    {
        switch ($module) {
            case 'im':
                $action = $this->serverUrl . $action;
                break;
            case 'sms':
                $action = $this->smsUrl . $action;
                break;
            default:
                $action = $this->serverUrl . $action;
        }
        $guid = $this->create_guid();
        $httpHeader = $this->createHttpHeader($guid);
        $ch         = curl_init();
        if ($contentType == "urlencoded" || $contentType == "json") {
            $action .= ".json";
        } else {
            $action .= ".xml";
        }
        if ($httpMethod == 'POST' && $contentType == 'urlencoded') {
            $httpHeader[] = 'Content-Type:application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->build_query($params));
        }
        if ($httpMethod == 'POST' && $contentType == 'json') {
            $httpHeader[] = 'Content-Type:application/json';
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }
        if ($httpMethod == 'GET' && $contentType == 'urlencoded') {
            $action .= strpos($action, '?') === false ? '?' : '&';
            $action .= $this->build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_POST, $httpMethod == 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//  Handle HTTP certificate issues
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, "rc-php-sdk/3.3.4");
        // curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        if (false === $ret) {
            $ret = curl_errno($ch);
            $ret = $this->getCurlError($ret);
        }
        $httpInfo = curl_getinfo($ch);
        curl_close($ch);
        $result = json_decode($ret, true);
        if (isset($result['code']) && $result['code'] == 1000) {
        }
        $this->getNextUrl($this->serverUrl);
        if ($module == "im") {
            if (is_null($result)) {
                $this->getNextUrl($this->serverUrl);
            } else {
                if ($httpInfo['http_code'] >= 500 && $httpInfo['http_code'] < 600) {
                    $this->getNextUrl($this->serverUrl);
                } elseif (in_array($httpInfo['http_code'], [0, 7, 28])) {
                    $this->getNextUrl($this->serverUrl);
                }
            }
        }
        if (is_null($result)) {
            return $ret . ',requestId:' . $guid;
        } else {
            $result['requestId'] = $guid;
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
 * Get parameters from POST (x-www-form-urlencoded)/GET request
 *
 * @param Request $params parameters
 * @return bool|string
 */
    public function getQueryFields($params)
    {
        return $this->build_query($params);
    }

    /**
 * Generate parameter body
 *
 * @param $formData
 * @param string $numericPrefix
 * @param string $argSeparator
 * @param string $prefixKey
 * @return bool|string
 */
    private function build_query($formData, $numericPrefix = '', $argSeparator = '&', $prefixKey = '')
    {
        $str = '';
        foreach ($formData as $key => $val) {
            if (!is_array($val)) {
                $str .= $argSeparator;
                if ($prefixKey === '') {
                    if (is_int($key)) {
                        $str .= $numericPrefix;
                    }
                    $str .= urlencode($key) . '=' . urlencode($val);
                } else {
                    $str .= urlencode($prefixKey) . '=' . urlencode($val);
                }
            } else {
                if ($prefixKey == '') {
                    $prefixKey .= $key;
                }
                if (isset($val[0]) && is_array($val[0])) {
                    $arr       = array();
                    $arr[$key] = $val[0];
                    $str       .= $argSeparator . http_build_query($arr);
                } else {
                    $str .= $argSeparator . $this->build_query($val, $numericPrefix, $argSeparator, $prefixKey);
                }
                $prefixKey = '';
            }
        }
        return substr($str, strlen($argSeparator));
    }

    private function create_guid()
    {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $uuid = substr($charid, 0, 8)
            . substr($charid, 8, 4)
            . substr($charid, 12, 4)
            . substr($charid, 16, 4)
            . substr($charid, 20, 12);
        return strtolower($uuid);
    }

    /**
 * cURL request error information
 * @param int $error
 */
    public function getCurlError($error = 1)
    {
        $errorCodes = array(
            1  => 'CURLE_UNSUPPORTED_PROTOCOL',
            2  => 'CURLE_FAILED_INIT',
            3  => 'CURLE_URL_MALFORMAT',
            4  => 'CURLE_URL_MALFORMAT_USER',
            5  => 'CURLE_COULDNT_RESOLVE_PROXY',
            6  => 'CURLE_COULDNT_RESOLVE_HOST',
            7  => 'CURLE_COULDNT_CONNECT',
            8  => 'CURLE_FTP_WEIRD_SERVER_REPLY',
            9  => 'CURLE_REMOTE_ACCESS_DENIED',
            11 => 'CURLE_FTP_WEIRD_PASS_REPLY',
            13 => 'CURLE_FTP_WEIRD_PASV_REPLY',
            14 => 'CURLE_FTP_WEIRD_227_FORMAT',
            15 => 'CURLE_FTP_CANT_GET_HOST',
            17 => 'CURLE_FTP_COULDNT_SET_TYPE',
            18 => 'CURLE_PARTIAL_FILE',
            19 => 'CURLE_FTP_COULDNT_RETR_FILE',
            21 => 'CURLE_QUOTE_ERROR',
            22 => 'CURLE_HTTP_RETURNED_ERROR',
            23 => 'CURLE_WRITE_ERROR',
            25 => 'CURLE_UPLOAD_FAILED',
            26 => 'CURLE_READ_ERROR',
            27 => 'CURLE_OUT_OF_MEMORY',
            28 => 'CURLE_OPERATION_TIMEDOUT',
            30 => 'CURLE_FTP_PORT_FAILED',
            31 => 'CURLE_FTP_COULDNT_USE_REST',
            33 => 'CURLE_RANGE_ERROR',
            34 => 'CURLE_HTTP_POST_ERROR',
            35 => 'CURLE_SSL_CONNECT_ERROR',
            36 => 'CURLE_BAD_DOWNLOAD_RESUME',
            37 => 'CURLE_FILE_COULDNT_READ_FILE',
            38 => 'CURLE_LDAP_CANNOT_BIND',
            39 => 'CURLE_LDAP_SEARCH_FAILED',
            41 => 'CURLE_FUNCTION_NOT_FOUND',
            42 => 'CURLE_ABORTED_BY_CALLBACK',
            43 => 'CURLE_BAD_FUNCTION_ARGUMENT',
            45 => 'CURLE_INTERFACE_FAILED',
            47 => 'CURLE_TOO_MANY_REDIRECTS',
            48 => 'CURLE_UNKNOWN_TELNET_OPTION',
            49 => 'CURLE_TELNET_OPTION_SYNTAX',
            51 => 'CURLE_PEER_FAILED_VERIFICATION',
            52 => 'CURLE_GOT_NOTHING',
            53 => 'CURLE_SSL_ENGINE_NOTFOUND',
            54 => 'CURLE_SSL_ENGINE_SETFAILED',
            55 => 'CURLE_SEND_ERROR',
            56 => 'CURLE_RECV_ERROR',
            58 => 'CURLE_SSL_CERTPROBLEM',
            59 => 'CURLE_SSL_CIPHER',
            60 => 'CURLE_SSL_CACERT',
            61 => 'CURLE_BAD_CONTENT_ENCODING',
            62 => 'CURLE_LDAP_INVALID_URL',
            63 => 'CURLE_FILESIZE_EXCEEDED',
            64 => 'CURLE_USE_SSL_FAILED',
            65 => 'CURLE_SEND_FAIL_REWIND',
            66 => 'CURLE_SSL_ENGINE_INITFAILED',
            67 => 'CURLE_LOGIN_DENIED',
            68 => 'CURLE_TFTP_NOTFOUND',
            69 => 'CURLE_TFTP_PERM',
            70 => 'CURLE_REMOTE_DISK_FULL',
            71 => 'CURLE_TFTP_ILLEGAL',
            72 => 'CURLE_TFTP_UNKNOWNID',
            73 => 'CURLE_REMOTE_FILE_EXISTS',
            74 => 'CURLE_TFTP_NOSUCHUSER',
            75 => 'CURLE_CONV_FAILED',
            76 => 'CURLE_CONV_REQD',
            77 => 'CURLE_SSL_CACERT_BADFILE',
            78 => 'CURLE_REMOTE_FILE_NOT_FOUND',
            79 => 'CURLE_SSH',
            80 => 'CURLE_SSL_SHUTDOWN_FAILED',
            81 => 'CURLE_AGAIN',
            82 => 'CURLE_SSL_CRL_BADFILE',
            83 => 'CURLE_SSL_ISSUER_ERROR',
            84 => 'CURLE_FTP_PRET_FAILED',
            84 => 'CURLE_FTP_PRET_FAILED',
            85 => 'CURLE_RTSP_CSEQ_ERROR',
            86 => 'CURLE_RTSP_SESSION_ERROR',
            87 => 'CURLE_FTP_BAD_FILE_LIST',
            88 => 'CURLE_CHUNK_FAILED'
        );
        if (isset($errorCodes[$error])) {
            return $errorCodes[$error];
        } else {
            return "CURLE_UNKNOW_ERROR";
        }
    }
}
