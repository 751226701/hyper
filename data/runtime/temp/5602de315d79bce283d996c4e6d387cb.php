<?php /*a:2:{s:89:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/portal/admin_article/add.html";i:1768566572;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/header.html";i:1760897858;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }

    .btn-cancel-thumbnail {
        margin-top: 5px;
    }

    #photos,
    #files {
        margin-bottom: 0;
    }

    /* 添加固定底部按钮样式 */
    .form-fixed-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, .1);
        z-index: 999;
    }

    .form-fixed-footer .layui-btn {
        width: calc((100% - 20px) / 2);
        margin: 0;
        border-radius: 0;
        float: left;
    }

    .form-fixed-footer .layui-btn:first-child {
        margin-right: 20px;
    }

    /* 为底部按钮留出空间 */
    .layui-fluid {
        padding-bottom: 60px;
    }
</style>
<!-- 开始修改Vditor -->
<link rel="stylesheet" href="/static/css/index.css?v=3.11.1" />
<!-- 结束修改Vditor -->
<script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}" class="layui-form-item" style="margin-bottom: 5px;">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">
        <div class="layui-input-block" style="margin-left: 0; display: flex; align-items: center;">
            <input class="layui-input" id="photo-{id}-name" type="text" name="photo_names[]" value="{name}"
                   style="width: 300px; margin-right: 8px;" title="图片名称">
            <img id="photo-{id}-preview" src="{url}" 
                 style="height:36px; width:36px; object-fit: cover; border-radius: 2px; margin-right: 8px; cursor: pointer;"
                 onclick="imagePreviewDialog(this.src);">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-normal" href="javascript:uploadOneImage('图片上传','#photo-{id}');" title="上传">
                    <i class="layui-icon layui-icon-upload"></i>
                </a>
                <a class="layui-btn layui-btn-danger" href="javascript:(function(){$('#saved-image{id}').remove();})();" title="删除">
                    <i class="layui-icon layui-icon-delete"></i>
                </a>
                <a class="layui-btn layui-btn-warm" href="javascript:(function(){$('#saved-image{id}').before($('#saved-image{id}').next());})();" title="下移">
                    <i class="layui-icon layui-icon-down"></i>
                </a>
            </div>
        </div>
    </li>
</script>
<script type="text/html" id="files-item-tpl">
    <li id="saved-file{id}" class="layui-form-item" style="margin-bottom: 5px;">
        <input id="file-{id}" type="hidden" name="file_urls[]" value="{filepath}">
        <div class="layui-input-block" style="margin-left: 0; display: flex; align-items: center;">
            <input class="layui-input layui-input-sm" id="file-{id}-name" type="text" name="file_names[]" value="{name}"
                   style="width: 300px;  margin-right: 8px;" title="文件名称">
            <a class="layui-btn layui-btn-primary" id="file-{id}-preview" 
               href="{preview_url}" target="_blank" title="下载">
                <i class="layui-icon layui-icon-download"></i>
            </a>
            <div class="layui-btn-group" style="display: flex;">
                <a class="layui-btn layui-btn-normal"  href="javascript:uploadOne('文件上传','#file-{id}','file');" title="上传">
                    <i class="layui-icon layui-icon-upload"></i>
                </a>
                <a class="layui-btn layui-btn-danger" href="javascript:(function(){$('#saved-file{id}').remove();})();" title="删除">
                    <i class="layui-icon layui-icon-delete"></i>
                </a>
                <a class="layui-btn layui-btn-warm" href="javascript:(function(){$('#saved-file{id}').before($('#saved-file{id}').next());})();" title="下移">
                    <i class="layui-icon layui-icon-down"></i>
                </a>
            </div>
        </div>
    </li>
</script>
</head>

<body>
    <div class="layui-fluid">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-tab layui-tab-brief">
                    <ul class="layui-tab-title">
                        <li><a href="<?php echo url('AdminArticle/index'); ?>">文章管理</a></li>
                        <li class="layui-this"><a href="<?php echo url('AdminArticle/add'); ?>">添加文章</a></li>
                    </ul>
                    <div class="layui-tab-content">
                        <form class="layui-form layui-form-pane js-ajax-form" action="<?php echo url('AdminArticle/addPost'); ?>"
                            method="post">
                            <div class="layui-row layui-col-space15">
                                <div class="layui-col-md9">
                                    <div class="layui-card">
                                        <div class="layui-card-body">
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">分类<span
                                                        class="form-required">*</span></label>
                                                <div class="layui-input-block">
                                                    <input class="layui-input" type="text" required value=""
                                                        placeholder="请选择分类" onclick="doSelectCategory();"
                                                        id="js-categories-name-input" readonly />
                                                    <input class="layui-input" type="hidden" value=""
                                                        name="post[categories]" id="js-categories-id-input" />
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">标题<span
                                                        class="form-required">*</span></label>
                                                <div class="layui-input-block">
                                                    <input class="layui-input" type="text" name="post[post_title]"
                                                        id="title" required value="" placeholder="请输入标题" />
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">副标题</label>
                                                <div class="layui-input-block">
                                                    <input class="layui-input" type="text" name="post[more][post_title]"
                                                        id="sub_title" value="" placeholder="请输入副标题" />
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">关键词</label>
                                                <div class="layui-input-block">
                                                    <input class="layui-input" type="text" name="post[post_keywords]"
                                                        id="keywords" value="" placeholder="请输入关键字,多关键词之间用英文逗号隔开">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">文章来源</label>
                                                <div class="layui-input-block">
                                                    <input class="layui-input" type="text" name="post[post_source]"
                                                        id="source" value="" placeholder="请输入文章来源">
                                                </div>
                                            </div>
                                            <div class="layui-form-item layui-form-text">
                                                <label class="layui-form-label">摘要</label>
                                                <div class="layui-input-block">
                                                    <textarea class="layui-textarea" name="post[post_excerpt]"
                                                        placeholder="请填写摘要"></textarea>
                                                </div>
                                            </div>
                                            <div class="layui-form-item layui-form-text">
                                                <label class="layui-form-label">内容</label>
                                                <div class="layui-input-block">
                                                    <div id="vditor"></div>
                                                    <textarea id="content" name="post[post_content]"style="display:none" required></textarea>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-inline" style="margin-right: 0;">
                                                    <label class="layui-form-label">相册</label>
                                                    <div class="layui-input-inline" style="width: auto;">
                                                        <ul id="photos" class="pic-list list-unstyled"></ul>
                                                        <a href="javascript:uploadMultiImage('图片上传','#photos','photos-item-tpl');"
                                                            class="layui-btn">
                                                            <i class="layui-icon layui-icon-upload"></i> 选择图片
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-inline" style="margin-right: 0;">
                                                    <label class="layui-form-label">附件</label>
                                                    <div class="layui-input-inline" style="width: auto;">
                                                        <ul id="files" class="pic-list list-unstyled"></ul>
                                                        <a href="javascript:uploadMultiFile('附件上传','#files','files-item-tpl','file');"
                                                            class="layui-btn">
                                                            <i class="layui-icon layui-icon-upload"></i> 选择文件
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-inline" style="margin-right: 0;">
                                                    <label class="layui-form-label">音频</label>
                                                    <div class="layui-input-inline" style="width: auto;">
                                                        <div class="layui-input-block"
                                                            style="margin-left: 0; display: flex; align-items: center;">
                                                            <input class="layui-input" id="file-audio" type="text"
                                                                name="post[more][audio]"
                                                                value="<?php echo (isset($post['more']['audio']) && ($post['more']['audio'] !== '')?$post['more']['audio']:''); ?>"
                                                                placeholder="请上传音频文件"
                                                                style="width: 300px; margin-right: 8px;">
                                                            <?php if(!(empty($post['more']['audio']) || (($post['more']['audio'] instanceof \think\Collection || $post['more']['audio'] instanceof \think\Paginator ) && $post['more']['audio']->isEmpty()))): ?>
                                                                <a class="layui-btn layui-btn-primary"
                                                                    id="file-audio-preview"
                                                                    href="<?php echo cmf_get_file_download_url($post['more']['audio']); ?>"
                                                                    target="_blank" title="播放">
                                                                    <i class="layui-icon layui-icon-play"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                            <div class="layui-btn-group">
                                                                <a class="layui-btn layui-btn-normal"
                                                                    href="javascript:uploadOne('文件上传','#file-audio','audio');"
                                                                    title="上传">
                                                                    <i class="layui-icon layui-icon-upload"></i>
                                                                </a>
                                                                <a class="layui-btn layui-btn-danger"
                                                                    href="javascript:(function(){$('#file-audio').val('');})();"
                                                                    title="删除">
                                                                    <i class="layui-icon layui-icon-delete"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-inline" style="margin-right: 0;">
                                                    <label class="layui-form-label">视频</label>
                                                    <div class="layui-input-inline" style="width: auto;">
                                                        <div class="layui-input-block"
                                                            style="margin-left: 0; display: flex; align-items: center;">
                                                            <input class="layui-input" id="file-video" type="text"
                                                                name="post[more][video]"
                                                                value="<?php echo (isset($post['more']['video']) && ($post['more']['video'] !== '')?$post['more']['video']:''); ?>"
                                                                placeholder="请上传视频文件"
                                                                style="width: 300px; margin-right: 8px;">
                                                            <?php if(!(empty($post['more']['video']) || (($post['more']['video'] instanceof \think\Collection || $post['more']['video'] instanceof \think\Paginator ) && $post['more']['video']->isEmpty()))): ?>
                                                                <a class="layui-btn layui-btn-primary"
                                                                    id="file-video-preview"
                                                                    href="<?php echo cmf_get_file_download_url($post['more']['video']); ?>"
                                                                    target="_blank" title="播放">
                                                                    <i class="layui-icon layui-icon-play"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                            <div class="layui-btn-group">
                                                                <a class="layui-btn layui-btn-normal"
                                                                    href="javascript:uploadOne('文件上传','#file-video','video');"
                                                                    title="上传">
                                                                    <i class="layui-icon layui-icon-upload"></i>
                                                                </a>
                                                                <a class="layui-btn layui-btn-danger"
                                                                    href="javascript:(function(){$('#file-video').val('');})();"
                                                                    title="删除">
                                                                    <i class="layui-icon layui-icon-delete"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-col-md3">
                                    <div class="layui-card">
                                        <div class="layui-card-header">缩略图</div>
                                        <div class="layui-card-body">
                                            <div class="text-center">
                                                <input type="hidden" name="post[more][thumbnail]" id="thumbnail"
                                                    value="">
                                                <div style="width: 135px; margin: 0 auto;">
                                                    <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                                        <img src="/themes/admin_star/public/assets/images/default-thumbnail.png"
                                                            id="thumbnail-preview" width="135"
                                                            style="cursor: pointer" />
                                                    </a>
                                                    <button type="button"
                                                        class="layui-btn layui-btn-primary layui-btn-sm btn-cancel-thumbnail"
                                                        style="width: 135px; margin-top: 8px;">
                                                        取消图片
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-card">
                                        <div class="layui-card-header">发布时间</div>
                                        <div class="layui-card-body">
                                            <input class="layui-input" type="text" name="post[published_time]"
                                                value="<?php echo date('Y-m-d H:i:s',time()); ?>" id="published-time" readonly>
                                        </div>
                                    </div>
                                    <div class="layui-card">
                                        <div class="layui-card-header">文章模板</div>
                                        <div class="layui-card-body">
                                            <select class="layui-select" name="post[more][template]"
                                                id="more-template-select">
                                                <option value="">请选择模板</option>
                                                <?php if(is_array($article_theme_files) || $article_theme_files instanceof \think\Collection || $article_theme_files instanceof \think\Paginator): if( count($article_theme_files)==0 ) : echo "" ;else: foreach($article_theme_files as $key=>$vo): $value=preg_replace('/^portal\//','',$vo['file']); ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $vo['name']; ?> <?php echo $vo['file']; ?>.html</option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 修改按钮容器 -->
                            <div class="form-fixed-footer">
                                <button type="submit" class="layui-btn js-ajax-submit"> <i
                                        class="layui-icon layui-icon-success"></i><?php echo lang('ADD'); ?></button>
                                <a class="layui-btn layui-btn-primary"
                                    href="<?php echo url('AdminArticle/index'); ?>"><?php echo lang('BACK'); ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
    <!-- 开始修改Vditor -->
    <script src="/static/js/index.min.js?v=3.11.1"></script>
    <script type="text/javascript">
        var vditor; // 全局变量声明
        $(function () {
            vditor = new Vditor('vditor', { // 初始化编辑器
                 height: 500,
                 width: '100%',
                 placeholder: '输入Markdown内容...',
                 mode: 'sv',  // 分屏模式，支持实时预览
                 counter: {
                     enable: true,
                     type: 'markdown'
                 },
                  // 全局Markdown配置
                markdown: {
                    toc: true,
                    footnotes: true,
                    autoSpace: true,
                    fixTermTypo: true,
                    listStyle: true,
                    gfm: true,
                    breaks: true,
                    tasklists: true,
                    math: {
                        engine: 'KaTeX'
                    }
                },
                preview: {
                    delay: 500,
                    mode: 'both',  // 分屏预览模式
                    markdown: {
                        toc: true,  // 启用目录
                        autoSpace: true,  // 自动空格
                        listStyle: true,  // 启用列表样式
                        fixTermTypo: true,  // 修复术语拼写
                        footnotes: true,  // 启用脚注
                        gfm: true,  // GitHub Flavored Markdown
                        breaks: true,  // 支持换行
                        tasklists: true  // 支持任务列表
                    },
                    hljs: {
                        enable: true,
                        style: 'github'
                    }
                },
                 // 禁用缓存功能
                 cache: {
                     enable: false
                 },
                 // 工具栏配置
                 toolbar: [
                     'emoji',
                     'headings',
                     'bold',
                     'italic',
                     'strike',
                     'link',
                     'list',
                     'ordered-list',
                     'check',
                     'outdent',
                     'indent',
                     'quote',
                     'line',
                     'code',
                     'inline-code',
                     'insert-before',
                     'insert-after',
                     'upload',
                     'table',
                     'undo',
                     'redo',
                     'fullscreen',
                     'edit-mode',
                     'both',
                     'preview',
                     'help'
                 ],
                // 内容变化时同步到隐藏域
                input: function (value) {
                    $('#content').val(value);
                    console.log('Vditor内容变化，已同步:', value);
                },
                // 编辑器失焦时同步内容
                blur: function (value) {
                    $('#content').val(value);
                    console.log('Vditor失焦，内容已同步:', value);
                },
                // 编辑器准备好后的回调
                after: function () {
                    console.log('Vditor编辑器初始化完成');
                    // 如果隐藏域有内容，则设置到编辑器
                    var hiddenContent = $('#content').val();
                    if (hiddenContent) {
                        vditor.setValue(hiddenContent);
                    }
                },
                upload: {
                    handler(files) {
                        // 支持多图循环上传并回显
                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const formData = new FormData();
                            formData.append('file', file);

                            $.ajax({
                                url: '/user/asset/vditor',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success(data) {
                                    if (data && data.code === 1 && data.data && data.data.url) {
                                        // 自定义Markdown格式
                                        const markdownContent = `\n![${data.data.name}](${data.data.url})\n`;
                                        vditor.insertValue(markdownContent);
                                    } else {
                                        layer.msg('图片上传失败');
                                    }
                                },
                                error() {
                                    layer.msg('图片上传出错');
                                }
                            });
                        }
                    }
                }
            });
            // 监听提交按钮点击事件
            $('.js-ajax-submit').on('click', function (e) {
                // 在按钮点击时同步内容
                if (typeof vditor !== 'undefined' && vditor && vditor.getValue) {
                    var content = vditor.getValue();
                    $('#content').val(content);
                    console.log('提交按钮点击，内容已同步到隐藏域:', content);
                }
            });

            // 表单提交前再次确保vditor内容同步到隐藏域
            $('.js-ajax-form').on('submit', function (e) {
                // 获取vditor的内容并同步到隐藏域
                if (typeof vditor !== 'undefined' && vditor && vditor.getValue) {
                    var content = vditor.getValue();
                    $('#content').val(content);
                    console.log('表单提交，内容已同步到隐藏域:', content);
                }
            });
        });
    </script>
    <!-- 结束修改Vditor -->
    <script>
        $('.btn-cancel-thumbnail').click(function () {
            $('#thumbnail-preview').attr('src', '/themes/admin_star/public/assets/images/default-thumbnail.png');
            $('#thumbnail').val('');
        });
        function doSelectCategory() {
            var selectedCategoriesId = $('#js-categories-id-input').val();
            openIframeLayer("<?php echo url('AdminCategory/select'); ?>?ids=" + selectedCategoriesId, '请选择分类', {
                area: ['700px', '400px'],
                btn: ['确定', '取消'],
                yes: function (index, layero) {
                    //do something
                    var iframeWin = window[layero.find('iframe')[0]['name']];
                    var selectedCategories = iframeWin.confirm();
                    if (selectedCategories.selectedCategoriesId.length == 0) {
                        layer.msg('请选择分类');
                        return;
                    }
                    $('#js-categories-id-input').val(selectedCategories.selectedCategoriesId.join(','));
                    $('#js-categories-name-input').val(selectedCategories.selectedCategoriesName.join(' '));
                    //console.log(layer.getFrameIndex(index));
                    layer.close(index); //如果设定yes回调，需进行手工关闭
                }
            });
        }
    </script>
    <script>
        layui.use(['form', 'laydate'], function () {
            var form = layui.form,
                laydate = layui.laydate;

            //日期时间选择器
            laydate.render({
                elem: '#published-time',
                type: 'datetime',
                trigger: 'click'
            });

            // ... 其他现有的JavaScript代码 ...
        });
    </script>
</body>

</html>