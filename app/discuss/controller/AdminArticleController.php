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

use app\admin\model\ThemeModel;

use app\discuss\model\DiscussPostModel;
use app\discuss\model\DiscussCategoryModel;
use app\discuss\model\DiscussCategoryPostModel;

use app\discuss\service\TopicService;

use app\portal\model\RecycleBinModel;

class AdminArticleController extends AdminBaseController
{
    /**
     * 话题列表
     * @adminMenu(
     *     'name'   => '话题列表',
     *     'parent' => 'discuss/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '话题列表',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $param = $this->request->param();

        $categoryId = $this->request->param('category', 0, 'intval');

        $topicService = new TopicService();
        $data        = $topicService->adminArticleList($param);

        $data->appends($param);

        $discussCategoryModel = new DiscussCategoryModel();
        $categoryTree        = $discussCategoryModel->adminCategoryTree($categoryId);

        $this->assign('start_time', isset($param['start_time']) ? $param['start_time'] : '');
        $this->assign('end_time', isset($param['end_time']) ? $param['end_time'] : '');
        $this->assign('keyword', isset($param['keyword']) ? $param['keyword'] : '');
        $this->assign('articles', $data->items());
        $this->assign('category_tree', $categoryTree);
        $this->assign('category', $categoryId);
        $this->assign('page', $data->render());


        return $this->fetch();
    }

    public function add()
    {
        
        $themeModel        = new ThemeModel();
        $articleThemeFiles = $themeModel->getActionThemeFiles('discuss/Article/index');
        $this->assign('article_theme_files', $articleThemeFiles);
        return $this->fetch();
    }

    public function addPost()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();

            //状态只能设置默认值。未发布、未置顶、未推荐
            $data['post']['post_status'] = 0;
            $data['post']['is_top']      = 0;
            $data['post']['recommended'] = 0;

            $post = $data['post'];

            // $result = $this->validate($post, 'AdminArticle');
            // if ($result !== true) {
            //     $this->error($result);
            // }

            $discussPostModel = new DiscussPostModel();

            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }

            if (!empty($data['file_names']) && !empty($data['file_urls'])) {
                $data['post']['more']['files'] = [];
                foreach ($data['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
                }
            }


            $discussPostModel->adminAddArticle($data['post'], $data['post']['categories']);

            $data['post']['id'] = $discussPostModel->id;
         
            $this->success('添加成功!', url('AdminArticle/edit', ['id' => $discussPostModel->id]));
        }
    }
    
    public function edit()
    {

        $id = $this->request->param('id', 0, 'intval');

        $discussPostModel   = new DiscussPostModel();
        $post              = $discussPostModel->where('id', $id)->find();
        $postCategories    = $post['categories'];
        $postCategoryIds   = [];
        $newPostCategories = [];
        foreach ($postCategories as $postCategory) {
            $newPostCategories[] = $postCategory['name'];
            $postCategoryIds[]   = $postCategory['id'];
        }
        $postCategoryIds = implode(',', $postCategoryIds);

        $themeModel        = new ThemeModel();
        $articleThemeFiles = $themeModel->getActionThemeFiles('discuss/Article/index');
        $this->assign('article_theme_files', $articleThemeFiles);
        $this->assign('post', $post);
        $this->assign('post_categories', $newPostCategories);
        $this->assign('post_category_ids', $postCategoryIds);

        return $this->fetch();
    }

    public function editPost()
    {

        if ($this->request->isPost()) {
            $data = $this->request->param();

            //需要抹除发布、置顶、推荐的修改。
            unset($data['post']['post_status']);
            unset($data['post']['is_top']);
            unset($data['post']['recommended']);

            $post   = $data['post'];
            // $result = $this->validate($post, 'AdminArticle');
            // if ($result !== true) {
            //     $this->error($result);
            // }

            $discussPostModel   = new DiscussPostModel();

            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }

            if (!empty($data['file_names']) && !empty($data['file_urls'])) {
                $data['post']['more']['files'] = [];
                foreach ($data['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
                }
            }

            $discussPostModel->adminEditArticle($data['post'], $data['post']['categories']);


            $this->success('保存成功!');

        }
    }
    public function delete()
    {
        $param           = $this->request->param();
        $discussPostModel = new DiscussPostModel();

        if (isset($param['id'])) {
            $id           = $this->request->param('id', 0, 'intval');
            $result       = $discussPostModel->where('id', $id)->find();
            $data         = [
                'object_id'   => $result['id'],
                'create_time' => time(),
                'table_name'  => 'discuss_post',
                'name'        => $result['post_title'],
                'user_id'     => cmf_get_current_admin_id()
            ];
            $resultPortal = $discussPostModel
                ->where('id', $id)
                ->update(['delete_time' => time()]);
            if ($resultPortal) {
                DiscussCategoryPostModel::where('post_id', $id)->update(['status' => 0]);
                //PortalTagPostModel::where('post_id', $id)->update(['status' => 0]);

                RecycleBinModel::insert($data);
            }
            $this->success("删除成功！", '');

        }

        if (isset($param['ids'])) {
            $ids     = $this->request->param('ids/a');
            $recycle = $discussPostModel->where('id', 'in', $ids)->select();
            $result  = $discussPostModel->where('id', 'in', $ids)->update(['delete_time' => time()]);
            if ($result) {
                DiscussCategoryPostModel::where('post_id', 'in', $ids)->update(['status' => 0]);
                //PortalTagPostModel::where('post_id', 'in', $ids)->update(['status' => 0]);
                foreach ($recycle as $value) {
                    $data = [
                        'object_id'   => $value['id'],
                        'create_time' => time(),
                        'table_name'  => 'discuss_post',
                        'name'        => $value['post_title'],
                        'user_id'     => cmf_get_current_admin_id()
                    ];
                    RecycleBinModel::insert($data);
                }
                $this->success("删除成功！", '');
            }
        }
    }
    public function publish()
    {
        $param           = $this->request->param();
        $discussPostModel = new DiscussPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');
            $discussPostModel->where('id', 'in', $ids)->update(['post_status' => 1, 'published_time' => time()]);
            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');
            $discussPostModel->where('id', 'in', $ids)->update(['post_status' => 0]);
            $this->success("取消发布成功！", '');
        }

    }

    public function top()
    {
        $param           = $this->request->param();
        $discussPostModel = new DiscussPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');

            $discussPostModel->where('id', 'in', $ids)->update(['is_top' => 1]);

            $this->success("置顶成功！", '');

        }

        if (isset($_POST['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');

            $discussPostModel->where('id', 'in', $ids)->update(['is_top' => 0]);

            $this->success("取消置顶成功！", '');
        }
    }

    public function recommend()
    {
        $param           = $this->request->param();
        $discussPostModel = new DiscussPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');

            $discussPostModel->where('id', 'in', $ids)->update(['recommended' => 1]);

            $this->success("推荐成功！", '');

        }
        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');

            $discussPostModel->where('id', 'in', $ids)->update(['recommended' => 0]);

            $this->success("取消推荐成功！", '');

        }
    }

    public function listOrder()
    {
        parent::listOrders('discuss_category_post');
        $this->success("排序更新成功！", '');
    }
}
