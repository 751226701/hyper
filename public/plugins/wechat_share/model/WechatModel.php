<?php

namespace plugins\wechat_share\model;

//Demo插件英文名，改成你的插件英文就行了
use think\Model;

/**
 * 微信模型类
 */
class WechatModel extends Model
{
    /**
     * 模型名称
     * @var string
     */
    
    /**
     * 插件配置
     *
     * @var array
     */
    protected $config;

    protected $appid;

    protected $appsecret;

    protected $access_token;
    
    protected $jsapi_ticket;

    public function __construct()
    {
        $this->config    = cmf_get_plugin_config('WechatShare');
        $this->appid     = $this->config['appid'];
        $this->appsecret = $this->config['appsecret'];
    }

    /**
     * 获取access_token
     * @param string $appid 如在类初始化时已提供，则可为空
     * @param string $appsecret 如在类初始化时已提供，则可为空
     * @param string $token 手动指定access_token，非必要情况不建议用
     */
    public function checkAuth($appid='', $appsecret='', $token='')
    {
        if (!$appid || !$appsecret) {
            $appid     = $this->appid;
            $appsecret = $this->appsecret;
        }
        if ($token) { //手动指定token，优先使用
            $this->access_token=$token;
            return $this->access_token;
        }
        $authname = 'wechat_access_token' . $appid;
        if ($rs = $this->getCache($authname)) {
            $this->access_token = $rs;
            return $rs;
        }
        $result = $this->http_get('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret);
        
        if ($result) {
            $json = json_decode($result, true);
            
       
            if (!$json || isset($json['errcode'])) {
                //$this->error = $json['errcode'];
                //$this->errMsg  = $json['errmsg'];
                $this->error('$json["errcode"]');  
                return false;
            }
            $this->access_token = $json['access_token'];
            $expire             = $json['expires_in'] ? intval($json['expires_in']) - 100 : 3600;
            $this->setCache($authname, $this->access_token, $expire);
            return $this->access_token;
        }
        return false;
    }

    /**
     * 删除验证数据
     * @param string $appid
     */
    public function resetAuth($appid='')
    {
        if (!$appid) {
            $appid = $this->appid;
        }
        $this->access_token = '';
        $authname           = 'wechat_access_token' . $appid;
        $this->removeCache($authname);
        return true;
    }

    /**
     * 删除JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用
     */
    public function resetJsTicket($appid='')
    {
        if (!$appid) {
            $appid = $this->appid;
        }
        $this->jsapi_ticket = '';
        $authname           = 'wechat_jsapi_ticket' . $appid;
        $this->removeCache($authname);
        return true;
    }

    /**
     * 获取JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用,可空
     * @param string $jsapi_ticket 手动指定jsapi_ticket，非必要情况不建议用
     */
    public function getJsTicket($appid='', $jsapi_ticket='')
    {
        if (!$this->access_token && !$this->checkAuth()) {
            return false;
        }
        if (!$appid) {
            $appid = $this->appid;
        }
        if ($jsapi_ticket) { //手动指定token，优先使用
            $this->jsapi_ticket = $jsapi_ticket;
            return $this->jsapi_ticket;
        }
        $authname = 'wechat_jsapi_ticket' . $appid;
        if ($rs = $this->getCache($authname)) {
            $this->jsapi_ticket = $rs;
            return $rs;
        }
        $result = $this->http_get('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $this->access_token . '&type=jsapi');
        if ($result) {
            $json = json_decode($result, true);
            if (!$json || !empty($json['errcode'])) {
                // $this->errCode = $json['errcode'];
                // $this->errMsg  = $json['errmsg'];
                $this->error('$json["errcode"]');
                return false;
            }
            $this->jsapi_ticket = $json['ticket'];
            $expire             = $json['expires_in'] ? intval($json['expires_in']) - 100 : 3600;
            $this->setCache($authname, $this->jsapi_ticket, $expire);
            return $this->jsapi_ticket;
        }
        return false;
    }

    /**
     * 获取JsApi使用签名
     * @param string $url 网页的URL，自动处理#及其后面部分
     * @param string $timestamp 当前时间戳 (为空则自动生成)
     * @param string $noncestr 随机串 (为空则自动生成)
     * @param string $appid 用于多个appid时使用,可空
     * @return array|bool 返回签名字串
     */
    public function getJsSign($url, $timestamp=0, $noncestr='', $appid='')
    {
        if (!$this->jsapi_ticket && !$this->getJsTicket($appid) || !$url) {
            return false;
        }
        if (!$timestamp) {
            $timestamp = time();
        }
        if (!$noncestr) {
            $noncestr = $this->generateNonceStr();
        }
        $ret          = strpos($url, '#');
        if ($ret) {
            $url = substr($url, 0, $ret);
        }
        $url     = trim($url);
        if (empty($url)) {
            return false;
        }
        $arrdata = ['timestamp' => $timestamp, 'noncestr' => $noncestr, 'url' => $url, 'jsapi_ticket' => $this->jsapi_ticket];
        $sign    = $this->getSignature($arrdata);
        if (!$sign) {
            return false;
        }
        $signPackage = [
                'appId'     => $this->appid,
                'nonceStr'  => $noncestr,
                'timestamp' => $timestamp,
                'url'       => $url,
                'signature' => $sign
        ];
        return $signPackage;
    }

    /**
     * 获取签名
     * @param array $arrdata 签名数组
     * @param string $method 签名方法
     * @return bool|string 签名值
     */
    public function getSignature($arrdata, $method='sha1')
    {
        if (!function_exists($method)) {
            return false;
        }
        ksort($arrdata);
        $paramstring = '';
        foreach ($arrdata as $key => $value) {
            if (strlen($paramstring) == 0) {
                $paramstring .= $key . '=' . $value;
            } else {
                $paramstring .= '&' . $key . '=' . $value;
            }
        }
        $Sign = $method($paramstring);
        return $Sign;
    }

    /**
     * 设置缓存
     * @param string $cachename
     * @param mixed $value
     * @param int $expired
     * @return boolean
     */
    protected function setCache($cachename, $value, $expired)
    {
        return cache($cachename, $value, $expired);
    }
    /**
     * 获取缓存
     * @param string $cachename
     * @return mixed
     */
    protected function getCache($cachename)
    {
        return cache($cachename);
    }
    /**
     * 清除缓存
     * @param string $cachename
     * @return boolean
     */
    protected function removeCache($cachename)
    {
        return cache($cachename,null);
    }

    /**
     * GET 请求
     * @param string $url
     */
    private function http_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, 'https://') !== false) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus  = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus['http_code']) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param bool $post_file 是否文件上传
     * @return string content
     */
    private function http_post($url, $param, $post_file=false)
    {
        $oCurl = curl_init();
        if (stripos($url, 'https://') !== false) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }
        if (is_string($param)) {
            $strPOST = $param;
        } elseif ($post_file) {
            if ($is_curlFile) {
                foreach ($param as $key => $val) {
                    if (substr($val, 0, 1) == '@') {
                        $param[$key] = new \CURLFile(realpath(substr($val, 1)));
                    }
                }
            }
            $strPOST = $param;
        } else {
            $aPOST = [];
            foreach ($param as $key=>$val) {
                $aPOST[] = $key . '=' . urlencode($val);
            }
            $strPOST =  join('&', $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus  = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus['http_code']) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 生成随机字串
     * @param number $length 长度，默认为16，最长为32字节
     * @return string
     */
    public function generateNonceStr($length=16)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str   = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }
}
