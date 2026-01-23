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
namespace app\user\controller;

use cmf\controller\HomeBaseController;

use app\discuss\model\DiscussPostModel;
use app\discuss\model\DiscussCategoryModel;
use app\discuss\model\DiscussCategoryPostModel;

use app\user\validate\DiscussValidate;

use app\portal\model\RecycleBinModel;

class DiscussController extends HomeBaseController
{
   
    public function index()
    {
        if (!cmf_get_current_user()) {
            $this->error('未登录账户！');
        }
        $user              = cmf_get_current_user();
        $this->assign($user);
        
        $discussPostModel = new DiscussPostModel();
        $data = $discussPostModel->where('user_id', $user['id'])->where('delete_time', 0)->order("id DESC")->paginate(10);
        $this->assign('page', $data->render());//单独提取分页出来
        $this->assign("data",$data);

        
        return $this->fetch();
    }
    
    public function add()
    {
        if (!cmf_get_current_user()) {
            $this->error('未登录账户！');
        }
        $user              = cmf_get_current_user();
        $this->assign($user);
        
        // $discussCategoryModel = new DiscussCategoryModel();
        
        // $categoryList = $discussCategoryModel->where('delete_time', 0)->select();
        
        // $this->assign("categoryList",$categoryList);
        
        return $this->fetch();
    }
    public function addPost()
    {
        $data = $this->request->param();
        //$user_id = cmf_get_current_user_id();
        
        
        $discussCategoryModel = new DiscussCategoryModel();
        $gory = $discussCategoryModel->where('id', $data['categories'])->find();
     
        
        if($gory['review']==0){
            $data['post_status'] = 1;
            $data['published_time'] = time();
        }else{
            $data['post_status'] = 0;
        }
        
        //状态只能设置默认值。未发布、未置顶、未推荐
        
        $data['is_top']      = 0;
        $data['recommended'] = 0;
        
        
        
        //$data['user_id']= $user_id;
        
        $result = $this->validate($data, 'Discuss');
        if ($result !== true) {
            $this->error($result);
        }
        
        //echo '<pre>'.print_r($data,true).'</pre>';
        $discussPostModel = new DiscussPostModel();
        
        $result = $discussPostModel->addArticle($data, $data['categories']);
        // $result = $discussPostModel->save($data);
        //
        
        //echo '<pre>'.print_r($result['id'],true).'</pre>';
        
        $discussPostModel->where('id', $result['id'])->update([ 'published_time' => time()]);
         
        $this->success('添加成功!', url('user/discuss/index'));
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
    
    
    public function delete()
    {

        $id           = $this->request->param('id', 0, 'intval');
        $discussPostModel = new DiscussPostModel();
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




}
