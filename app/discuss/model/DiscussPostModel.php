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
namespace app\discuss\model;

use app\admin\model\RouteModel;
use think\Model;

/**
 * @property mixed id
 */
class DiscussPostModel extends Model
{
    /**
     * 模型名称
     * @var string
     */
    protected $name = 'discuss_post';

    protected $type = [
        'more' => 'array',
    ];

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    /**
     * 关联 user表
     * @return \think\model\relation\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('UserModel', 'user_id');
    }

    /**
     * 关联分类表
     * @return \think\model\relation\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('DiscussCategoryModel', 'discuss_category_post', 'category_id', 'post_id');
    }


    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function getPostContentAttr($value)
    {
        if (empty($value)) {
            return '';
        }
        return cmf_replace_content_file_url(htmlspecialchars_decode($value));
    }

    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function setPostContentAttr($value)
    {
        if (empty($value)) {
            return '';
        }
        return htmlspecialchars(cmf_replace_content_file_url(htmlspecialchars_decode($value), true));
    }

    /**
     * published_time 自动完成
     * @param $value
     * @return false|int
     */
    public function setPublishedTimeAttr($value)
    {
        return strtotime($value);
    }

    /**
     * 后台管理添加文章
     * @param array        $data       文章数据
     * @param array|string $categories 文章分类 id
     * @return $this
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function adminAddArticle($data, $categories)
    {
        $data['user_id'] = cmf_get_current_admin_id();

        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
            $data['thumbnail']         = $data['more']['thumbnail'];
        }

        if (!empty($data['more']['audio'])) {
            $data['more']['audio'] = cmf_asset_relative_url($data['more']['audio']);
        }

        if (!empty($data['more']['video'])) {
            $data['more']['video'] = cmf_asset_relative_url($data['more']['video']);
        }

        $this->save($data);

        if (is_string($categories)) {
            $categories = explode(',', $categories);
        }

        $this->categories()->save($categories);

        // $data['post_keywords'] = str_replace('，', ',', $data['post_keywords']);

        // $keywords = explode(',', $data['post_keywords']);

        // $this->addTags($keywords, $this->id);

        return $this;

    }
    
    public function addArticle($data, $categories)
    {
        $data['user_id'] = cmf_get_current_user_id();
        
        //echo '<pre>'.print_r($data,true).'</pre>';
        
        if (!empty($data['published_time'])) {
            $data['published_time']  = $data['published_time'];
        }
        
        
        
        
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
            $data['thumbnail']         = $data['more']['thumbnail'];
        }

        if (!empty($data['more']['audio'])) {
            $data['more']['audio'] = cmf_asset_relative_url($data['more']['audio']);
        }

        if (!empty($data['more']['video'])) {
            $data['more']['video'] = cmf_asset_relative_url($data['more']['video']);
        }

        $this->save($data);
        //echo '<pre>'.print_r($data,true).'</pre>';
        if (is_string($categories)) {
            $categories = explode(',', $categories);
        }

        $this->categories()->save($categories);

        // $data['post_keywords'] = str_replace('，', ',', $data['post_keywords']);

        // $keywords = explode(',', $data['post_keywords']);

        // $this->addTags($keywords, $this->id);

        return $this;

    }
    /**
     * 后台管理编辑文章
     * @param array        $data       文章数据
     * @param array|string $categories 文章分类 id
     * @return $this
     * @throws \think\Exception
     */
    public function adminEditArticle($data, $categories)
    {

        unset($data['user_id']);

        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
            $data['thumbnail']         = $data['more']['thumbnail'];
        }

        if (!empty($data['more']['audio'])) {
            $data['more']['audio'] = cmf_asset_relative_url($data['more']['audio']);
        }

        if (!empty($data['more']['video'])) {
            $data['more']['video'] = cmf_asset_relative_url($data['more']['video']);
        }

        unset($data['categories']);

        $article = self::find($data['id']);

        $article->save($data);

        if (is_string($categories)) {
            $categories = explode(',', $categories);
        }

        $oldCategoryIds        = DiscussCategoryPostModel::where('post_id', $data['id'])->column('category_id');
        $sameCategoryIds       = array_intersect($categories, $oldCategoryIds);
        $needDeleteCategoryIds = array_diff($oldCategoryIds, $sameCategoryIds);
        $newCategoryIds        = array_diff($categories, $sameCategoryIds);

        if (!empty($needDeleteCategoryIds)) {
            $article->categories()->detach($needDeleteCategoryIds);
        }

        if (!empty($newCategoryIds)) {
            $article->categories()->attach(array_values($newCategoryIds));
        }


        // $data['post_keywords'] = str_replace('，', ',', $data['post_keywords']);

        // $keywords = explode(',', $data['post_keywords']);

        // $this->addTags($keywords, $data['id']);

        return $this;

    }


    /**
     * @param $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function adminDeletePage($data)
    {

        if (isset($data['id'])) {
            $id = $data['id']; //获取删除id

            $res = $this->where('id', $id)->find();

            if ($res) {
                $res = json_decode(json_encode($res), true); //转换为数组

                $recycleData = [
                    'object_id'   => $res['id'],
                    'create_time' => time(),
                    'table_name'  => 'discuss_post#page',
                    'name'        => $res['post_title'],

                ];

                DiscussPostModel::startTrans(); //开启事务
                $transStatus = false;
                try {
                    DiscussPostModel::where('id', $id)->update([
                        'delete_time' => time()
                    ]);
                    RecycleBinModel::insert($recycleData);

                    $transStatus = true;
                    // 提交事务
                    DiscussPostModel::commit();
                } catch (\Exception $e) {

                    // 回滚事务
                    DiscussPostModel::rollback();
                }
                return $transStatus;


            } else {
                return false;
            }
        } elseif (isset($data['ids'])) {
            $ids = $data['ids'];

            $res = $this->where('id', 'in', $ids)
                ->select();

            if ($res) {
                $res = json_decode(json_encode($res), true);
                foreach ($res as $key => $value) {
                    $recycleData[$key]['object_id']   = $value['id'];
                    $recycleData[$key]['create_time'] = time();
                    $recycleData[$key]['table_name']  = 'discuss_post';
                    $recycleData[$key]['name']        = $value['post_title'];

                }

                DiscussPostModel::startTrans(); //开启事务
                $transStatus = false;
                try {
                    DiscussPostModel::where('id', 'in', $ids)
                        ->update([
                            'delete_time' => time()
                        ]);


                    RecycleBinModel::insertAll($recycleData);

                    $transStatus = true;
                    // 提交事务
                    DiscussPostModel::commit();

                } catch (\Exception $e) {

                    // 回滚事务
                    DiscussPostModel::rollback();


                }
                return $transStatus;


            } else {
                return false;
            }

        } else {
            return false;
        }
    }

}
