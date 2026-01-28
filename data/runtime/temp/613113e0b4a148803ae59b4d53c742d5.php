<?php /*a:2:{s:91:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/portal/admin_article/index.html";i:1735371315;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/header.html";i:1760897858;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_star/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- 引入 layui.css -->
     <link href="/themes/admin_star/public/assets/layui/css/layui.css" rel="stylesheet">
     <link href="/themes/admin_star/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php 
        $is_mobile=cmf_is_mobile();
        $_static_version=rand(100000,999999);
        $cmf_version=cmf_version();
        if (preg_match("/^(8|6)\./",$cmf_version)) {
        $_app=app()->http->getName();
        }else{
        $_app=request()->module();
        }
     ?>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            API_ROOT: {api: '/api/'},
            APP: '<?php echo $_app; ?>'/*当前应用名*/,
            IS_MOBILE: <?php echo !empty($_is_mobile) ? 'true'  :  'false'; ?>,
            lang: function (langKey, params) {
                var lang = {
                    LOGIN_INVALID_TIPS: "<?php echo lang('LOGIN_INVALID_TIPS'); ?>",
                    'Please select at least one': "<?php echo lang('Please select at least one'); ?>",
                    Close: "<?php echo lang('CLOSE'); ?>",
                    'You sure you want to delete it?': "<?php echo lang('You sure you want to delete it?'); ?>",
                    'OK': "<?php echo lang('OK'); ?>",
                    'Are you sure you want to do this?':"<?php echo lang('Are you sure you want to do this?'); ?>"
                };

                return typeof lang[langKey] === 'undefined' ? langKey : lang[langKey];

            }
        };
    </script>
    <script src="/themes/admin_star/public/assets/js/jquery-1.12.4.min.js"></script>
    <script src="/themes/admin_star/public/assets/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_star/public/assets/js/bootstrap.min.js"></script>
    <script src="/themes/admin_star/public/assets/layui/layui.js"></script>
    <script>
        Wind.alias({noty:'/themes/admin_star/public/assets/js/noty-2.4.1.js'})
    </script>
    
    
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        layui.config({
            base: '/themes/admin_star/public/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use('index');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container: 'body',
                html: true,
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
    <block name="scripts"></block>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief js-check-wrap">
                <ul class="layui-tab-title">
                    <li class="layui-this"><a href="javascript:;">文章管理</a></li>
                    <li><a href="<?php echo url('AdminArticle/add'); ?>">添加文章</a></li>
                </ul>
                <div class="layui-tab-content">
                    <form class="layui-form layui-form-pane" method="get" action="<?php echo url('AdminArticle/index'); ?>">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">分类:</label>
                                <div class="layui-input-inline" style="width: 140px;">
                                    <select class="layui-select" name="category">
                                        <option value='0'>全部</option>
                                        <?php echo (isset($category_tree) && ($category_tree !== '')?$category_tree:''); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">时间:</label>
                                <div class="layui-input-inline" style="width: 140px;">
                                    <input type="text" class="layui-input" id="startTime" name="start_time"
                                           value="<?php echo (isset($start_time) && ($start_time !== '')?$start_time:''); ?>" autocomplete="off" placeholder="开始时间">
                                </div>
                                <div class="layui-form-mid">-</div>
                                <div class="layui-input-inline" style="width: 140px;">
                                    <input type="text" class="layui-input" id="endTime" name="end_time"
                                           value="<?php echo (isset($end_time) && ($end_time !== '')?$end_time:''); ?>" autocomplete="off" placeholder="结束时间">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">关键字:</label>
                                <div class="layui-input-inline" style="width: 200px;">
                                    <input type="text" class="layui-input" name="keyword" 
                                           value="<?php echo (isset($keyword) && ($keyword !== '')?$keyword:''); ?>" placeholder="请输入关键字...">
                                </div>
                                <div class="layui-input-inline" style="margin-right: 0;">
                                    <button class="layui-btn" type="submit"><i class="layui-icon layui-icon-search"></i>搜索</button>
                                    <a class="layui-btn layui-btn-danger" href="<?php echo url('AdminArticle/index'); ?>">清空</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form class="js-ajax-form layui-form" action="" method="post">
                        <div class="layui-btn-group">
                            <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                                <button class="layui-btn layui-btn-xs js-ajax-submit" type="submit"
                                        data-action="<?php echo url('AdminArticle/listOrder'); ?>">
                                    <i class="layui-icon layui-icon-sort"></i> <?php echo lang('SORT'); ?>
                                </button>
                            <?php endif; ?>
                            <button class="layui-btn layui-btn-xs layui-btn-normal js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/publish',array('yes'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-release"></i> 发布
                            </button>
                            <button class="layui-btn layui-btn-xs layui-btn-warm js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/publish',array('no'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-close"></i> 取消发布
                            </button>
                            <button class="layui-btn layui-btn-xs js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/top',array('yes'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-top"></i> 置顶
                            </button>
                            <button class="layui-btn layui-btn-xs layui-btn-warm js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/top',array('no'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-down"></i> 取消置顶
                            </button>
                            <button class="layui-btn layui-btn-xs js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/recommend',array('yes'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-praise"></i> 推荐
                            </button>
                            <button class="layui-btn layui-btn-xs layui-btn-warm js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/recommend',array('no'=>1)); ?>" data-subcheck="true">
                                <i class="layui-icon layui-icon-tread"></i> 取消推荐
                            </button>
                            <button class="layui-btn layui-btn-xs layui-btn-danger js-ajax-submit" type="submit"
                                    data-action="<?php echo url('AdminArticle/delete'); ?>" data-subcheck="true" 
                                    data-msg="您确定删除除吗？">
                                <i class="layui-icon layui-icon-delete"></i> <?php echo lang('DELETE'); ?>
                            </button>
                        </div>

                        <table class="layui-table">
                            <thead>
                                <tr>
                                    <th width="16">
                                        <input type="checkbox" lay-skin="primary" lay-filter="allChoose" class="js-check-all" data-direction="x" data-checklist="js-check-x">
                                    </th>
                                    <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                                        <th width="50"><?php echo lang('SORT'); ?></th>
                                    <?php endif; ?>
                                    <th>标题</th>
                                    <th>分类</th>
                                    <th width="80">作者</th>
                                    <th width="80">点击量</th>
                                    <th width="80">评论量</th>
                                    <th width="160">关键字/来源<br>摘要/缩略图</th>
                                    <th width="160">更新时间</th>
                                    <th width="160">发布时间</th>
                                    <th width="150">状态</th>
                                    <th width="120">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($articles) || $articles instanceof \think\Collection || $articles instanceof \think\Paginator): if( count($articles)==0 ) : echo "" ;else: foreach($articles as $key=>$vo): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" lay-skin="primary" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo $vo['id']; ?>">
                                    </td>
                                    <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                                        <td>
                                            <input name="list_orders[<?php echo $vo['post_category_id']; ?>]" class="layui-input layui-input-sm" 
                                                   type="text" value="<?php echo $vo['list_order']; ?>">
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                                            <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'],'cid'=>$vo['category_id'])); ?>"
                                               target="_blank"><?php echo $vo['post_title']; ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>"
                                               target="_blank"><?php echo $vo['post_title']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(is_array($vo['categories']) || $vo['categories'] instanceof \think\Collection || $vo['categories'] instanceof \think\Paginator): if( count($vo['categories'])==0 ) : echo "" ;else: foreach($vo['categories'] as $key=>$voo): ?>
                                            <span class="layui-badge layui-bg-blue">
                                                <a href="<?php echo cmf_url('portal/List/index',array('id'=>$voo['id'])); ?>"
                                                   target="_blank" style="color: white;"><?php echo $voo['name']; ?></a>
                                            </span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </td>
                                    <td><?php echo $vo['user_nickname']; ?></td>
                                    <td><?php echo (isset($vo['post_hits']) && ($vo['post_hits'] !== '')?$vo['post_hits']:0); ?></td>
                                    <td><?php echo (isset($vo['comment_count']) && ($vo['comment_count'] !== '')?$vo['comment_count']:'0'); ?></td>
                                    <td>
                                        <?php if(!(empty($vo['post_keywords']) || (($vo['post_keywords'] instanceof \think\Collection || $vo['post_keywords'] instanceof \think\Paginator ) && $vo['post_keywords']->isEmpty()))): ?>
                                            <i class="layui-icon layui-icon-ok"></i>
                                        <?php else: ?>
                                            <i class="layui-icon layui-icon-close"></i>
                                        <?php endif; if(!(empty($vo['post_source']) || (($vo['post_source'] instanceof \think\Collection || $vo['post_source'] instanceof \think\Paginator ) && $vo['post_source']->isEmpty()))): ?>
                                            <i class="layui-icon layui-icon-ok"></i>
                                        <?php else: ?>
                                            <i class="layui-icon layui-icon-close"></i>
                                        <?php endif; if(!(empty($vo['post_excerpt']) || (($vo['post_excerpt'] instanceof \think\Collection || $vo['post_excerpt'] instanceof \think\Paginator ) && $vo['post_excerpt']->isEmpty()))): ?>
                                            <i class="layui-icon layui-icon-ok"></i>
                                        <?php else: ?>
                                            <i class="layui-icon layui-icon-close"></i>
                                        <?php endif; if(!(empty($vo['more']['thumbnail']) || (($vo['more']['thumbnail'] instanceof \think\Collection || $vo['more']['thumbnail'] instanceof \think\Paginator ) && $vo['more']['thumbnail']->isEmpty()))): ?>
                                            <a href="javascript:parent.imagePreviewDialog('<?php echo cmf_get_image_preview_url($vo['more']['thumbnail']); ?>');">
                                                <i class="layui-icon layui-icon-picture"></i>
                                            </a>
                                        <?php else: ?>
                                            <i class="layui-icon layui-icon-close"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!(empty($vo['update_time']) || (($vo['update_time'] instanceof \think\Collection || $vo['update_time'] instanceof \think\Paginator ) && $vo['update_time']->isEmpty()))): ?>
                                            <?php echo date('Y-m-d H:i',$vo['update_time']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(empty($vo['published_time']) || (($vo['published_time'] instanceof \think\Collection || $vo['published_time'] instanceof \think\Paginator ) && $vo['published_time']->isEmpty())): ?>
                                            未发布
                                        <?php else: ?>
                                            <?php echo date('Y-m-d H:i',$vo['published_time']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!(empty($vo['post_status']) || (($vo['post_status'] instanceof \think\Collection || $vo['post_status'] instanceof \think\Paginator ) && $vo['post_status']->isEmpty()))): ?>
                                            <span class="layui-badge layui-bg-green" title="已发布">
                                                <i class="layui-icon layui-icon-ok"></i>
                                            </span>
                                        <?php else: ?>
                                            <span class="layui-badge layui-bg-gray" title="未发布">
                                                <i class="layui-icon layui-icon-close"></i>
                                            </span>
                                        <?php endif; if(!(empty($vo['is_top']) || (($vo['is_top'] instanceof \think\Collection || $vo['is_top'] instanceof \think\Paginator ) && $vo['is_top']->isEmpty()))): ?>
                                            <span class="layui-badge" title="已置顶">
                                                <i class="layui-icon layui-icon-top"></i>
                                            </span>
                                        <?php else: ?>
                                            <span class="layui-badge layui-bg-gray" title="未置顶">
                                                <i class="layui-icon layui-icon-down"></i>
                                            </span>
                                        <?php endif; if(!(empty($vo['recommended']) || (($vo['recommended'] instanceof \think\Collection || $vo['recommended'] instanceof \think\Paginator ) && $vo['recommended']->isEmpty()))): ?>
                                            <span class="layui-badge layui-bg-blue" title="已推荐">
                                                <i class="layui-icon layui-icon-praise"></i>
                                            </span>
                                        <?php else: ?>
                                            <span class="layui-badge layui-bg-gray" title="未推荐">
                                                <i class="layui-icon layui-icon-tread"></i>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="layui-btn layui-btn-xs" href="<?php echo url('AdminArticle/edit',array('id'=>$vo['id'])); ?>">
                                            <i class="layui-icon layui-icon-edit"></i>
                                        </a>
                                        <a class="layui-btn layui-btn-xs layui-btn-danger js-ajax-delete"
                                           href="<?php echo url('AdminArticle/delete',array('id'=>$vo['id'])); ?>">
                                            <i class="layui-icon layui-icon-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
<script>
layui.use(['form', 'laydate'], function(){
    var form = layui.form,
        laydate = layui.laydate;
    
    // 日期时间范围
    laydate.render({
        elem: '#startTime',
        type: 'datetime'
    });
    
    laydate.render({
        elem: '#endTime',
        type: 'datetime'
    });
    
    // 全选
    form.on('checkbox(allChoose)', function(data){
        var child = $(data.elem).closest('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item){
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
});

function openPortalArticleEditDialog(obj) {
    var $obj = $(obj);
    var href = $obj.data('href');
    parent.openIframeLayer(href, '编辑文章', {
        area: GV.IS_MOBILE ? ['100%', '100%'] : ['95%', '95%'],
        offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
        end: function () {
            location.reload();
        }
    });
}
</script>
</body>
</html>
