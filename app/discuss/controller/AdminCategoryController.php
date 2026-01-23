<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\discuss\controller;

use cmf\controller\AdminBaseController;

use app\admin\model\RouteModel;
use app\admin\model\ThemeModel;

use app\discuss\model\DiscussCategoryPostModel;
use app\discuss\model\DiscussCategoryModel;

use app\portal\model\RecycleBinModel;

class AdminCategoryController extends AdminBaseController
{
    /**
     * 话题分类列表
     * @adminMenu(
     *     'name'   => '话题分类',
     *     'parent' => 'discuss/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',=2013-2019
     *     'remark' => '话题分类',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $discussCategoryModel = new DiscussCategoryModel();
        $keyword             = $this->request->param('keyword');

        if (empty($keyword)) {
            $categoryTree = $discussCategoryModel->adminCategoryTableTree();
            $this->assign('category_tree', $categoryTree);
        } else {
            $categories = $discussCategoryModel->where('name', 'like', "%{$keyword}%")
                ->where('delete_time', 0)->select();
            $this->assign('categories', $categories);
        }

        $this->assign('keyword', $keyword);

        return $this->fetch();
    }
    
    public function add()
    {

        $parentId            = $this->request->param('parent', 0, 'intval');
        $discussCategoryModel = new DiscussCategoryModel();
        $categoriesTree      = $discussCategoryModel->adminCategoryTree($parentId);

        $themeModel        = new ThemeModel();
        $listThemeFiles    = $themeModel->getActionThemeFiles('discuss/List/index');
        $articleThemeFiles = $themeModel->getActionThemeFiles('discuss/Article/index');

        $this->assign('list_theme_files', $listThemeFiles);
        $this->assign('article_theme_files', $articleThemeFiles);
        $this->assign('categories_tree', $categoriesTree);
        return $this->fetch();
    }
    
    
    public function addPost()
    {
        $discussCategoryModel = new DiscussCategoryModel();

        $data = $this->request->param();

        $result = $this->validate($data, 'DiscussCategory');

        if ($result !== true) {
            $this->error($result);
        }

        $result = $discussCategoryModel->addCategory($data);

        if ($result === false) {
            $this->error('添加失败!');
        }

        $this->success('添加成功!', url('AdminCategory/index'));
    }
    
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');
        if ($id > 0) {
            $discussCategoryModel = new DiscussCategoryModel();
            $category            = $discussCategoryModel->find($id)->toArray();

            $categoriesTree = $discussCategoryModel->adminCategoryTree($category['parent_id'], $id);

            $themeModel        = new ThemeModel();
            $listThemeFiles    = $themeModel->getActionThemeFiles('discuss/List/index');
            $articleThemeFiles = $themeModel->getActionThemeFiles('discuss/Article/index');

            $routeModel = new RouteModel();
            $alias      = $routeModel->getUrl('discuss/List/index', ['id' => $id]);

            $category['alias'] = $alias;
            $this->assign($category);
            $this->assign('list_theme_files', $listThemeFiles);
            $this->assign('article_theme_files', $articleThemeFiles);
            $this->assign('categories_tree', $categoriesTree);
            return $this->fetch();
        } else {
            $this->error('操作错误!');
        }

    }
    public function editPost()
    {
        $data = $this->request->param();

        $result = $this->validate($data, 'DiscussCategory');

        if ($result !== true) {
            $this->error($result);
        }

        $discussCategoryModel = new DiscussCategoryModel();

        $result = $discussCategoryModel->editCategory($data);

        if ($result === false) {
            $this->error('保存失败!');
        }

        $this->success('保存成功!');
    }
    
    public function select()
    {
        $ids                 = $this->request->param('ids');
        $selectedIds         = explode(',', $ids);
        $discussCategoryModel = new DiscussCategoryModel();

        $tpl = <<<tpl
<tr class='data-item-tr'>
    <td>
        <input type='checkbox' class='js-check' data-yid='js-check-y' data-xid='js-check-x' name='ids[]'
               value='\$id' data-name='\$name' \$checked>
    </td>
    <td>\$id</td>
    <td>\$spacer <a href='\$url' target='_blank'>\$name</a></td>
</tr>
tpl;

        $categoryTree = $discussCategoryModel->adminCategoryTableTree($selectedIds, $tpl);

        $categories = $discussCategoryModel->where('delete_time', 0)->select();

        $this->assign('categories', $categories);
        $this->assign('selectedIds', $selectedIds);
        $this->assign('categories_tree', $categoryTree);
        return $this->fetch();
    }

    public function listOrder()
    {
        parent::listOrders('discuss_category');
        $this->success("排序更新成功！", '');
    }

    public function toggle()
    {
        $data                = $this->request->param();
        $discussCategoryModel = new DiscussCategoryModel();
        $ids                 = $this->request->param('ids/a');

        if (isset($data['ids']) && !empty($data["display"])) {
            $discussCategoryModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $discussCategoryModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }

    }

    public function delete()
    {
        $discussCategoryModel = new DiscussCategoryModel();
        $id                  = $this->request->param('id');
        //获取删除的内容
        $findCategory = $discussCategoryModel->where('id', $id)->find();

        if (empty($findCategory)) {
            $this->error('分类不存在!');
        }
        //判断此分类有无子分类（不算被删除的子分类）
        $categoryChildrenCount = $discussCategoryModel->where(['parent_id' => $id, 'delete_time' => 0])->count();

        if ($categoryChildrenCount > 0) {
            $this->error('此分类有子类无法删除!');
        }

        // $categoryPostCount = DiscussCategoryPostModel::where('category_id', $id)->count();

        // if ($categoryPostCount > 0) {
        //     $this->error('此分类有话题无法删除!');
        // }

        $data   = [
            'object_id'   => $findCategory['id'],
            'create_time' => time(),
            'table_name'  => 'discuss_category',
            'name'        => $findCategory['name']
        ];
        $result = $discussCategoryModel
            ->where('id', $id)
            ->update(['delete_time' => time()]);
        if ($result) {
            RecycleBinModel::insert($data);
            $this->success('删除成功!');
        } else {
            $this->error('删除失败');
        }
    }
    
}
