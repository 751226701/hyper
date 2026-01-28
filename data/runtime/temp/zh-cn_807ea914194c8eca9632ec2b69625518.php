<?php /*a:7:{s:75:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/portal/index.html";i:1769523561;s:74:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/head.html";i:1765520921;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/function.html";i:1768462231;s:76:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/config.html";i:1759133767;s:73:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/nav.html";i:1768895638;s:76:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/footer.html";i:1769078028;s:77:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/scripts.html";i:1768896081;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<!--<title><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></title>-->
		<title><?php echo (isset($theme_vars['site_name']) && ($theme_vars['site_name'] !== '')?$theme_vars['site_name']:$site_info['site_name']); ?></title>
		<meta name="keywords" content="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>"/>
		<meta name="description" content="<?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?>">
		
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
<link rel="shortcut icon" href="/themes/hyperion/public/favicon.ico" type="image/x-icon">
<!-- 自定义 -->
<link href="/themes/hyperion/public/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/themify-icons.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/flaticon-set.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/elegant-icons.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/magnific-popup.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/owl.carousel.min.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/owl.theme.default.min.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/animate.css" rel="stylesheet" />
<link href="/themes/hyperion/public/assets/css/bootsnav.css" rel="stylesheet" />
<link href="/themes/hyperion/public/style.css" rel="stylesheet">
<link href="/themes/hyperion/public/assets/css/responsive.css" rel="stylesheet" />


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
<script src="/themes/hyperion/public/assets/js/jquery.min.js"></script>
<script src="/themes/hyperion/public/assets/js/jquery-migrate-3.0.0.js"></script>
<script src="/static/js/wind.js"></script>
		<?php 
    hook('before_head_end',null,false);
 ?>
	</head>
	<body>
	    <!-- 预加载 Start -->
        <!--<div class="se-pre-con"></div>-->
        <!-- 预加载 Ends -->
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
						<img src="/themes/hyperion/public/assets/img/logo.png" class="logo" alt="Logo" >
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
                            
                            <!--<img src="/themes/hyperion/public/assets/img/common/square.png" width="28px">-->
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

        <!-- Start Banner 
        ============================================= -->
        <div class="banner-area bg-gray auto-height shape multi-heading">
            <div id="bootcarousel" class="carousel text-center text-light slide carousel-fade animate_text" data-ride="carousel" data-interval="3000">
    
                <!-- Wrapper for slides -->
                <div class="carousel-inner carousel-zoom">
                    <?php 
                        $top_slide_id=empty($theme_vars['top_slide'])?1:$theme_vars['top_slide'];
                          $__SLIDE_ITEMS__ = \app\admin\service\ApiService::slides($top_slide_id);
if(is_array($__SLIDE_ITEMS__) || $__SLIDE_ITEMS__ instanceof \think\Collection || $__SLIDE_ITEMS__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__SLIDE_ITEMS__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                    <div class="carousel-item">
                        <div class="slider-thumb bg-cover" style="background-image: url(<?php echo cmf_get_image_url($vo['image']); ?>);"></div>
                        <div class="box-table shadow dark">
                            <div class="box-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10 offset-lg-1">
                                            <div class="content">
                                                <h3 data-animation="animated slideInDown"><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'后台编辑标题'); ?></h3>
                                                <h2 data-animation="animated fadeInRight"><?php echo (isset($vo['description']) && ($vo['description'] !== '')?$vo['description']:'Ebukat <strong>限时免费</strong>'); ?></h2>
                                                <p data-animation="animated slideInLeft">
                                                    <?php echo (isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:'此处请编辑幻灯片内容：构建在线教育业务闭环，促进教育机构业务增长，十万家培新机构都在用的网校系统'); ?>
                                                </p>
                                                <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="<?php echo (isset($vo['url']) && ($vo['url'] !== '')?$vo['url']:''); ?>">更多发现</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<?php endforeach; endif; else: echo "" ;endif;     if(!isset($__SLIDE_ITEMS__)){
        $__SLIDE_ITEMS__ = \app\admin\service\ApiService::slides($top_slide_id);
    }
if(count($__SLIDE_ITEMS__) == 0): ?>

                    <div class="carousel-item">
                        <div class="slider-thumb bg-cover" style="background-image: url(/themes/hyperion/public/assets/img/banner/8.jpg);"></div>
                        <div class="box-table shadow dark">
                            <div class="box-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10 offset-lg-1">
                                            <div class="content">
                                                <h3 data-animation="animated slideInDown">互联网在线学习</h3>
                                                <h2 data-animation="animated fadeInRight">Ebukat <strong>限时免费</strong></h2>
                                                <p data-animation="animated slideInLeft">
                                                    构建在线教育业务闭环，促进教育机构业务增长，十万家培新机构都在用的网校系统
                                                </p>
                                                <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="#">更多发现</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="slider-thumb bg-cover" style="background-image: url(/themes/hyperion/public/assets/img/banner/14.jpg);"></div>
                        <div class="box-table shadow dark">
                            <div class="box-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10 offset-lg-1">
                                            <div class="content">
                                                <h3 data-animation="animated slideInDown">互联网在线学习</h3>
                                                <h2 data-animation="animated fadeInRight">Ebukat <strong>限时免费</strong></h2>
                                                <p data-animation="animated slideInLeft">
                                                    构建在线教育业务闭环，促进教育机构业务增长，十万家培新机构都在用的网校系统
                                                </p>
                                                <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="#">更多发现</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<?php endif; ?>
                </div>
                <!-- End Wrapper for slides -->
    
                <!-- Left and right controls -->
                <a class="left carousel-control light" href="#bootcarousel" data-slide="prev">
                    <i class="ti-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control light" href="#bootcarousel" data-slide="next">
                    <i class="ti-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
    
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
        
            //默认第一个显示
            $(".carousel-inner").each(function(){
                $(this).find(".carousel-item").first().addClass("active");
            });
        </script>
        <!-- End Banner -->
    
        <!-- Star 宫格区
        ============================================= -->
        <?php
     if((isset($theme_widgets['services']) && $theme_widgets['services']['display'])){
        $widget=$theme_widgets['services'];
 ?>

        <div class="default-features-area default-design default-padding bottom-less text-center">
            <div class="container">
                <div class="item-box">
                    <?php 
    					$features = $widget['vars']['features'];
    				 ?>
                    <div class="row">
                        <?php if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                        <div class="col-lg-4 col-md-6 single-item">
                            <div class="item">
                                <i class="fas fa-<?php echo $vo['icon']; ?>"></i>
                                <h4><?php echo $vo['title']; ?></h4>
                                <p>
                                    <?php echo $vo['content']; ?>
                                </p>
                                <!--<a href="<?php echo $vo['link']; ?>"><i class="fas fa-angle-right"></i> Read More</a>-->
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End 宫格 -->
    
        <!-- Star 公司简介
        ============================================= -->
        <?php
     if((isset($theme_widgets['index_about']) && $theme_widgets['index_about']['display'])){
        $widget=$theme_widgets['index_about'];
 ?>

        <div class="about-area reverse default-padding bg-gray">
            <div class="container">
                <div class="about-items">
                    <div class="row">
                        <div class="col-lg-6 thumb">
                            <?php if(empty($widget['vars']['image_bg'])): ?>
								<img src="/themes/hyperion/public/assets/img/illustration/4.png" alt="Thumb">
							<?php else: ?>
								<img src="<?php echo cmf_get_image_url($widget['vars']['image_bg']); ?>"/>
							<?php endif; ?>
                        </div>
                        <div class="col-lg-6 info">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2><?php echo $widget['vars']['sub_title']; ?></h2>
                            <p style="text-align: left;">
                                <?php echo $widget['vars']['content']; ?>
                            </p>
                            <ul>
                                <?php 
                					$features = $widget['vars']['features'];
                				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                                <li>
                                    <div class="fun-fact">
                                        <span class="timer" data-to="<?php echo $vo['content']; ?>" data-speed="3000"></span>
                                        <span class="medium"><?php echo $vo['title']; ?></span>
                                        <!--<a href="https://src.hyperionrobot.com/download.jpg" download="download.jpg">点击下载文件</a>-->
                                    </div>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End 公司简介 -->
    
        <!-- Star 闭环
        ============================================= -->
        <?php
     if((isset($theme_widgets['index_three']) && $theme_widgets['index_three']['display'])){
        $widget=$theme_widgets['index_three'];
 ?>

        <div class="categories-area reverse carousel-shadow default-padding">
            <div class="container">
                <div class="categories-box">
                    <div class="row">
    
                        <div class="col-lg-5 heading">
                            <h2><?php echo $widget['title']; ?></h2>
                            <p style="text-align: left;">
                                <?php echo $widget['vars']['content']; ?>
                            </p>
                            <a class="btn btn-md btn-gradient icon-left" target="_blank" href="<?php echo $widget['vars']['link']; ?>"><i class="fas fa-grip-horizontal"></i> <?php echo $widget['vars']['btn_text']; ?></a>
                        </div>
    
                        <div class="col-lg-7">
                            <div class="category-items categories-carousel owl-carousel owl-theme text-light text-center">
                                <?php 
                					$features = $widget['vars']['features'];
                				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                                <div class="item <?php echo $vo['color']; ?>">
                                    <a href="<?php echo $vo['link']; ?>" target="_blank">
                                        <i class="<?php echo $vo['icon']; ?>"></i>
                                        <div class="info">
                                            <h5><?php echo $vo['title']; ?></h5>
                                            <p><?php echo $vo['content']; ?></p>
                                            <span>View more</span>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End 闭环 -->
    
        <!--  start applicaiton  应用简介
        ============================================= -->
        <?php
     if((isset($theme_widgets['index_video']) && $theme_widgets['index_video']['display'])){
        $widget=$theme_widgets['index_video'];
 ?>

        <div class="why-choseus-area default-padding-bottom bottom-less">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2><?php echo $widget['vars']['sub_title']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fixed BG -->
            <div class="container">
                <div class="info">
                    <div class="row">
                        <div class="single-item thumb col-lg-12">
                            <div class="thumb-box">
                                <?php if(empty($widget['vars']['image_bg'])): ?>
    								<img src="/themes/hyperion/public/assets/img/about/1.jpg">
    							<?php else: ?>
    								<img src="<?php echo cmf_get_image_url($widget['vars']['image_bg']); ?>"/>
    							<?php endif; ?>
                                <a href="<?php echo $widget['vars']['link']; ?>" class="popup-youtube light video-play-button item-center">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="item-box col-lg-12">
                            <div class="row">
                                <?php 
                					$features = $widget['vars']['features'];
                				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                                <div class="single-item col-lg-4 col-md-4">
                                    <div class="item">
                                        <span>0<?php echo $key+1; ?></span>
                                        <i class="fa fa-<?php echo $vo['icon']; ?>"></i>
                                        <h4 style="font-weight: bold; color: #990033; font-size:24px;"><?php echo $vo['title']; ?></h4>
                                        <p>
                                           <?php echo $vo['content']; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!--  end applicaiton  应用简介 -->
    
        <!-- Start information  平台资讯
        ============================================= -->
        <?php
     if((isset($theme_widgets['last_case']) && $theme_widgets['last_case']['display'])){
        $widget=$theme_widgets['last_case'];
 
		    $widget_id = empty($widget["vars"]["category_id"])?1:$widget["vars"]["category_id"];
		    $limit=3;
		 ?>
        <div class="courses-area trend-layout bg-gray default-padding bottom-less">
            <div class="container">
                <div class="heading-left">
                    <div class="row">
                        <div class="col-lg-5">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2>
                               <?php echo $widget['vars']['sub_title']; ?>
                            </h2>
                        </div>
                        <div class="col-lg-6 offset-lg-1">
                            <p>
                                <?php echo $widget['vars']['content']; ?>
                            </p>
                            <a class="btn btn-md btn-dark border" href="<?php echo cmf_url('portal/List/index',array('id'=>$widget_id)); ?>">浏览更多 <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="courses-items">
                    <div class="row">
                        
                        <!-- Single item -->
                        <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => $limit,
    'order'   => 'post.published_time DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>$widget_id
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                        <div class="single-item col-lg-4 col-md-6">
                            <div class="item">
                                <div class="thumb">
                                    <a href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank">
                                        <?php if(empty($vo['more']['thumbnail'])): ?>
										    <img src="/themes/hyperion/public/assets/img/common/picture_2.png" alt="Thumb">
										<?php else: ?>
											<img src="<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>">
										<?php endif; ?>
                                    </a>
                                </div>
                                <div class="info">
                                     <!--<div class="top-info">
                                       <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>4.8 (867)</span>
                                        </div>
                                         <div class="price">
                                            $15.00
                                        </div> 
                                    </div>-->
                                    
                                    
                                    <!-- 隐藏了作者和栏目名称-------
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <?php if(empty($vo['avatar'])): ?>
        										    <img src="/themes/hyperion/public/assets/img/common/square.png" alt="Advisor">
        										<?php else: ?>
        											<img src="<?php echo cmf_get_image_url($vo['avatar']); ?>">
        										<?php endif; ?>
                                                <a href="javascript:;"><?php echo $vo['user']['user_nickname']; ?></a> in <a href="#">
                                                    <?php 
                                                        $category=_wien_getCategoryName($vo['category_id']);
                                                     ?>
                                                    <?php echo $category['name']; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    ------------------------------->
                                    
                               
                                    <h4 style="font-size: 22px;">
                                        <a href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank"><?php echo $vo['post_title']; ?></a>
                                    </h4>
                                    <p>
                                       <?php echo $vo['post_excerpt']; ?>
                                    </p>
                                    <div class="bottom-info">
                                        <div class="course-info">
                                            <ul>
                                                <li><i class="fas fa-clock"></i> <?php echo date('Y-m-d',$vo['published_time']); ?></li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <li><i class="fas fa-user"></i> <?php echo $vo['post_hits']; ?></li>
                                                <!--<li><i class="fas fa-list-ul"></i> <?php echo $vo['post_like']; ?></li>      隐藏了点赞-->
                                            </ul>
                                        </div>
                                        <!--<div class="enroll">-->
                                        <!--    <a class="btn btn-theme effect btn-sm" href="<?php echo cmf_url('portal/Article/index',array('id'=>$vo['id'])); ?>">立即报名</a>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
<?php endforeach; endif; else: echo "" ;endif; ?>
                        	
                        
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End INFORMATION   平台资讯 -->
    
        <!-- Star 套餐版本
        ============================================= -->
        <?php
     if((isset($theme_widgets['index_six']) && $theme_widgets['index_six']['display'])){
        $widget=$theme_widgets['index_six'];
 ?>

        <div class="event-area default-padding bottom-less">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2><?php echo $widget['vars']['sub_title']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="event-area">
                    <div class="row">
                        <?php 
        					$features = $widget['vars']['features'];
        				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                        <div class="single-event col-lg-12">
                            <div class="event-box">
                                <div class="row">
                                    <?php if(empty($vo['image'])): ?>
                                        <div class="col-lg-4 item thumb" style="background-image: url(/themes/hyperion/public/assets/img/common/square.png);"></div>
                        			<?php else: ?>
                        			    <div class="col-lg-4 item thumb" style="background-image: url(<?php echo cmf_get_image_url($vo['image']); ?>);"></div>
                        			<?php endif; ?>
                                    <div class="col-lg-3 col-md-5 item">
                                        <div class="info">
                                            <h2><strong>活动 <?php echo $key+1; ?></strong></h2>
                                            <!--<h5><?php echo $vo['time']; ?></h5>-->
                                            <ul>
                                                <li>
                                                    <i class="icon_pin_alt"></i> <?php echo $vo['area']; ?>
                                                </li>
                                                <li>
                                                    <i class="icon_star_alt"></i> <?php echo $vo['address']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-7 item">
                                        <div class="content">
                                            <h3>
                                                <a href="javascript:;" style="color: #990033"><?php echo $vo['title']; ?></a>
                                            </h3>
                                            <p><?php echo $vo['content']; ?></p>
                                            <!--<ul>-->
                                            <!--    <li>-->
                                            <!--        <a href="advisor-single.html"><img src="/themes/hyperion/public/assets/img/advisor/6.jpg" alt="Thumb">Kevin & Amanda</a>-->
                                            <!--    </li>-->
                                            <!--    <li><i class="fas fa-clock"></i> 8:00 - 16:00</li>-->
                                            <!--</ul>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End 套餐版本 -->
    
        <!-- Star Testimonials
        ============================================= -->
        <?php
     if((isset($theme_widgets['testimonials']) && $theme_widgets['testimonials']['display'])){
        $widget=$theme_widgets['testimonials'];
 ?>

        <div class="testimonials-area carousel-shadow default-padding bottom-less">
            <!-- Fixed Shape -->
            <div class="fixed-shape">
                <img src="/themes/hyperion/public/assets/img/shape/5.png" alt="Shape">
            </div>
            <!-- End Fixed Shape -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2><?php echo $widget['vars']['sub_title']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="testimonial-items text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonials-carousel owl-carousel owl-theme">
                                <?php 
                					$features = $widget['vars']['features'];
                				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                                <div class="item">
                                    <div class="icon">
                                        <i class="flaticon-quotation"></i>
                                    </div>
                                    <div class="content">
                                        <p>
                                            <?php echo $vo['content']; ?> 
                                        </p>
                                    </div>
                                    <div class="provider">
                                        <div class="thumb">
                                            <?php if(empty($vo['image'])): ?>
            								    <img src="/themes/hyperion/public/assets/img/common/square.png">
            								<?php else: ?>
            									<img src="<?php echo cmf_get_image_url($vo['image']); ?>">
            								<?php endif; ?>
                                        </div>
                                        <div class="info">
                                            <h5><?php echo $vo['title']; ?></h5>
                                            <span><?php echo $vo['job']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    }
 ?>
        <!-- End Testimonials Area -->
        
        <!-- Start DATA BANNER
        ============================================= -->
		<?php
     if((isset($theme_widgets['counter']) && $theme_widgets['counter']['display'])){
        $widget=$theme_widgets['counter'];
 ?>

        <div class="fun-factor-area overflow-hidden bg-gradient text-light default-padding">
            <div class="container">
                <div class="fun-fact-items text-center">
                    <!-- Fixed BG -->
                    <div class="fixed-bg contain" style="background-color:#990033; background-image: url(/themes/hyperion/public/assets/img/map.svg);"></div>
                    <!-- Fixed BG -->
                    <div class="row">
                        <?php 
        					$features = $widget['vars']['features'];
        				 if(is_array($features) || $features instanceof \think\Collection || $features instanceof \think\Paginator): if( count($features)==0 ) : echo "" ;else: foreach($features as $key=>$vo): ?>
                        <div class="col-lg-3 col-md-6 item">
                            <div class="fun-fact">
                                <div class="counter">
                                    <!--<div class="timer" data-to="<?php echo $vo['number']; ?>" data-speed="5000"><?php echo $vo['number']; ?></div>-->
                                    <div class="operator"><?php echo $vo['icon']; ?></div>
                                </div>
                                <span class="medium"><?php echo $vo['title']; ?></span>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
		
<?php
    }
 ?>
        <!-- End DATA BANNER -->
    
        <!-- Star 更新日志
        ============================================= -->
        <?php
     if((isset($theme_widgets['last_news']) && $theme_widgets['last_news']['display'])){
        $widget=$theme_widgets['last_news'];
 
		    $widget["vars"]["category_id"] = empty($widget["vars"]["category_id"])?1:$widget["vars"]["category_id"];
		    $limit=3;
		 ?>
        <div class="blog-area default-padding bottom-less">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h5><?php echo $widget['title']; ?></h5>
                            <h2><?php echo $widget['vars']['sub_title']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="blog-items">
                    <div class="row">
                        <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => $limit,
    'order'   => 'post.published_time DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>$widget['vars']['category_id']
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                        <div class="col-lg-4 col-md-6 single-item">
                        
                            <div class="item">
                                <div class="thumb">
                                    <a class="popup-youtube" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank">
                                        <?php if(empty($vo['more']['thumbnail'])): ?>
        								    <img src="/themes/hyperion/public/assets/img/common/news.png">
        								<?php else: ?>
        									<img src="<?php echo cmf_get_image_url($vo['more']['thumbnail']); ?>">
        								<?php endif; ?>
                                    </a>
                                    <div class="date">
                                        <strong><?php echo date('d',$vo['published_time']); ?> </strong> <?php echo date('M',$vo['published_time']); ?>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4><a class="popup-youtube" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank"><?php echo $vo['post_title']; ?></a></h4>
                                    <p>
                                        <?php echo $vo['post_excerpt']; ?> 
                                    </p>
                                </div>
                                <div class="bottom-info">
                                    <span><i class="fas fa-user"></i> <?php echo $vo['user']['user_nickname']; ?></span>
                                    <a class="btn-more popup-youtube" href="<?php echo (isset($vo['more']['post_link']) && ($vo['more']['post_link'] !== '')?$vo['more']['post_link']:'#'); ?>" target="_blank">查看详情 <i class="arrow_right"></i></a>
                                </div>
                            </div>
                        </div>
                        
<?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
		
<?php
    }
 ?>
        <!-- End 更新日志 -->		

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
								<img src="/themes/hyperion/public/assets/img/logo-light.png" alt="Logo" style="width: 20%">
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
<script src="/themes/hyperion/public/assets/js/jquery-1.12.4.min.js"></script>
<script src="/themes/hyperion/public/assets/js/popper.min.js"></script>
<script src="/themes/hyperion/public/assets/js/bootstrap.min.js"></script>
<script src="/themes/hyperion/public/assets/js/jquery.appear.js"></script>
<script src="/themes/hyperion/public/assets/js/jquery.easing.min.js"></script>
<script src="/themes/hyperion/public/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/themes/hyperion/public/assets/js/modernizr.custom.13711.js"></script>
<script src="/themes/hyperion/public/assets/js/owl.carousel.min.js"></script>
<script src="/themes/hyperion/public/assets/js/wow.min.js"></script>
<script src="/themes/hyperion/public/assets/js/progress-bar.min.js"></script>
<script src="/themes/hyperion/public/assets/js/isotope.pkgd.min.js"></script>
<script src="/themes/hyperion/public/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="/themes/hyperion/public/assets/js/count-to.js"></script>
<script src="/themes/hyperion/public/assets/js/YTPlayer.min.js"></script>
<script src="/themes/hyperion/public/assets/js/jquery.nice-select.min.js"></script>
<script src="/themes/hyperion/public/assets/js/loopcounter.js"></script>
<script src="/themes/hyperion/public/assets/js/bootsnav.js"></script>
<script src="/themes/hyperion/public/assets/js/main.js"></script>


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
