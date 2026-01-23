<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\discuss\controller;

use cmf\controller\HomeBaseController;
use app\discuss\model\DiscussCategoryModel;
use app\discuss\model\DiscussPostModel;

use app\discuss\service\TopicService;

class ListController extends HomeBaseController
{
    /***
     * 列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        
        $param = $this->request->param();
        
        $discussCategoryModel = new DiscussCategoryModel();
        $category = $discussCategoryModel->where('id', $param['id'])->where('status', 1)->find();
        $this->assign('category', $category);


        $this->assign('keyword', isset($param['keyword']) ? $param['keyword'] : '');
        
        
        $listTpl = empty($category['list_tpl']) ? 'list' : $category['list_tpl'];
        return $this->fetch('/' . $listTpl);
        
    }

}
