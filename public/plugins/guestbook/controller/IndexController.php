<?php
// +----------------------------------------------------------------------
// | Wien Designs [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Wien Designs All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <oliverwien@yeah.net>
// +----------------------------------------------------------------------
namespace plugins\guestbook\controller;

use cmf\controller\PluginBaseController;
use plugins\guestbook\model\PluginGuestbookModel;

use think\lang;
use think\Cookie;

class IndexController extends PluginBaseController
{

    /**
     * 提交留言
     */
    public function addMsg()
    {
        // 获取post数据
        $data = $this->request->param();
        // //读取当前系统语言，结合本人的sy_switch_lang_demo插件使用
        // $lang = Cookie('lang');
        // //获取当前插件目录地址
        // $langPath = $this-> getPlugin()->getPluginPath();
        // //判断当前语言获取当前语言包
        // if ($lang == "en" || $lang == "en-us" || $lang == "en-gb") {
        //     lang($langPath . 'lang/en-us.php');

        // } else {
        //     lang($langPath . 'lang/zh-cn.php');
        // }
        // 数据验证
        $result = $this->validate($data, 'Guestbook');
        if ($result !== true) {
            $this->error($result);
        }

        // 实例化模型
        $GuestbookModel = new PluginGuestbookModel();
        $GuestbookModel->save($data);
        $this->success(lang('add_success'));
    }

}
