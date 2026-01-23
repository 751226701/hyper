<?php
// +----------------------------------------------------------------------
// | Wien Designs [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Wien Designs All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <oliverwien@yeah.net>
// +----------------------------------------------------------------------
namespace plugins\guestbook\controller; //Demo插件英文名，改成你的插件英文就行了

use cmf\controller\PluginBaseController;
use plugins\guestbook\model\PluginGuestbookModel;

/**
 * Class AdminIndexController.
 *
 * @adminMenuRoot(
 *     'name'   =>'留言板插件',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 100,
 *     'icon'   =>'file-text',
 *     'remark' =>'留言板插件管理入口'
 * )
 */
class AdminIndexController extends PluginBaseController
{
    //初始化，检测是否可以管理
    function _initialize()
    {
        $adminId = cmf_get_current_admin_id();//获取后台管理员id，可判断是否登录
        if (!empty($adminId)) {
            $this->assign("admin_id", $adminId);
        } else {
            header('HTTP/1.1 404 Not Found');
            header('Status:404 Not Found');
            $this->error('非法登录！！');
        }
    }
    /**
     * 后台管理主界面
     * @adminMenu(
     *     'name'   => '留言板管理',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '管理用户留言',
     *     'param'  => ''
     * )
     */
    function index()
    {
        $guestbookModel = new PluginGuestbookModel();
        $guestbook = $guestbookModel->order("id DESC")->paginate(20);
        // 获取分页显示
        $page = $guestbook->render();
        $this->assign("guestbook", $guestbook);
        $this->assign("page", $page);
        return $this->fetch('/admin_index');
    }

    //查看留言详细信息
    function detail()
    {
        $id = $this->request->param('id', 0, 'intval');
        $guestbookModel = new PluginGuestbookModel();
        $detail = $guestbookModel->where(["id" => $id])->find();
        $this->assign("detail", $detail);
        return $this->fetch('/admin_detail');
    }

    //删除留言
    function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        $guestbookModel = new PluginGuestbookModel();
        $guestbookModel::destroy(['id' => $id]);
        $this->success('删除成功！');
    }
}
