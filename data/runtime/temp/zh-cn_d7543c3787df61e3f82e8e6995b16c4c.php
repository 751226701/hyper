<?php /*a:7:{s:71:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/portal/list.html";i:1768468643;s:71:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/head.html";i:1765520921;s:75:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/function.html";i:1768462231;s:73:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/config.html";i:1759133767;s:70:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/nav.html";i:1768899266;s:73:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/footer.html";i:1769077938;s:74:"/www/wwwroot/www.hyperionrobot.com/public/themes/robai/public/scripts.html";i:1768562960;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<title><?php echo $category['name']; ?> <?php echo $category['seo_title']; ?> <?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></title>
		<meta name="keywords" content="<?php echo $category['seo_keywords']; ?>,<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>"/>
		<meta name="description" content="<?php echo $category['seo_description']; ?>,<?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?>">
		
<?php
use app\portal\model\PortalPostModel;
use app\portal\model\PortalCategoryModel;
use app\portal\model\PortalTagModel;
use think\Db;
/**
 * 返回指定所有标签
 */
if (!function_exists('_wien_tags')) {
    function _wien_tags()
    {
        $portalTagModel = new PortalTagModel();
        $tags = $portalTagModel->alias('tag')->select();
        return $tags;
    }
}
/**
 * 返回指定分类下的子分类
 */
if (!function_exists('_wien_subCategories')) {
    function _wien_subCategories($categoryId,$field='*')
    {
        $PortalCategoryModel = new PortalCategoryModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'parent_id'   => $categoryId
        ];

        return $PortalCategoryModel->field($field)->where($where)->select();
    }
}
/**
 * 返回指定分类及一级子分类ID字符串
 */
if (!function_exists('_wien_allSubCategoriesIds')) {
    function _wien_allSubCategoriesIds($categoryId)
    {
        $PortalCategoryModel = new PortalCategoryModel();
        $where = [
            'status' => 1,
            'delete_time' => 0,
            'parent_id' => $categoryId
        ];
        $order = [
            'list_order' => 'desc',
        ];
        $data = $PortalCategoryModel->where($where)->order($order)->select();
        $ids = "";
        foreach ($data as $t) {
            $ids = $ids . "," . $t['id'];
        }
        $cid_list = $categoryId . $ids;
        return $cid_list;
    }
}
/**
 * 获取指定分类的父级分类id
 */
if (!function_exists('_wien_parentCategoriesId')) {
    function _wien_parentCategoriesId($categoryId)
    {

        $portalCategoryModel = new PortalCategoryModel();

        $path = $portalCategoryModel->where(['id' => $categoryId])->value('path');

        //根据"-"分割成数组
        $var=explode("-",$path);
        //取倒数第二个数字
        $parentId=$var[count($var)-2];

        return $parentId;
    }
}
/**
 * 获取指定页面id的内容
 */
if (!function_exists('_wien_getPage')) {
    function _wien_getPage($pageId)
    {
        $PortalPostModel = new PortalPostModel();
        $where = [
            'post_type'     => 2,
            'delete_time'   => 0,
            'id'   => $pageId
        ];
        return $PortalPostModel->where($where)->select();
    }
}
/**
 * 获取指定id的分类名
 */
if (!function_exists('_wien_getCategoryName')) {
    function _wien_getCategoryName($id)
    {
        $portalCategoryModel = new PortalCategoryModel();
        $where = [
            'delete_time'   => 0,
            'id'   => $id
        ];
        return $portalCategoryModel->where($where)->find();
    }
}




use app\discuss\model\DiscussCategoryModel;

/**
 * 获取指定分类的父级分类id
 */
if (!function_exists('_wien_discussParentCategoriesId')) {
    function _wien_discussParentCategoriesId($categoryId)
    {

        $discussCategoryModel = new DiscussCategoryModel();

        $path = $discussCategoryModel->where(['id' => $categoryId])->value('path');

        //根据"-"分割成数组
        $var=explode("-",$path);
        //取倒数第二个数字
        $parentId=$var[count($var)-2];

        return $parentId;
    }
}


    use app\discuss\service\TopicService;
 ?>
<meta name="author" content="Oliver Wien">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<!-- 默认 -->
<link rel="shortcut icon" href="/themes/robai/public/favicon.ico" type="image/x-icon">
<!-- 自定义 -->
<link href="/themes/robai/public/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/themify-icons.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/flaticon-set.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/elegant-icons.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/magnific-popup.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/owl.carousel.min.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/owl.theme.default.min.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/animate.css" rel="stylesheet" />
<link href="/themes/robai/public/assets/css/bootsnav.css" rel="stylesheet" />
<link href="/themes/robai/public/style.css" rel="stylesheet">
<link href="/themes/robai/public/assets/css/responsive.css" rel="stylesheet" />


<!--YDC新增-->
<link rel="stylesheet" href="/static/fontawesome-free-7.1.0-web/css/all.min.css" />
<link rel="stylesheet" href="/static/remix-v4.6.0/remix.v460.min.css" />

<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "/",
        WEB_ROOT: "/",
        JS_ROOT: "static/js/"
    };
</script>
<!-- Jquery JS -->
<script src="/themes/robai/public/assets/js/jquery.min.js"></script>
<script src="/themes/robai/public/assets/js/jquery-migrate-3.0.0.js"></script>
<script src="/static/js/wind.js"></script>
		<?php 
    hook('before_head_end',null,false);
 ?>
	</head>
	<body>
		<!-- Start Header Top 
============================================= -->
<!--
<div class="top-bar-area bg-dark text-light inline inc-border">
    <div class="container-full">
        <div class="row align-center">
            
            <div class="col-lg-7 col-md-12 left-info">
                <div class="item-flex">
                    <ul class="list">
                        <li>
                            <i class="fas fa-phone"></i> 有任何问题? &nbsp; <?php echo $theme_vars['mobile_phone']; ?>
                        </li>
                        <li>
                            <i class="fas fa-bullhorn"></i> <a href="#">认证讲师</a>
                        </li>
                        <li>
                            <i class="fas fa-briefcase"></i> <a href="#">企业用户</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 right-info">
                <div class="item-flex">
                    <div class="social">
                        <ul>
                            <li>
                                <a href="#"><i class="fab fa-qq"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-weixin"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-weibo"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="button">
                        <a href="#">注册</a>
                        <a href="#"><i class="fa fa-sign-in-alt"></i>登录</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
-->
<!-- End Header Top -->

<!-- Header 
============================================= -->
<header id="home">

    <!-- Start Navigation -->
    <nav class="navbar navbar-default attr-border navbar-sticky dark bootsnav">

        <div class="container-full">

            <!-- Start Atribute Navigation -->
            <!--<div class="attr-nav">-->
            <!--    <form action="#">-->
            <!--        <input type="text" placeholder="搜索" class="form-control" name="text">-->
            <!--        <button type="submit">-->
            <!--            <i class="fa fa-search"></i>-->
            <!--        </button>  -->
            <!--    </form>-->
            <!--</div>        -->
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/">
                    <?php if(empty($theme_vars['logo'])): ?>
						<img src="/themes/robai/public/assets/img/logo.png" class="logo" alt="Logo" >
					<?php else: ?>
						<img src="<?php echo cmf_get_image_url($theme_vars['logo']); ?>"/>
					<?php endif; ?>
                </a>
            </div>
            <!-- End Header Navigation -->
            
            
            <?php 
                $top_nav_id=empty($theme_vars['top_nav'])?1:$theme_vars['top_nav'];
             ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="navbar-menu">
                <!--<ul id="main-menu" class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">-->
                <ul id="main-menu" class="nav navbar-nav navbar-left">
                    <?php
/*start*/
if (!function_exists('__parse_navigation_33976797e814acb76ee49cc792a692bd')) {
    function __parse_navigation_33976797e814acb76ee49cc792a692bd($menus,$level=1){
        $_parse_navigation_func_name = '__parse_navigation_33976797e814acb76ee49cc792a692bd';
if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): if( count($menus)==0 ) : echo "" ;else: foreach($menus as $key=>$menu): if(empty($menu['children'])): ?>
    <li class="menu-item menu-item-level-<?php echo $level; ?> levelgt1">
    
                            <a href="<?php echo (isset($menu['href']) && ($menu['href'] !== '')?$menu['href']:''); ?>" target="<?php echo (isset($menu['target']) && ($menu['target'] !== '')?$menu['target']:''); ?>">
                                <?php echo (isset($menu['name']) && ($menu['name'] !== '')?$menu['name']:''); ?>
                            </a>
                        
    </li>
<?php endif; if(!empty($menu['children'])): ?>
    <li class="dropdown dropdown-custom dropdown-custom-level-<?php echo $level; ?>">
        
                            <a href="#" class="dropdown-toggle dropdown-toggle-<?php echo $level; ?>" data-toggle="dropdown">
                                <?php echo (isset($menu['name']) && ($menu['name'] !== '')?$menu['name']:''); ?>
                            </a>
                        
        <ul class="dropdown-menu dropdown-menu-left dropdown-menu-level-<?php echo $level; ?>">
            <?php 
            $mLevel=$level+1;
             ?>
            <?php echo $_parse_navigation_func_name($menu['children'],$mLevel); ?>
        </ul>
    </li>
<?php endif; ?>
                    
        <?php endforeach; endif; else: echo "" ;endif; 
    }
}
/*end*/
    $navMenuModel = new \app\admin\model\NavMenuModel();
    $menus = $navMenuModel->navMenusTreeArray($top_nav_id,0);
if(''==''): ?>
    <?php echo __parse_navigation_33976797e814acb76ee49cc792a692bd($menus); else: ?>
    < id="main-navigation" class="nav navbar-nav navbar-nav-custom">
        <?php echo __parse_navigation_33976797e814acb76ee49cc792a692bd($menus); ?>
    </>
<?php endif; ?>

                </ul>
                <ul class="nav navbar-nav navbar-right" id="main-menu-user">
                    <li class="dropdown user login" style="display: none;">
                        <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
                            <?php $user=cmf_get_current_user(); ?>
                            <i class="fa fa-user"></i>
                            <span class="user-nickname"><?php echo (isset($user_nickname) && ($user_nickname !== '')?$user_nickname:'新用户'); ?></span><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo cmf_url('user/Profile/center'); ?>"><i class="fa fa-home"></i> &nbsp;个人中心</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo cmf_url('user/Index/logout'); ?>"><i class="fa fa-sign-in-alt"></i> &nbsp;退出</a></li>
                        </ul>
                    </li>
                    <li class="dropdown user offline" style="display: none;">
                        <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
                            
                            <!--<img src="/themes/robai/public/assets/img/common/square.png" width="28px">-->
                            注册/登录<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo cmf_url('user/Register/index'); ?>">&nbsp;注册</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo cmf_url('user/Login/index'); ?>">&nbsp;登录</a></li>
                        </ul>
                    </li>
                </ul>
              
            </div><!-- /.navbar-collapse -->
        </div>

    </nav>
    <!-- End Navigation -->

</header>

<!-- End Header -->

        <!-- Start Breadcrumb 
        ============================================= -->
        <!--<div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(/themes/robai/public/assets/img/banner/26.jpg);">-->
        <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(https://src.hyperionrobot.com/hyper-web/banner_Comprehensive.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1><?php echo $category['name']; ?></h1>
                        <ul class="breadcrumb">
                            <li><a href="/"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active"><?php echo $category['name']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
    
        <!-- Start Blog
        ============================================= -->
        <div class="blog-area full-blog right-sidebar full-blog default-padding">
            <div class="container">
                <div class="blog-items">
                    <div class="row">
                        <div class="blog-content col-lg-8 col-md-12">
                            <div class="blog-item-box">
                                <?php 
                                $where= function($query){
        							$query->where('post.create_time','>=',0);
        						};
        						$page=[
        							'list_rows'=>5,
        							'next'=>'下一页',
        							'prev'=>'上一页'
        						];
        						 $articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => $where,
    'limit'   => '',
    'order'   => 'post.published_time DESC',
    'page'    => $page,
    'relation'=> 'categories',
    'category_ids'=>$category['id']
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                                <!-- Single Item -->
                                <div class="single-item">
                                    <div class="item">
                                        <div class="thumb">
                                            <!--<img src="/themes/robai/public/assets/img/blog/33.jpg" alt="Thumb">-->
                                            
                                            <?php if(empty($vo['more']['post_link'])): if(empty($vo['more']['thumbnail'])): ?>
                                                    <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>" style="min-height: 300px;display: block;background-position: center;background-size: 100% auto;background-image:url(/themes/robai/public/assets/img/common/picture_2.png)"></a>
        										<?php else: ?>
        										    <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>" style="min-height: 300px;display: block;background-position: center;background-size: 100% auto;background-image:url(<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>)"></a>
        										<?php endif; else: if(empty($vo['more']['thumbnail'])): ?>
                                                    <a target="_blank" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" style="min-height: 300px;display: block;background-position: center;background-size: 100% auto;background-image:url(/themes/robai/public/assets/img/common/picture_2.png)"></a>
        										<?php else: ?>
        										    <a target="_blank" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" style="min-height: 300px;display: block;background-position: center;background-size: 100% auto;background-image:url(<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>)"></a>
        										<?php endif; ?>
    										<?php endif; ?>
                                            
                                        </div>
                                        <div class="content">
                                            <div class="top-info">
                                                <ul>
                                                    <li>
                                                        <?php if(empty($vo['avatar'])): ?>
                										    <img src="/themes/robai/public/assets/img/common/square.png" alt="Advisor">
                										<?php else: ?>
                											<img src="<?php echo cmf_get_image_url($vo['avatar']); ?>">
                										<?php endif; ?>
                                                        <a href="javascript:;"> by <?php echo $vo['user']['user_nickname']; ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-calendar-alt"></i> <?php echo date('Y-m-d H:i',$vo['published_time']); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h3>
                                                <?php if(empty($vo['more']['post_link'])): ?>
                                                    <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['post_title']; ?></a>
        										<?php else: ?>
        										    <a href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank"><?php echo $vo['post_title']; ?></a>
        										<?php endif; ?>
                                            </h3>
                                            <p>
                                                <?php echo $vo['post_excerpt']; ?>
                                            </p>
                                            <?php if(empty($vo['more']['post_link'])): ?>
                                                <a class="btn circle btn-sm btn-theme effect" href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>" style="background-color:#5f5f5f;border-color:#5f5f5f">阅读更多</a>
    										<?php else: ?>
    										    <a class="btn circle btn-sm btn-theme effect" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank">立即浏览</a>
    										<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
<?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-md-12 pagi-area text-center">
                                    <nav aria-label="navigation">
                                        <ul class="pagination">
                                            <?php
     echo empty($__PAGE_VAR_NAME__)?'':$__PAGE_VAR_NAME__;
 ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Start Sidebar -->
                        <div class="sidebar col-lg-4 col-md-12">
                            <aside>
                                <div class="sidebar-item search">
                                    <div class="sidebar-info">
                                        <form method="post" action="<?php echo cmf_url('portal/Search/index'); ?>">
                                            <input type="text" class="form-control" value="<?php echo input('param.keyword',''); ?>" name="keyword" id="keyword">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- 热门文章 -->
							    <?php
     if((isset($theme_widgets['hottest_articles']) && $theme_widgets['hottest_articles']['display'])){
        $widget=$theme_widgets['hottest_articles'];
 ?>

                                <div class="sidebar-item recent-post">
                                    <div class="title">
                                        <h4><?php echo $widget['title']; ?></h4>
                                    </div>
                                    <ul>
                                        <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => '5',
    'order'   => 'post.post_hits DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>$widget['vars']['category_id']
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                                        <li>
                                            <div class="thumb">
                                                <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>">
                                                    <?php if(empty($vo['more']['thumbnail'])): ?>
        											    <img src="/themes/robai/public/assets/img/common/news.png">
        											<?php else: ?>
        												<img src="<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>">
        											<?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['post_title']; ?></a>
                                                <div class="meta-title">
                                                    <span class="post-date"><i class="fas fa-clock"></i> <?php echo date('Y-m-d',$vo['published_time']); ?></span>
                                                </div>
                                            </div>
                                        </li>
                                        
<?php endforeach; endif; else: echo "" ;endif; ?>
                                        
                                    </ul>
                                </div>
                                
<?php
    }
 ?>
                                <!-- 分类 -->
                                <?php
     if((isset($theme_widgets['categories']) && $theme_widgets['categories']['display'])){
        $widget=$theme_widgets['categories'];
 
                                    $productsId=$category['id'];
                                    $subC = _wien_subCategories("$productsId");
                                 ?>
                                <div class="sidebar-item category">
                                    <div class="title">
                                        <h4>category 分类列表</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <?php if(is_array($subC) || $subC instanceof \think\Collection || $subC instanceof \think\Paginator): if( count($subC)==0 ) : echo "" ;else: foreach($subC as $key=>$vo): ?>
                                                <li><a href="<?php echo cmf_url('portal/List/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?><!--<span>69</span>--></a></li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                
<?php
    }
 ?>
                                <!-- 热门图片 -->
							    <?php
     if((isset($theme_widgets['hottest_img']) && $theme_widgets['hottest_img']['display'])){
        $widget=$theme_widgets['hottest_img'];
 ?>

                                <div class="sidebar-item gallery">
                                    <div class="title">
                                        <h4>Gallery 图片</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => '6',
    'order'   => 'post.post_hits DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>$widget['vars']['category_id']
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                                            <li>
                                                <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>">
                                                    <?php if(empty($vo['more']['thumbnail'])): ?>
        											    <img src="/themes/robai/public/assets/img/common/news.png">
        											<?php else: ?>
        												<img src="<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>">
        											<?php endif; ?>
                                                </a>
                                            </li>
                                            
<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                
<?php
    }
 ?>
                                <!--<div class="sidebar-item archives">
                                    <div class="title">
                                        <h4>Archives</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li><a href="#">Aug 2020</a></li>
                                            <li><a href="#">Sept 2020</a></li>
                                            <li><a href="#">Nov 2020</a></li>
                                            <li><a href="#">Dec 2020</a></li>
                                        </ul>
                                    </div>
                                </div>-->
                                
                                
                                <!-- STAR  FOLLOW US
                                <div class="sidebar-item social-sidebar">
                                    <div class="title">
                                        <h4>follow us</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li class="facebook">
                                                <a href="#">
                                                    <i class="fab fa-qq"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="#">
                                                    <i class="fab fa-weixin"></i>
                                                </a>
                                            </li>
                                            <li class="pinterest">
                                                <a href="#">
                                                    <i class="fab fa-weibo"></i>
                                                </a>
                                            </li>
                                            <li class="g-plus">
                                                <a href="#">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li class="linkedin">
                                                <a href="#">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                END FOLLOW US-->
                                
                                
                                <!-- 文章标签 -->
							    <?php $tags=_wien_tags(); ?>
                                <div class="sidebar-item tags">
                                    <div class="title">
                                        <h4>Tags 标签</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($tags) ? array_slice($tags,0,30, true) : $tags->slice(0,30, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        									<li><a href="#"><?php echo $vo['name']; ?></a></li>
        									<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <!-- End Start Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog -->

		<!-- Star Footer
============================================= -->
<footer class="bg-dark text-light">
    <div class="container d-none d-sm-block">
        <div class="f-items default-padding" style="padding-bottom: 10px;">
            <div class="row">
                
                <!--  隐藏原版 
                <div class="col-lg-4 col-md-4 item">
                    <div class="f-item about">
                        <a class="logo" href="/">
							<?php if(empty($theme_vars['footer_logo'])): ?>
								<img src="/themes/robai/public/assets/img/logo-light.png" alt="Logo" style="width: 20%">
							<?php else: ?>
								<img class="img-responsive" src="<?php echo cmf_get_image_url($theme_vars['footer_logo']); ?>" style="width: 20%"/>
							<?php endif; ?>
                        </a>
                        <p style="color: darkgray; font-size: 14px;">
                            <?php echo $theme_vars['company_info']; ?>
                        </p>
                    </div>
                </div>
                -->
                
                <div class="col-lg-4 col-md-4 item">
                    <div class="f-item link">
                        <h4 class="widget-title" style="color: darkgray;">商务合作</h4>
                        <?php 
							$footer_nav=empty($theme_vars['footer_nav'])?4:$theme_vars['footer_nav'];
						 /*start*/
if (!function_exists('__parse_navigation_a87ff679a2f3e71d9181a67b7542122c')) {
    function __parse_navigation_a87ff679a2f3e71d9181a67b7542122c($menus,$level=1){
        $_parse_navigation_func_name = '__parse_navigation_a87ff679a2f3e71d9181a67b7542122c';
if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): if( count($menus)==0 ) : echo "" ;else: foreach($menus as $key=>$menu): if(empty($menu['children'])): ?>
    <li class="">
    
								<a href="<?php echo (isset($menu['href']) && ($menu['href'] !== '')?$menu['href']:''); ?>" target="<?php echo (isset($menu['target']) && ($menu['target'] !== '')?$menu['target']:''); ?>" style="color: darkgray;"><?php echo (isset($menu['name']) && ($menu['name'] !== '')?$menu['name']:''); ?></a>
							
    </li>
<?php endif; ?>
						
        <?php endforeach; endif; else: echo "" ;endif; 
    }
}
/*end*/
    $navMenuModel = new \app\admin\model\NavMenuModel();
    $menus = $navMenuModel->navMenusTreeArray('4',0);
if('ul'==''): ?>
    <?php echo __parse_navigation_a87ff679a2f3e71d9181a67b7542122c($menus); else: ?>
    <ul id="" class="">
        <?php echo __parse_navigation_a87ff679a2f3e71d9181a67b7542122c($menus); ?>
    </ul>
<?php endif; ?>

                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 item">
                    <div class="f-item link">
                        <h4 class="widget-title" style="color: darkgray;">&nbsp;</h4>
                        <?php 
							$footer_nav=empty($theme_vars['footer_nav'])?2:$theme_vars['footer_nav'];
						 /*start*/
if (!function_exists('__parse_navigation_0f419ab11f942b7c8ee80150d29666c7')) {
    function __parse_navigation_0f419ab11f942b7c8ee80150d29666c7($menus,$level=1){
        $_parse_navigation_func_name = '__parse_navigation_0f419ab11f942b7c8ee80150d29666c7';
if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): if( count($menus)==0 ) : echo "" ;else: foreach($menus as $key=>$menu): if(empty($menu['children'])): ?>
    <li class="">
    
								<a href="<?php echo (isset($menu['href']) && ($menu['href'] !== '')?$menu['href']:''); ?>" target="<?php echo (isset($menu['target']) && ($menu['target'] !== '')?$menu['target']:''); ?>" style="color: darkgray;"><?php echo (isset($menu['name']) && ($menu['name'] !== '')?$menu['name']:''); ?></a>
							
    </li>
<?php endif; ?>
						
        <?php endforeach; endif; else: echo "" ;endif; 
    }
}
/*end*/
    $navMenuModel = new \app\admin\model\NavMenuModel();
    $menus = $navMenuModel->navMenusTreeArray($footer_nav,0);
if('ul'==''): ?>
    <?php echo __parse_navigation_0f419ab11f942b7c8ee80150d29666c7($menus); else: ?>
    <ul id="" class="">
        <?php echo __parse_navigation_0f419ab11f942b7c8ee80150d29666c7($menus); ?>
    </ul>
<?php endif; ?>

                    </div>
                </div>
                
                
                <!--<div class="col-lg-3 col-md-6 item">-->
                    
                <!--    <?php
     if((isset($theme_widgets['footer_articles']) && $theme_widgets['footer_articles']['display'])){
        $widget=$theme_widgets['footer_articles'];
 ?>
-->
                <!--    <div class="f-item link">-->
                <!--        <h4 class="widget-title">最新资讯</h4>-->
                <!--        <ul>-->
                <!--            <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => '4',
    'order'   => 'post.published_time DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>$widget['vars']['category_id']
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
-->
                <!--            <li>-->
                <!--                <a href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['post_title']; ?></a>-->
                <!--            </li>-->
                <!--            
<?php endforeach; endif; else: echo "" ;endif; ?>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--    
<?php
    }
 ?>-->
                <!--</div>-->

                <div class="col-lg-4 col-md-4 item">
                    <div class="f-item contact">
                        <h4 class="widget-title" style="color: darkgray;">联系我们</h4>
                        <div class="address">
                            <ul>
                                <li>
                                    <!--<strong>Email:</strong> <?php echo $theme_vars['email']; ?>-->
                                    <img src="https://src.hyperionrobot.com/hyper-web/hyper_ewm.jpg" alt="微信二维码" style="max-width: 35%" />
                                </li>
                                <!--<li>-->
                                <!--    <strong>Contact:</strong> <?php echo $theme_vars['mobile_phone']; ?>-->
                                <!--</li>-->
                            </ul>
                        </div>
                        <!--<div class="opening-info">-->
                        <!--    <h5>营业时间</h5>-->
                        <!--    <ul>-->
                        <!--        <li> <span> 周一至周五 :  </span>-->
                        <!--          <div class="float-right"> 早6.00 - 晚10.00 </div>-->
                        <!--        </li>-->
                        <!--        <li> <span> 周末 : </span>-->
                        <!--          <div class="float-right closed"> 休息 </div>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p style="color: darkgray;">
                        Copyright &copy; 2026 &nbsp;&nbsp;<?php echo $theme_vars['company_name']; ?> &nbsp;&nbsp;All rights reserve.
                    </p>  
                    <p style="color: darkgray;">
						 <a href="https://beian.miit.gov.cn" target="_blank" rel="noopener" style="color: darkgray;"><?php echo (isset($theme_vars['site_icp']) && ($theme_vars['site_icp'] !== '')?$theme_vars['site_icp']:''); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://beian.mps.gov.cn/#/query/webSearch" target="_blank" style="color: darkgray;"><?php echo (isset($theme_vars['gn_icp']) && ($theme_vars['gn_icp'] !== '')?$theme_vars['gn_icp']:''); ?></a>
					</p>
                </div>
                <div class="col-lg-6 text-right link">
                    <ul>
                        <?php
     $__LINKS__ = \app\admin\service\ApiService::links();
if(is_array($__LINKS__) || $__LINKS__ instanceof \think\Collection || $__LINKS__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__LINKS__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                        <li>
                            <a class="nav-link" href="<?php echo (isset($vo['url']) && ($vo['url'] !== '')?$vo['url']:''); ?>" style="color: darkgray; font-weight: normal;" target="<?php echo (isset($vo['target']) && ($vo['target'] !== '')?$vo['target']:''); ?>"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></a>
                        </li>
                        
<?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->
</footer>
<!-- End Footer-->
<!-- 统计/推送代码 -->
<div class="tj">
    <?php $site_count = htmlspecialchars_decode($theme_vars['site_count']); ?>
    <?php echo (isset($site_count) && ($site_count !== '')?$site_count:''); ?>
</div>

<!--微信分享配置-->
<?php 
    //$articleMore = $article['more'] ?? [];// 文章缩略图.
    
    $title = !empty($article['post_title']) ? $article['post_title'] : $site_info['site_seo_title'];
    $desc = !empty($article['post_excerpt']) ? $article['post_excerpt'] : $site_info['site_seo_description'];
    
    $param = [
     'title'=> $title,   // 分享标题
     'desc'=> $desc,            // 分享描述
     // 'imgUrl' => $articleMore['thumbnail'] ?? '' 分享图标 地址带域名 http https
     'imgUrl' => 'https://www.hyperionrobot.com/themes/hyperion/public/assets/img/logo.png'
    ];

 
    hook('before_footer_end',$param,false);
 ?>
		<!-- jQuery Frameworks
============================================= -->
<script src="/themes/robai/public/assets/js/jquery-1.12.4.min.js"></script>
<script src="/themes/robai/public/assets/js/popper.min.js"></script>
<script src="/themes/robai/public/assets/js/bootstrap.min.js"></script>
<script src="/themes/robai/public/assets/js/jquery.appear.js"></script>
<script src="/themes/robai/public/assets/js/jquery.easing.min.js"></script>
<script src="/themes/robai/public/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/themes/robai/public/assets/js/modernizr.custom.13711.js"></script>
<script src="/themes/robai/public/assets/js/owl.carousel.min.js"></script>
<script src="/themes/robai/public/assets/js/wow.min.js"></script>
<script src="/themes/robai/public/assets/js/progress-bar.min.js"></script>
<script src="/themes/robai/public/assets/js/isotope.pkgd.min.js"></script>
<script src="/themes/robai/public/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="/themes/robai/public/assets/js/count-to.js"></script>
<script src="/themes/robai/public/assets/js/YTPlayer.min.js"></script>
<script src="/themes/robai/public/assets/js/jquery.nice-select.min.js"></script>
<script src="/themes/robai/public/assets/js/loopcounter.js"></script>
<script src="/themes/robai/public/assets/js/bootsnav.js"></script>
<script src="/themes/robai/public/assets/js/main.js"></script>


<script src="/static/js/frontend.js"></script>

<script type="text/javascript" charset="utf-8">
	$(function(){
	    
		$("#main-menu a").each(function() {
			if ($(this)[0].href == String(window.location)) {
				$(this).parentsUntil("#main-menu>ul>li").addClass("active");
			}
		})
	    
	    
		$.post("<?php echo url('user/index/isLogin'); ?>",{},function(data){
			if(data.code==1){
				if(data.data.user.avatar){
				}

				//$("#main-menu-user span.user-nickname").text(data.data.user.user_nickname?data.data.user.user_nickname:data.data.user.user_login);
				$("#main-menu-user li.login").show();
                $("#main-menu-user li.offline").hide();

			}

			if(data.code==0){
                $("#main-menu-user li.login").hide();
				$("#main-menu-user li.offline").show();
			}

		});

       
	});
</script>
		<?php 
    hook('before_body_end',null,false);
 ?>
	</body>
</html>