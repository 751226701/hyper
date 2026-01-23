<?php
// +----------------------------------------------------------------------
// | Author: Sam
// +----------------------------------------------------------------------
namespace plugins\hi_theme\controller;
use cmf\controller\PluginAdminBaseController;
use app\admin\model\ThemeModel;
use plugins\hi_theme\model\PluginHiThemeModel;
use think\facade\Db;

/**
 * Class AdminIndexController
 * @package plugins\hi_theme\controller
 * @adminMenuRoot(
 *     'name'   =>'站点管理',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 1000,
 *     'icon'   =>'dashboard',
 *     'remark' =>'设置入口'
 * )
 */
class AdminIndexController extends PluginAdminBaseController
{
  
    protected function initialize()
    {
        parent::initialize();
        $adminId = cmf_get_current_admin_id(); //获取后台管理员id，可判断是否登录
        if (!empty($adminId)) {
            $this->assign('admin_id', $adminId);
        }
    }


    /**
     * 站点设置
     * @adminMenu(
     *     'name'   => '站点设置',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 1000,
     *     'icon'   => '',
     *     'remark' => '站点设置',
     *     'param'  => ''
     * )
     */
    public function index()
    {
		$datalist = Db::name('plugin_theme')->order("id DESC")->paginate(20);
        $page = $datalist->render();
        $this->assign("datalist", $datalist);
        $this->assign("page", $page);
        return $this->fetch('/admin_index');
    }
    public function add()
    {
        $id = $this->request->param();
        $themeModel = new ThemeModel();
        $themes     = $themeModel->select();
        $this->assign("themes", $themes);
        return $this->fetch('/add');
    }
    public function add_post()
    {
        $param = $this->request->param();;
        //echo '<pre>'.print_r($param,true).'</pre>';
        $pluginHiThemeModel = new PluginHiThemeModel();
        $pluginHiThemeModel->save($param);
        $this->success('提交成功！');
    }



    public function edit()
    {

        $id = $this->request->param('id', 0, 'intval');
        $pluginHiThemeModel = new PluginHiThemeModel();
        $data = $pluginHiThemeModel->where(["id" => $id])->find();
        $this->assign("data", $data);
        
        $themeModel = new ThemeModel();
        $themes     = $themeModel->select();
        $this->assign("themes", $themes);
        
        return $this->fetch('/edit');

    }
    public function edit_post()
    {
        
        $param = $this->request->param();
        $user  = PluginHiThemeModel::find($param['id'])->save($param);
        $this->success('编辑成功！');
    }
    //删除
	function delete()
	{
		$_POST = $this->request->param();
		$pluginHiThemeModel = new PluginHiThemeModel();
		Db::name('plugin_theme')->where('id', $_POST['id'])->delete();
		$this->success('删除成功！');
	}

}