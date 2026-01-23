<?php
/**
 * 阿里云短信插件
 *
 * Author：惠达浪
 * Blog： https://www.qdcrazy.cn
 * Email： crazys@126.com
 * Date： 2024/11/06
 */

namespace plugins\crazy_sms_aliyun\service;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Darabonba\OpenApi\Models\Config;

class SmsService {
    private array $config;

    public function __construct($config) {
        $this->config = $config;
    }


    /**
     * 创建api服务客户端
     * @return Dysmsapi
     */
    private function createClient(): Dysmsapi {
        $config = new Config([
            // 您的AccessKey ID
            "accessKeyId"     => getenv('ALIBABA_CLOUD_ACCESS_KEY_ID') ?: $this->config['accessKeyId'],
            // 您的AccessKey Secret
            "accessKeySecret" => getenv('ALIBABA_CLOUD_ACCESS_KEY_SECRET') ?: $this->config['accessKeySecret'],
        ]);
        // 服务区域，国内国际通用
        $config->endpoint = 'dysmsapi.aliyuncs.com';
        return new Dysmsapi($config);
    }

    /**
     * 发送短信
     * @param array $params 待发送的参数
     * @return array
     */
    public function sendSms(array $params): array {
        $client = $this->createClient();

        $sendSmsRequest = new SendSmsRequest([
            'phoneNumbers'  => is_array($params['phoneNumbers']) ? implode(',', $params['phoneNumbers']) : $params['phoneNumbers'],
            'signName'      => $params['signName'] ?? $this->config['signName'],
            "templateCode"  => $params['templateCode'] ?? $this->config['templateCode'],
            'templateParam' => json_encode($params['templateParam'], JSON_UNESCAPED_UNICODE),
        ]);
        
        // 发送短信
        try {
            $response = $client->sendSmsWithOptions($sendSmsRequest, new RuntimeOptions([]));
            //return ['error' => 0, 'message' => "$response->body->toMap()"];
            return ['success' => 0, 'message' => "验证码发送成功！" ];
        } catch (\Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }

            return ['error' => 1, 'message' => Utils::assertAsString($error->message)];
        }
    }
}