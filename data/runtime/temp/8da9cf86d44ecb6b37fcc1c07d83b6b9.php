<?php /*a:2:{s:83:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/setting/site.html";i:1735368768;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/header.html";i:1760897858;}*/ ?>
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
                <form class="layui-form js-ajax-form" role="form" action="<?php echo url('setting/sitePost'); ?>" method="post">
                    <div class="layui-tab layui-tab-brief">
                        <ul class="layui-tab-title">
                            <li class="layui-this"><?php echo lang('WEB_SITE_INFOS'); ?></li>
                            <li><a><?php echo lang('SEO_SETTING'); ?></a></li>
                            <li><a><?php echo lang('User Register Setting'); ?></a></li>
                            <li><a><?php echo lang('CDN Setting'); ?></a></li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div class="layui-form-item">
                                    <label for="input-site-name" class="layui-form-label"><?php echo lang('WEBSITE_NAME'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-site-name" required
                                            lay-verify="required" name="options[site_name]"
                                            value="<?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?>">
                                    </div>
                                </div>
                                <?php if(APP_DEBUG && false): ?>
                                    <div class="row mb-3">
                                        <label for="input-default_app"
                                            class="col-sm-2 col-form-label text-sm-end"><?php echo lang('Default App'); ?></label>
                                        <div class="col-md-8 col-sm-10">
                                            <?php 
                                                $site_default_app=empty($cmf_settings['default_app'])?'demo':$cmf_settings['default_app'];
                                             ?>
                                            <select class="form-control" name="cmf_settings[default_app]"
                                                id="input-default_app">
                                                <?php if(is_array($apps) || $apps instanceof \think\Collection || $apps instanceof \think\Paginator): if( count($apps)==0 ) : echo "" ;else: foreach($apps as $key=>$vo): $default_app_selected = $site_default_app == $vo ? "selected" : "";
                                                     ?>
                                                    <option value="<?php echo $vo; ?>" <?php echo $default_app_selected; ?>><?php echo $vo; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="layui-form-item">
                                    <label for="input-site_icp" class="layui-form-label"><?php echo lang('WEBSITE_ICP'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-site_icp" name="options[site_icp]"
                                            value="<?php echo (isset($site_info['site_icp']) && ($site_info['site_icp'] !== '')?$site_info['site_icp']:''); ?>">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="input-site_icp" class="layui-form-label"><?php echo lang('WEBSITE_GWA'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-site_gwa" name="options[site_gwa]"
                                            value="<?php echo (isset($site_info['site_gwa']) && ($site_info['site_gwa'] !== '')?$site_info['site_gwa']:''); ?>">
                                    </div>
                                </div>
                                <div class="layui-form-item layui-form-text">
                                    <label for="input-site_analytics"
                                        class="layui-form-label"><?php echo lang('WEBSITE_STATISTICAL_CODE'); ?></label>
                                    <div class="layui-input-block">
                                        <textarea class="layui-textarea" id="input-site_analytics"
                                            name="options[site_analytics]"><?php echo (isset($site_info['site_analytics']) && ($site_info['site_analytics'] !== '')?$site_info['site_analytics']:''); ?></textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div>
                                        <button type="submit" class="layui-btn layui-btn-fluid js-ajax-submit"
                                            data-refresh="1">
                                            <i class="layui-icon layui-icon-success" style="color: #FFF;"></i>
                                            <?php echo lang('SAVE'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label for="input-site_seo_title"
                                        class="layui-form-label"><?php echo lang('WEBSITE_SEO_TITLE'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-site_seo_title"
                                            name="options[site_seo_title]" value="<?php echo (isset($site_info['site_seo_title']) && ($site_info['site_seo_title'] !== '')?$site_info['site_seo_title']:''); ?>">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="input-site_seo_keywords"
                                        class="layui-form-label"><?php echo lang('WEBSITE_SEO_KEYWORDS'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-site_seo_keywords"
                                            name="options[site_seo_keywords]"
                                            value="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>">
                                    </div>
                                </div>
                                <div class="layui-form-item layui-form-text">
                                    <label for="input-site_seo_description"
                                        class="layui-form-label"><?php echo lang('WEBSITE_SEO_DESCRIPTION'); ?></label>
                                    <div class="layui-input-block">
                                        <textarea class="layui-textarea" id="input-site_seo_description"
                                            name="options[site_seo_description]"><?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?></textarea>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <div>
                                        <button type="submit" class="layui-btn layui-btn-fluid js-ajax-submit"
                                            data-refresh="0">
                                            <i class="layui-icon layui-icon-success" style="color: #FFF;"></i>
                                            <?php echo lang('SAVE'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label for="input-banned_usernames" class="layui-form-label">
                                        <?php echo lang('User Register Verify'); ?>
                                    </label>
                                    <div class="layui-input-block">
                                        <select class="layui-input" name="cmf_settings[open_registration]">
                                            <option value="0"><?php echo lang('YES'); ?></option>
                                            <?php 
                                                $open_registration_selected =
                                                empty($cmf_settings['open_registration'])?'':'selected';
                                             ?>
                                            <option value="1" <?php echo $open_registration_selected; ?>><?php echo lang('NO'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="form-group" style="display: none;">
                                        <label for="input-banned_usernames"
                                            class="col-sm-2 control-label"><?php echo lang('SPECAIL_USERNAME'); ?></label>
                                        <div class="col-md-6 col-sm-10">
                                            <textarea class="form-control" id="input-banned_usernames"
                                                name="cmf_settings[banned_usernames]"><?php echo (isset($cmf_settings['banned_usernames']) && ($cmf_settings['banned_usernames'] !== '')?$cmf_settings['banned_usernames']:''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div>
                                        <button type="submit" class="layui-btn layui-btn-fluid js-ajax-submit"
                                            data-refresh="1">
                                            <i class="layui-icon layui-icon-success" style="color: #FFF;"></i>
                                            <?php echo lang('SAVE'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label for="input-cdn_static_root" class="layui-form-label" lay-unselect
                                        lay-tips="不能以/结尾；设置这个地址后，请将ThinkCMF下的静态资源文件放在其下面； ThinkCMF下的静态资源文件大致包含以下(如果你自定义后，请自行增加)： themes/admin_default/public/assets static themes/default/public/assets 例如未设置cdn前：jquery的访问地址是/static/js/jquery.js, 设置cdn是后它的访问地址就是：静态资源cdn地址/static/js/jquery.js"><?php echo lang('CDN Root'); ?><i
                                        class="fa fa-question-circle"></i></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" id="input-cdn_static_root"
                                            name="cdn_settings[cdn_static_root]"
                                            value="<?php echo (isset($cdn_settings['cdn_static_root']) && ($cdn_settings['cdn_static_root'] !== '')?$cdn_settings['cdn_static_root']:''); ?>">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div>
                                        <button type="submit" class="layui-btn layui-btn-fluid js-ajax-submit"
                                            data-refresh="1">
                                            <i class="layui-icon layui-icon-success" style="color: #FFF;"></i>
                                            <?php echo lang('SAVE'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
</body>

</html>