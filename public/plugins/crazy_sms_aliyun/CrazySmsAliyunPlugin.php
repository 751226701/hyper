<?php
/**
 * 阿里云短信插件
 *
 * Author：惠达浪
 * Blog: https://www.qdcrazy.cn
 * Email： crazys@126.com
 * Date： 2024/11/06
 */

namespace plugins\crazy_sms_aliyun;

use cmf\lib\Plugin;
use plugins\crazy_sms_aliyun\service\SmsService;

class CrazySmsAliyunPlugin extends Plugin {
    public $info = [
        'name'        => 'CrazySmsAliyun',
        'title'       => '阿里云短信插件',
        'description' => '阿里云短信通用插件，适用于国内与国际短信发送',
        'status'      => 1,
        'author'      => '易东云',
        'version'     => '2.0',
        'author_url'  => 'https://saas.ydc.show'
    ];

    /**
     * 安装插件
     * @return bool
     */
    public function install(): bool {
        if (class_exists('AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi')) {
            return true;
        }

        if (function_exists('cmf_version')) {
            if (version_compare(cmf_version(), '5.0.190312') >= 0 && class_exists('ZipArchive')) {
                $sdkFile = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'dysmsapi.zip';
                $zip = new \ZipArchive();
                if ($zip->open($sdkFile) === true) {
                    return $zip->extractTo(__DIR__);
                }
            }
        }

        return false;
    }

    /**
     * 卸载插件
     * @return bool
     */
    public function uninstall(): bool {
        return true;
    }

    /**
     * 实现send_mobile_verification_code钩子方法
     * @param array $param 参数
     * @return array
     */
    public function sendMobileVerificationCode(array $param): array {
        

        if (empty($param['phoneNumbers'])) {
            return ['error' => 1, 'message' => '未提供手机号码'];
        }

        return (new SmsService($this->getConfig()))->sendSms($param);
    }
    
}