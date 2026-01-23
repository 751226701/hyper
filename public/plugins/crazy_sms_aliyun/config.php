<?php
/**
 * 阿里云短信插件
 *
 * Author：惠达浪
 * Blog： https://www.qdcrazy.cn
 * Email： crazys@126.com
 * Date： 2019/07/15
 */

return [
    'accessKeyId'     => [
        'title' => 'AccessKey ID',
        'type'  => 'text',
        'value' => '',
        'tip'   => '参考<a href="https://help.aliyun.com/zh/ram/user-guide/create-an-accesskey-pair" target="_blank">创建AccessKey</a>。如果按阿里云推荐，将其设置在环境变量中，变量名必须为：“ALIBABA_CLOUD_ACCESS_KEY_ID”。'
    ],
    'accessKeySecret' => [
        'title' => 'AccessKey Secret',
        'type'  => 'text',
        'value' => '',
        'tip'   => '参考<a href="https://help.aliyun.com/zh/ram/user-guide/create-an-accesskey-pair" target="_blank">创建AccessKey</a>。如果按阿里云推荐，将其设置在环境变量中，变量名必须为：“ALIBABA_CLOUD_ACCESS_KEY_SECRET”。'
    ],
    'signName'        => [
        'title' => '默认短信签名名称',
        'type'  => 'text',
        'value' => '',
        'tip'   => '默认的签名名称，如需使用其它签名请在调用时指定。签名名称请在阿里云控制台<a href="https://dysms.console.aliyun.com/" target="_blank">短信服务</a>中查看。'
    ],
    'templateCode'    => [
        'title' => '默认模板CODE',
        'type'  => 'text',
        'value' => '',
        'tip'   => '默认的模板CODE，当使用其它模板时，需要在调用时指定模板CODE。模板CODE请在阿里云控制台<a href="https://dysms.console.aliyun.com/" target="_blank">短信服务</a>中查看。'
    ],
];