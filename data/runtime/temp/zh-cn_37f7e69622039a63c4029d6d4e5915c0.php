<?php /*a:6:{s:76:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/user/register.html";i:1762102747;s:74:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/head.html";i:1765520921;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/function.html";i:1768462231;s:76:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/config.html";i:1759133767;s:73:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/nav.html";i:1768895638;s:77:"/www/wwwroot/www.hyperionrobot.com/public/themes/hyperion/public/scripts.html";i:1768896081;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="keywords" content=""/>
<meta name="description" content="">

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
<style type="text/css" media="all">
.login-area{
    background: #fff;
    box-shadow: 1px 4px 20px -2px rgba(0, 0, 0, .1);
    padding: 50px;
    position: relative;
 

}
.register-nav{
    display:flex;

}
.register-nav li{
    width: 50%;
    text-align: center;
    /* border-bottom: 1px solid #dfdfdf;    border-top-left-radius:10px;*/
    /*border-top-right-radius:10px;*/
    /*overflow: hidden;*/
     
}

.register-nav li a.active{
    background-color: #eee;
}
/*.register-nav li:hover{*/
    
/*}*/
/*.register-nav li.active{*/
/*    border-top: 1px solid #dfdfdf;*/
/*    border-left: 1px solid #dfdfdf;*/
/*    border-right: 1px solid #dfdfdf;*/
/*    border-bottom: 0;*/

/*}*/
</style>
</head>

<body class="body-white" id="top">
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
<div class="default-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="login-area">
                    <h3 class="text-center"><?php echo lang('用户注册'); ?></h3>
                    <br />
                    <?php 
                        $mobile_tab_active=empty($theme_vars['enable_mobile'])?'':'active';
                        $email_tab_active=empty($theme_vars['enable_mobile'])?'active':'';
                     if(!(empty($theme_vars['enable_mobile']) || (($theme_vars['enable_mobile'] instanceof \think\Collection || $theme_vars['enable_mobile'] instanceof \think\Paginator ) && $theme_vars['enable_mobile']->isEmpty()))): ?>
                        <ul class="nav nav-tabs nav-justified register-nav" id="myTab" role="tablist" style="margin-bottom: 15px;">
                            <li><a class="active" href="#mobile" data-toggle="tab">手机注册</a></li>
                            <!--<li><a href="#email" data-toggle="tab">邮箱注册</a></li>-->
                        </ul>
                    <?php endif; ?>
                    <br />
                    <?php 
                        $is_open_registration = cmf_is_open_registration();
                        
                     ?>
                    
                    <div class="tab-content">
                        <?php if(!(empty($theme_vars['enable_mobile']) || (($theme_vars['enable_mobile'] instanceof \think\Collection || $theme_vars['enable_mobile'] instanceof \think\Paginator ) && $theme_vars['enable_mobile']->isEmpty()))): ?>
                            <div class="tab-pane <?php echo $mobile_tab_active; ?>" id="mobile">
                                <form class="js-ajax-form" action="<?php echo url('user/Register/doRegister'); ?>" method="post">
        
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="手机号" class="form-control"
                                               id="js-mobile-input" value="">
                                    </div>
        
                                    <div class="form-group">
                                        <div style="position: relative;">
                                            <input type="text" name="captcha" placeholder="验证码" class="form-control"
                                                   style="width: 200px;float: left;margin-right: 30px">
                                            <?php $__CAPTCHA_SRC=url('/new_captcha').'?height=38&width=160&font_size=20'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
<input type="hidden" name="_captcha_id" value="">
                                        </div>
                                    </div>
        
                                    <?php if(empty($is_open_registration) || (($is_open_registration instanceof \think\Collection || $is_open_registration instanceof \think\Paginator ) && $is_open_registration->isEmpty())): ?>
                                        
                                        <div class="form-group">
                                            <div style="position: relative;">
                                                <input type="text" name="code" placeholder="手机验证码" style="width:200px;"
                                                       class="form-control">
                                                <a class="btn btn-success js-get-mobile-code"
                                                   style="width: 163px;position: absolute;top:0;right: 0;color:#fff"
                                                   data-wait-msg="[second]秒后再次获取" data-mobile-input="#js-mobile-input"
                                                   data-url="<?php echo url('user/VerificationCode/send3'); ?>"
                                                   daty-type="register"
                                                   data-init-second-left="60">获取手机验证码</a>  
                                                   
                                            </div>
                                        </div>
                                    <?php endif; ?>
        
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="密码" class="form-control">
                                    </div>
        
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block js-ajax-submit" type="submit" data-wait="1500"
                                                style="margin-left: 0px;">确定注册
                                        </button>
                                    </div>
        
                                    <div class="form-group" style="text-align: center;">
                                        <p>
                                            已有账号? <a href="<?php echo cmf_url('user/Login/index'); ?>">点击此处登录</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        <div class="tab-pane <?php echo $email_tab_active; ?>" id="email">
                            <form class="js-ajax-form" action="<?php echo url('user/register/doRegister'); ?>" method="post">
        
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="邮箱" class="form-control"
                                           id="js-email-input">
                                </div>
        
                                <div class="form-group">
                                    <div style="position: relative;">
                                        <input type="text" name="captcha" placeholder="验证码" class="form-control"
                                               style="width: 200px;float: left;margin-right: 30px">
                                        <?php $__CAPTCHA_SRC=url('/new_captcha').'?height=38&width=160&font_size=20'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
<input type="hidden" name="_captcha_id" value="">
                                    </div>
                                </div>
        
                                <?php if(empty($is_open_registration) || (($is_open_registration instanceof \think\Collection || $is_open_registration instanceof \think\Paginator ) && $is_open_registration->isEmpty())): ?>
                                    <div class="form-group">
                                        <div style="position: relative;">
                                            <input type="text" name="code" placeholder="邮件验证码" style="width:200px;"
                                                   class="form-control">
                                            <a class="btn btn-success js-get-email-code"
                                               style="width: 163px;position: absolute;top:0;right: 0;color:#fff"
                                               data-wait-msg="[second]秒后再次获取" data-email-input="#js-email-input"
                                               data-url="<?php echo url('user/VerificationCode/send'); ?>"
                                               daty-type="register"
                                               data-init-second-left="60" >获取邮箱验证码</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
        
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="密码" class="form-control">
                                </div>
        
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block js-ajax-submit" type="submit" data-wait="1500"
                                            style="margin-left: 0px;">确定注册
                                    </button>
                                </div>
        
                                <div class="form-group" style="text-align: center;">
                                    <p>
                                        已有账号? <a href="<?php echo cmf_url('user/Login/index'); ?>">点击此处登录</a>
                                    </p>
                                </div>
                            </form>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    <!-- /container -->
</div>
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
</body>
</html>