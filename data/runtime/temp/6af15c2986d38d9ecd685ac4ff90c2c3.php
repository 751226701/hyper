<?php /*a:1:{s:82:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/index/index.html";i:1735379406;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN" style="overflow: hidden;">
    <?php 
        $_admin_setting=cmf_get_option('admin_settings');
        $_is_mobile=cmf_is_mobile();
     ?>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta charset="utf-8">
    <title><?php echo (isset($_admin_setting['admin_name']) && ($_admin_setting['admin_name'] !== '')?$_admin_setting['admin_name']:'ThinkCMF'); ?> <?php echo lang('ADMIN_CENTER'); ?></title>
    <meta name="description" content="This is page-header (.page-header &gt; h1)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    
    <link href="/static/font-awesome/css/font-awesome.min.css?page=index" rel="stylesheet" type="text/css">
    <link href="/themes/admin_star/public/assets/layui/css/layui.css" rel="stylesheet">
    <link href="/themes/admin_star/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php 
        $_static_version='1.0.0';
     ?>
    <script>
        //全局变量
        var GV = {
            HOST: "<?php echo (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] !== '')?$_SERVER['HTTP_HOST']:''); ?>",
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            IS_MOBILE: <?php echo !empty($is_mobile) ? 'true'  :  'false'; ?>
        };
    </script>
    <?php $submenus=$menus; function getsubmenu($submenus){ if(!(empty($submenus) || (($submenus instanceof \think\Collection || $submenus instanceof \think\Paginator ) && $submenus->isEmpty()))): foreach($submenus as $menu){ ?>
        <li data-name="<?php echo (isset($menu['icon']) && ($menu['icon'] !== '')?$menu['icon']:'component'); ?>" class="layui-nav-item">
            <?php 
                $menu_name=lang($menu['lang']);
                $menu_name=$menu['lang']==$menu_name?$menu['name']:$menu_name;
             if(empty($menu['items'])){ ?>
            <a lay-href="<?php echo $menu['url']; ?>" lay-tips="<?php echo $menu_name; ?>" lay-direction="2">
                <i class="fa fa-<?php echo (isset($menu['icon']) && ($menu['icon'] !== '')?$menu['icon']:'cog'); ?>"></i>
                <cite><?php echo $menu_name; ?></cite>
            </a>
            <?php }else{ ?>
            <a href="javascript:;" lay-tips="<?php echo $menu_name; ?>" lay-direction="2">
                <i class="fa fa-<?php echo (isset($menu['icon']) && ($menu['icon'] !== '')?$menu['icon']:'cog'); ?>" aria-hidden="true" style="position: absolute; top: 38%; left: 28px;"></i>
                <cite><?php echo $menu_name; ?></cite>
            </a>
            <dl class="layui-nav-child">
                <?php getsubmenu1($menu['items']) ?>
            </dl>
            <?php } ?>
        </li>
        <?php } ?>
    <?php endif; } function getsubmenu1($submenus){ foreach($submenus as $menu){ 
        $menu_name=lang($menu['lang']);
        $menu_name=$menu['lang']==$menu_name?$menu['name']:$menu_name;
     if(empty($menu['items'])){ ?>
    <dd data-name="<?php echo $menu_name; ?>">
        <a lay-href="<?php echo $menu['url']; ?>" id="<?php echo $menu['id']; ?>" title="<?php echo $menu_name; ?>"><?php echo $menu_name; ?></a>
    </dd>
    <?php }else{ ?>
    <dd data-name="<?php echo $menu_name; ?>">
        <a href="javascript:;" id="<?php echo $menu['id']; ?>" title="<?php echo $menu_name; ?>"><?php echo $menu_name; ?></a>
        <dl class="layui-nav-child">
            <?php getsubmenu2($menu['items']) ?>
        </dl>
    </dd>
    <?php } }} function getsubmenu2($submenus){foreach($submenus as $menu){ 
        $menu_name=lang($menu['lang']);
        $menu_name=$menu['lang']==$menu_name?$menu['name']:$menu_name;
     ?>
    <dd data-name="{$menu_name"><a lay-href="<?php echo $menu['url']; ?>" id="<?php echo $menu['id']; ?>" title="<?php echo $menu_name; ?>"><?php echo $menu_name; ?></a></dd>
    <?php }} if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                left: 0 !important;
                right: initial !important;
            }
        </style>
    <?php endif; ?>

</head>
<body class="layui-layout-body" style="min-width:<?php echo !empty($_is_mobile) ? 'auto' : '900px'; ?>;overflow: hidden;" class="<?php echo !empty($_is_mobile) ? 'mobile' : ''; ?>">
    <div id="loading"><i class="loadingicon"></i><span><?php echo lang('LOADING'); ?></span></div>
    <div id="LAY_app">
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header">
                <!-- 头部区域 -->
                <ul class="layui-nav layui-layout-left">
                    <li class="layui-nav-item layadmin-flexible" lay-unselect>
                        <a href="javascript:;" layadmin-event="flexible" title="<?php echo lang('SIDE EXPANSION'); ?>">
                            <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                        </a>
                    </li>
                    <li lay-unselect>
                         <!-- 页面标签 -->
                        <div class="layadmin-pagetabs" id="LAY_app_tabs">
                            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
                            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
                            <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                                    <li lay-id="<?php echo url('admin/Main/index'); ?>" lay-attr="<?php echo url('admin/Main/index'); ?>"
                                        class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
                    
                   
                    <li class="layui-nav-item" lay-unselect style="margin-right:10px;">
                        <a href="javascript:;">
                            <?php if(isset($admin['avatar']) && $admin['avatar']): ?>
                                <img class="nav-user-photo" width="30" height="30"
                                    src="<?php echo cmf_get_user_avatar_url($admin['avatar']); ?>" alt="<?php echo $admin['user_login']; ?>"
                                    class="layui-circle">
                                <?php else: ?>
                                <img class="layui-circle" width="30" height="30"
                                    src="/themes/admin_star/public/assets/images/admin_logo.jpg"
                                    alt="<?php echo (isset($admin['user_login']) && ($admin['user_login'] !== '')?$admin['user_login']:''); ?>">
                            <?php endif; ?>
                            <cite><?php echo lang('WELCOME_USER',array('user_nickname' => empty($admin['user_nickname'] )?
                                $admin['user_login'] : $admin['user_nickname'])); ?></cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd style="text-align: center;"><a lay-href="<?php echo url('setting/site'); ?>"><?php echo lang('ADMIN_SETTING_SITE'); ?></a></dd>
                            <dd style="text-align: center;"><a lay-href="<?php echo url('user/userinfo'); ?>"><?php echo lang('ADMIN_USER_USERINFO'); ?></a></dd>
                            <dd style="text-align: center;"><a lay-href="<?php echo url('setting/password'); ?>"><?php echo lang('ADMIN_SETTING_PASSWORD'); ?></a></dd>
                            <hr>
                            <dd style="text-align: center;"><a href="<?php echo url('Public/logout'); ?>"><?php echo lang('LOGOUT'); ?></a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <style>
                .layui-logo1 {
                    top: 85px;
                    width: 250px;
                    height: 180px;
                    text-align: center;
                    color: white;
                    font-size: 15px;
                    background-repeat: no-repeat;
                    background-position: center center;
                }
                /* 侧边栏收缩时的样式 */
                .layadmin-side-shrink .layui-logo1 {
                    width: 60px;
                }
                .layadmin-side-shrink .layui-logo1 .layui-col-md6 {
                    width: 100%;
                    text-align: center;
                }
                .layadmin-side-shrink .layui-logo1 .layui-col-md6 img {
                    width: 30px;
                    height: 30px;
                    margin-left: 0;
                }
                .layadmin-side-shrink .layui-logo1 .layui-col-md6:last-child,
                .layadmin-side-shrink .layui-logo1 .layui-btn-group {
                    display: none;
                }
                /* 收缩时隐藏在线状态 */
                .layadmin-side-shrink .layui-logo1 .layui-hide-type {
                    display: none;
                }
                /* 调整头像容器的样式 */
                .layui-logo1 .layui-row {
                    transition: all .3s;
                }
            </style>
            <!-- 侧边菜单 -->
            <div class="layui-side layui-side-menu">
                <div class="layui-side-scroll layui-row">
                    <div class="layui-logo layui-col-md12" lay-href="<?php echo url('admin/Main/index'); ?>">
                        <?php echo (isset($_admin_setting['admin_name']) && ($_admin_setting['admin_name'] !== '')?$_admin_setting['admin_name']:'ThinkCMF'); ?>
                    </div>
                    <div class="layui-logo1 layui-col-md12">
                        <div class="layui-row">
                            <div class=" layui-col-md6">
                                <img class="layui-circle" width="50" height="50" style="margin-left: 30px;"
                                    src="/themes/admin_star/public/assets/images/admin_logo.jpg" alt="admin">
                            </div>
                            <div class="layui-col-md6 layui-hide-type" style="text-align: left;padding-top: 5px;">
                                <span class="layui-col-md12">Admin</span>
                                <span class="layui-col-md12"><span class="layui-badge-dot layui-bg-green"></span>
                                    在线</span>
                            </div>
                            <div class="layui-btn-group" style="padding-top: 20px;">
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item layui-hide-xs" lay-tips="<?php echo lang('WEBSITE_HOME_PAGE'); ?>" lay-direction="3" lay-unselect>
                                        <a href="/" target="_blank" lay-text="<?php echo lang('WEBSITE_HOME_PAGE'); ?>">
                                            <i class="layui-icon layui-icon-home" style="color: #FFF;"></i>
                                        </a>
                                    </li>
                                </button>
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item" lay-tips="<?php echo lang('刷新'); ?>" lay-direction="3" lay-unselect>
                                        <a href="javascript:;" layadmin-event="refresh" lay-text="刷新">
                                            <i class="layui-icon layui-icon-refresh-3" style="color: #FFF;"></i>
                                        </a>
                                    </li>
                                </button>
                                <?php if(APP_DEBUG): ?>
                                    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                        <li class="layui-nav-item" lay-tips="<?php echo lang('开发面板'); ?>" lay-direction="3" lay-unselect>
                                            <a  lay-href="<?php echo url('admin/Dev/index'); ?>" id="dev-menu-button" data-toggle="tooltip" lay-text="<?php echo lang('开发面板'); ?>">
                                                <i class="layui-icon layui-icon-set" style="color: #FFF;"></i>
                                            </a>
                                        </li>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item" lay-tips="<?php echo lang('ADMIN_SETTING_CLEARCACHE'); ?>" lay-direction="3" lay-unselect>
                                        <?php if(cmf_auth_check(cmf_get_current_admin_id(),'admin/Setting/clearcache')): ?>
                                            <a onclick="syncUserAction()"
                                                layadmin-event="<?php echo lang('ADMIN_SETTING_CLEARCACHE'); ?>"
                                                lay-text="<?php echo lang('ADMIN_SETTING_CLEARCACHE'); ?>">
                                                <i class="layui-icon layui-icon-fonts-clear" style="color: #FFF;"></i>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </button>
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item" lay-tips="<?php echo lang('USER_ADMINASSET_INDEX'); ?>" lay-direction="3" lay-unselect>
                                        <a lay-href="<?php echo url('user/admin_asset/index'); ?>" layadmin-event="index_menu"
                                            lay-text="<?php echo lang('USER_ADMINASSET_INDEX'); ?>">                                                           
                                            <i class="layui-icon layui-icon-template-1" style="color: #FFF;"></i>
                                        </a>
                                    </li>
                                </button>
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item" lay-tips="<?php echo lang('ADMIN_RECYCLEBIN_INDEX'); ?>" lay-direction="3" lay-unselect>
                                        <a lay-href="<?php echo url('admin/RecycleBin/index'); ?>" layadmin-event="index_menu"
                                            lay-text="<?php echo lang('ADMIN_RECYCLEBIN_INDEX'); ?>">                                                           
                                            <i class="layui-icon layui-icon-delete" style="color: #FFF;"></i>
                                        </a>
                                    </li>
                                </button>
                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">
                                    <li class="layui-nav-item layui-hide-xs" lay-tips="<?php echo lang('全屏'); ?>" lay-direction="3" lay-unselect>
                                        <a href="javascript:;" layadmin-event="fullscreen" lay-text="全屏">
                                            <i class="layui-icon layui-icon-screen-full" style="color: #FFF;"></i>
                                        </a>
                                    </li>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md12">
                        <ul class="layui-nav layui-nav-tree arrow3" lay-shrink="all" id="LAY-system-side-menu"
                            lay-filter="layadmin-system-side-menu">
                            <?php echo getsubmenu($submenus); ?>
                        </ul>
                    </div>
                </div>
            </div>
             
            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">
                <div class="layadmin-tabsbody-item layui-show">
                    <iframe src="<?php echo url('Main/index'); ?>" frameborder="0" class="layadmin-iframe"></iframe>
                </div>
            </div>
            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>
        </div>
    </div>
</body>
<script src="/themes/admin_star/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="/static/js/wind.js"></script>
<script src="/themes/admin_star/public/assets/js/bootstrap.min.js"></script>
<script src="/themes/admin_star/public/assets/layui/layui.js"></script>
<script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
<script src="/themes/admin_star/public/assets/simpleboot3/js/adminindex.js?v=<?php echo $_static_version; ?>"></script>
<script>
    localStorage.removeItem('layuiAdmin')
    layui.config({
        base: '/themes/admin_star/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use('index');
   
    function openapp(url, appId, appname, refresh) {
        if (GV.IS_MOBILE) {
            window.location.href = url;
            return;
        }
        var $app = $("#task-content-inner li[app-id='" + appId + "']");
        $("#task-content-inner .active").removeClass("active");
        if ($app.length == 0) {
            var task = $(task_item_tpl).attr("app-id", appId).attr("app-url", url).attr("app-name", appname).addClass("active");
            task.find(".cmf-tabs-item-text").html(appname).attr("title", appname);
            $taskContentInner.append(task);
            $(".appiframe").hide();
            $loading.show();
            $appiframe = $(appiframe_tpl).attr("src", url).attr("id", "appiframe-" + appId);
            $appiframe.appendTo("#content");
            $appiframe.load(function () {
                var srcLoaded = $appiframe.get(0).contentWindow.location;
                if (srcLoaded.pathname == GV.ROOT) {
                    window.location.reload(true);
                }
                $loading.hide();
            });
            calcTaskContentWidth();
        } else {
            $app.addClass("active");
            $(".appiframe").hide();
            var $iframe = $("#appiframe-" + appId);
            var src     = $iframe.get(0).contentWindow.location.href;
            src         = src.substr(src.indexOf("://") + 3);
            if (refresh === true) {
                $loading.show();
                $iframe.attr("src", url);
                $iframe.load(function () {
                    var srcLoaded = $iframe.get(0).contentWindow.location;
                    if (srcLoaded.pathname == GV.ROOT) {
                        window.location.reload(true);
                    }
                    $loading.hide();
                });
            }
            $iframe.show();
        }

        //url要添加参数。获取最外部的window.修改href
        // 支持History API
        if (window.history && history.pushState){
            var tw = window.top;

            var twa =tw.location.href.split("#");
            var newUrl =  twa[0]+"#"+url;
            tw.history.replaceState(null,null,newUrl);
        }



        var taskContentInner = $("#task-content-inner").width();
        var contentWidth     = $("#task-content").width();
        if (taskContentInner <= contentWidth) { 
            return;
        }

        var currentTabIndex = $("#task-content-inner li[app-id='" + appId + "']").index();
        var itemOffset      = 0;
        var currentTabWidth = $("#task-content-inner li[app-id='" + appId + "']").width();

        $("#task-content-inner li:lt(" + currentTabIndex + ')').each(function () {
            itemOffset = itemOffset + $(this).width();
        });

        var cssMarginLeft = $taskContentInner.css("margin-left");

        cssMarginLeft = parseInt(cssMarginLeft.replace("px", ""));


        var marginLeft = currentTabWidth + itemOffset - contentWidth + cssMarginLeft;

        if (marginLeft > 0) {
            marginLeft = -(currentTabWidth + itemOffset - contentWidth);
            $taskContentInner.animate({"margin-left": marginLeft + "px"}, 300, 'swing');
            return;
        }

        if (itemOffset + cssMarginLeft < 0) {
            marginLeft = -itemOffset
            $taskContentInner.animate({"margin-left": marginLeft + "px"}, 300, 'swing');

            return;
        }


    }

    function syncUserAction() {
        layui.use(['layer'], function(){
            var layer = layui.layer;
            // 发起ajax请求
            $.ajax({
                url: "<?php echo url('admin/Setting/clearcache'); ?>",
                type: 'GET',
                success: function(res) {
                    layer.msg('清除缓存成功！');    
                },
                error: function() {
                    layer.msg('清除缓存失败！');
                }
            });
        });
    }
</script>
</html>
