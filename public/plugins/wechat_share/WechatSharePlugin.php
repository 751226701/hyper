<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 五五 <15093565100@163.com>
// +----------------------------------------------------------------------

namespace plugins\wechat_share;

use cmf\lib\Plugin;
use plugins\wechat_share\model\WechatModel;
use think\facade\Log;

class WechatSharePlugin extends Plugin
{
    public $info = [
        'name'        => 'WechatShare',
        'title'       => '微信公共号微信分享插件',
        'description' => '微信公共号微信分享插件',
        'status'      => 1,
        'author'      => '易东云',
        'version'     => '2.0',
        'demo_url'    => 'https://saas.ydc.show',
        'author_url'  => 'https://saas.ydc.show'
    ];

    public $hasAdmin = 0;//插件是否有后台管理界面

    // 插件安装
    public function install()
    {
        return true;//安装成功返回true，失败false
    }

    // 插件卸载
    public function uninstall()
    {
        return true;//卸载成功返回true，失败false
    }

    //实现的wechat_share钩子方法
    public function beforeFooterEnd($param)
    {
        $_WechatModel = new WechatModel();
        $url          = request()->url(true);//获取url
        $jsSign       = $_WechatModel->getJsSign($url);//获取jsapi签名

        $shareConfig  = [
                'debug'     => APP_DEBUG, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                'jsApiList' => [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareWeibo',
                    'onMenuShareQZone'
                ] // 必填，需要使用的JS接口列表
        ];
        if(!is_array($jsSign)){
            Log::error('微信分享：配置错误！请检查配置！');
            return false;
        }
        $shareConfig = array_merge($shareConfig, $jsSign);
        $share = [
            'link'=>$url,
        ];
        $share = array_merge($param,$share);
        $this->assign([
            'share'       => $share,
            'shareConfig' => $shareConfig
        ]);
        echo $this->fetch('widget');
    }
}
