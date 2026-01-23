<?php /*a:4:{s:100:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/theme/file_public_var_setting.html";i:1727661958;s:77:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/base5.html";i:1727661958;s:86:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/theme/functions.html";i:1727661958;s:84:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/theme/scripts.html";i:1727661958;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/themes/admin_star/public/assets/themes/<?php echo cmf_get_admin_style('arcoadmin'); ?>/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_star/public/assets/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/themes/admin_star/public/assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/themes/admin_star/public/assets/fontawesome/css/v4-shims.min.css" rel="stylesheet" type="text/css">
    <link href="/themes/admin_star/public/assets/themes/<?php echo cmf_get_admin_style('arcoadmin'); ?>/simplebootadmin.css" rel="stylesheet">
    <?php 
        $_is_mobile=cmf_is_mobile();
        $_static_version='1.0.5';
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
    <script src="/themes/admin_star/public/assets/js/jquery-3.6.4.min.js"></script>
    <script src="/themes/admin_star/public/assets/js/jquery-migrate-3.4.0.min.js"></script>
    <script src="/themes/admin_star/public/assets/js/bootstrap5/popper.min.js"></script>
    <script src="/themes/admin_star/public/assets/js/bootstrap5/bootstrap.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script>
        Wind.alias({noty:'/themes/admin_star/public/assets/js/noty-2.4.1.js'})
    </script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container: 'body',
                html: true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; 
    if (!function_exists('_parse_vars')) {
        function _parse_vars($vars,$inputName,$level=1,$widget='',$file_id=''){

 if(is_array($vars) || $vars instanceof \think\Collection || $vars instanceof \think\Paginator): if( count($vars)==0 ) : echo "" ;else: foreach($vars as $varName=>$var): ?>
    <fieldset>
        <div class="row mb-3">
            <?php if(isset($var['title'])): ?>
                <label class="form-label">
                    <?php echo lang($var['title']); if(!(empty($var['rule']['require']) || (($var['rule']['require'] instanceof \think\Collection || $var['rule']['require'] instanceof \think\Paginator ) && $var['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
            <?php endif; $placeholder=empty($var['placeholder'])?'':$var['placeholder']; switch($var['type']): case "text": ?>
                    <div class="controls">
                        <?php if(isset($var['dataSource'])): ?>
                            <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>_text_]" class="form-control"
                                   onclick="doSelectData(this)"
                                   data-source="<?php echo base64_encode(json_encode($var['dataSource'])); ?>"
                                   data-title="<?php echo lang($var['title']); ?>"
                                   value="<?php echo (isset($vars[$varName]['valueText']) && ($vars[$varName]['valueText'] !== '')?$vars[$varName]['valueText']:''); ?>"
                                   placeholder="<?php echo lang($placeholder); ?>">
                            <input type="hidden" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                                   value="<?php echo $vars[$varName]['value']; ?>">
                            <?php else: ?>
                            <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                                   value="<?php echo $vars[$varName]['value']; ?>"
                                   placeholder="<?php echo lang($placeholder); ?>">
                        <?php endif; if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "textarea": ?>
                    <div class="controls">
                        <textarea name="<?php echo $inputName; ?>[<?php echo $varName; ?>]"
                                  class="form-control"
                                  placeholder="<?php echo lang($placeholder); ?>"><?php echo $vars[$varName]['value']; ?></textarea>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "date": ?>
                    <div class="controls">
                        <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control js-bootstrap-date"
                               value="<?php echo $vars[$varName]['value']; ?>"
                               placeholder="<?php echo lang($placeholder); ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "datetime": ?>
                    <div class="controls">
                        <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control js-bootstrap-datetime"
                               value="<?php echo $vars[$varName]['value']; ?>"
                               placeholder="<?php echo lang($placeholder); ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "image": ?>
                    <div class="controls">
                        <input type="hidden" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                               value="<?php echo $vars[$varName]['value']; ?>" id="js-<?php echo $widget; ?><?php echo $varName; ?>-input">
                        <div>
                            <a href="javascript:doUploadOneImage('<?php echo lang('Upload Image'); ?>','#js-<?php echo $widget; ?><?php echo $varName; ?>-input');">
                                <?php if(empty($vars[$varName]['value'])): ?>
                                    <img src="/themes/admin_star/public/assets/images/default-thumbnail.png"
                                         id="js-<?php echo $widget; ?><?php echo $varName; ?>-input-preview"
                                         width="135" style="cursor: pointer"/>
                                    <?php else: ?>
                                    <img src="<?php echo cmf_get_image_preview_url($vars[$varName]['value']); ?>"
                                         id="js-<?php echo $widget; ?><?php echo $varName; ?>-input-preview"
                                         width="135" style="cursor: pointer"/>
                                <?php endif; ?>
                            </a>
                            <?php if(!empty($vars[$varName]['value'])): ?>
                                <br>
                                <button id="js-<?php echo $widget; ?><?php echo $varName; ?>-button-remove"
                                        defaultImage="/themes/admin_star/public/assets/images/default-thumbnail.png"
                                        class="removeImage btn btn-sm" type="button"
                                        onclick="removeImage('<?php echo $widget; ?><?php echo $varName; ?>')"><?php echo lang('Cancel'); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "number": ?>
                    <div class="controls">
                        <input type="number" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                               value="<?php echo $vars[$varName]['value']; ?>"
                               placeholder="<?php echo lang($placeholder); ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "location": ?>
                    <div class="controls">
                        <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>_text_]" class="form-control"
                               onclick="doSelectLocation(this)"
                               data-title="<?php echo lang($var['title']); ?>"
                               value="<?php echo (isset($vars[$varName]['valueText']) && ($vars[$varName]['valueText'] !== '')?$vars[$varName]['valueText']:''); ?>"
                               placeholder="<?php echo lang($placeholder); ?>">
                        <input type="hidden" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                               value="<?php echo $vars[$varName]['value']; ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "file": ?>
                    <div class="controls">
                        <div class="input-group">
                            <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                                   value="<?php echo $vars[$varName]['value']; ?>" id="js-<?php echo $widget; ?><?php echo $varName; ?>-input-file"
                                   placeholder="<?php echo lang($placeholder); ?>">
                            <span class="input-group-addon"> <a
                                    href="javascript:doUploadOne('<?php echo lang('Upload Image'); ?>','#js-<?php echo $widget; ?><?php echo $varName; ?>-input-file','file');"><?php echo lang('Upload Image'); ?></a></span>
                        </div>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "color": ?>
                    <div class="controls">
                        <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control js-color"
                               value="<?php echo $vars[$varName]['value']; ?>" id="js-color-<?php echo $widget; ?><?php echo $varName; ?>"
                               placeholder="<?php echo lang($placeholder); ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "array": ?>
                    <div class="controls">
                        <?php 
                            $arrayValueText=is_array($var['value'])&&count($var['value'])>0?lang('x pieces of data, click to add more',['count'=>count($var['value'])]):'';
                         ?>
                        <textarea class="form-control" placeholder=""
                                  onclick="doEditArrayData(this)"
                                  data-var="<?php echo $varName; ?>"
                                  data-widget="<?php echo $widget; ?>"
                                  data-title="<?php echo $var['title']; ?>"
                                  data-file_id="<?php echo $file_id; ?>"><?php echo $arrayValueText; ?></textarea>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "select": ?>
                    <div class="controls">
                        <?php 
                            $value= $vars[$varName]['value'];
                            $options = $vars[$varName]['options'];
                         ?>
                        <select name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control">
                            <?php if(is_array($options) || $options instanceof \think\Collection || $options instanceof \think\Paginator): if( count($options)==0 ) : echo "" ;else: foreach($options as $optionKey=>$optionItem): $optionSelected=$optionKey==$value?"selected":""; ?>
                                <option value="<?php echo $optionKey; ?>" <?php echo $optionSelected; ?>><?php echo lang($optionItem); ?>
                                </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "slide": ?>
                    <div class="controls">
                        <input type="text" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]" class="form-control"
                               value="<?php echo $vars[$varName]['value']; ?>">
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; case "rich_text": ?>
                    <div class="controls">
                        <div>
                            <script type="text/plain" class="rich_text_content" name="<?php echo $inputName; ?>[<?php echo $varName; ?>]"><?php echo $vars[$varName]['value']; ?></script>
                        </div>
                        <?php if(isset($var['tip'])): ?>
                            <div class="form-text"><?php echo lang($var['tip']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php break; ?>
            <?php endswitch; ?>
        </div>
    </fieldset>
<?php endforeach; endif; else: echo "" ;endif; 
    }
    }
 ?>


</head>
<body class="<?php echo !empty($_is_mobile) ? 'mobile' : ''; ?>">

    <div class="wrap">
        <div class="position-relative">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link"
                       href="<?php echo url('Theme/fileSetting',['file'=>$fileName,'theme'=>$theme,'tab'=>'widget']); ?>">
                        <?php echo lang('Widget'); ?>
                    </a>
                </li>
                <?php if(!(empty($file['more']['vars']) || (($file['more']['vars'] instanceof \think\Collection || $file['more']['vars'] instanceof \think\Paginator ) && $file['more']['vars']->isEmpty()))): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo url('Theme/fileSetting',['file'=>$fileName,'theme'=>$theme,'tab'=>'var']); ?>">
                            <?php echo lang('SETTING'); ?>
                        </a>
                    </li>
                <?php endif; if(!(empty($has_public_var) || (($has_public_var instanceof \think\Collection || $has_public_var instanceof \think\Paginator ) && $has_public_var->isEmpty()))): ?>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?php echo url('Theme/fileSetting',['file'=>$fileName,'theme'=>$theme,'tab'=>'public_var']); ?>">
                            <?php echo lang('Global Settings'); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <form method="post" class="js-ajax-form  margin-top-20" action="admin/theme/<?php echo $theme; ?>/file/setting">
            <?php if(is_array($files) || $files instanceof \think\Collection || $files instanceof \think\Paginator): if( count($files)==0 ) : echo "" ;else: foreach($files as $key=>$file): if($file['id'] != $file_id): if(!(empty($file['more']['vars']) || (($file['more']['vars'] instanceof \think\Collection || $file['more']['vars'] instanceof \think\Paginator ) && $file['more']['vars']->isEmpty()))): ?>
                        <?php echo _parse_vars($file['more']['vars'],'files['.$file['id'].'][vars]',1,'',$file['id']); else: ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div style="display: none;">
                <input type="hidden" name="admin_content_lang" value="<?php echo cmf_current_home_lang(); ?>"/>
                <button type="submit" class="btn btn-primary js-ajax-submit" id="submit-btn"
                        data-success="successCallback">
                    <i class="fa fa-save fa-fw"></i> <?php echo lang('SAVE'); ?>
                </button>
            </div>
        </form>

    </div>

<script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>

    <script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
<script src="/themes/admin_star/public/assets/js/jquery-ui.min.js?v=<?php echo $_static_version; ?>"></script>
<script type="text/javascript">
    //编辑器路径定义
    var editorURL = GV.WEB_ROOT;
</script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>
<script>

    $(function () {

        $('.rich_text_content').each(function (i, item) {
            var editor = new baidu.editor.ui.Editor();
            editor.render(item);
            try {
                editor.sync();
            } catch (err) {
            }
        });

    });

    $('.widgets-group').sortable({
        connectWith: '.widgets-group',
        items: "> li.widgets-group-item",
        cursor: "move",
        opacity: 0.8,
        forcePlaceholderSize: true,
        scrollSensitivity: 100,
        scrollSpeed: 50,
        tolerance: 'pointer',
        stop: function (event, ui) {
            console.log(ui.item.parent().html())
            //$('.widgets-group').sortable('cancel')
            var widgetIds = {};
            $('.widgets-group').each(function () {
                var blockName = $(this).data('block_name');
                var fileId = 'file' + $(this).data('file_id');
                $(this).find('li.widgets-group-item').each(function () {
                    if (!widgetIds.hasOwnProperty(fileId)) {
                        widgetIds[fileId] = {};
                    }

                    if (!widgetIds[fileId].hasOwnProperty(blockName)) {
                        widgetIds[fileId][blockName] = [];
                    }

                    widgetIds[fileId][blockName].push({
                        file_id: $(this).data('file_id'),
                        widget_id: $(this).data('id')
                    });
                });

            });

            $.ajax({
                url: GV.API_ROOT['api'] + "admin/theme/widgets/sort?admin_content_lang=" + $('.widgets-group').data('admin_content_lang'),
                type: 'POST',
                dataType: 'json',
                data: widgetIds,
                success: function (data) {
                    parent.simulator.location.reload(true);
                }
            })
            console.log(widgetIds);
        },
        over: function (event, ui) {
            // ui.placeholder.addClass('ui-sortable-placeholder-disabled');
        }
    })

    // $( "li", '.widgets-group' ).draggable({
    //     // cancel: "a.ui-icon", // clicking an icon won't initiate dragging
    //     revert: "invalid", // when not dropped, the item will revert back to its initial position
    //     containment: "document",
    //     cursor: "move"
    // });

    // $( '.widgets-group').droppable({
    //     accept: ".widgets-group > li",
    //     tolerance: 'pointer',
    //     classes: {
    //         "ui-droppable-active": "ui-state-active",
    //         "ui-droppable-hover": "ui-state-hover"
    //     },
    //     drop: function( event, ui ) {
    //         ui.draggable.appendTo($(this));
    //     }
    // });


    Wind.use('colorpicker', function () {
        $('.js-color').each(function () {
            var $this = $(this);
            $this.ColorPicker({
                livePreview: true,
                onChange: function (hsb, hex, rgb) {
                    $this.val('#' + hex);
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            });
        });

    });

    function doSelectData(obj) {
        var $obj = $(obj);
        var $realInput = $obj.next();
        var selectedObjectsId = $realInput.val();
        var dataSource = $obj.data('source');
        var title = $obj.data('title');
        parent.openIframeLayer("<?php echo url('Theme/dataSource'); ?>?ids=" + selectedObjectsId + '&data_source=' + dataSource, title, {
            area: GV.IS_MOBILE ? ['100%', '100%'] : ['95%', '90%'],
            offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
            btn: ["<?php echo lang('OK'); ?>", "<?php echo lang('Cancel'); ?>"],
            yes: function (index, layero) {
                var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                var selectedObjects = iframeWin.confirm();
                if (selectedObjects.selectedObjectsId.length == 0) {
                    layer.msg("<?php echo lang('You have not selected any data!'); ?>");
                    return;
                }
                $realInput.val(selectedObjects.selectedObjectsId.join(','));
                $obj.val(selectedObjects.selectedObjectsName.join(','));
                parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
            }
        });
    }


    function doEditArrayData(obj) {
        var $obj = $(obj);
        var mVar = $obj.data('var');
        var title = $obj.data('title');
        var widget = $obj.data('widget');
        widget = widget ? '&widget=' + widget : '';
        var fileId = $obj.data('file_id');
        if (!fileId) {
            fileId = '<?php echo $file_id; ?>';
        }

        var blockName = "<?php echo (isset($block_name) && ($block_name !== '')?$block_name:''); ?>";
        blockName = blockName ? '&block_name=' + blockName : '';
        var widgetId = "<?php echo (isset($widget_id) && ($widget_id !== '')?$widget_id:''); ?>";
        widgetId = widgetId ? '&widget_id=' + widgetId : '';

        parent.openIframeLayer(
            "<?php echo url('Theme/fileArrayData'); ?>?tab=<?php echo (isset($tab) && ($tab !== '')?$tab:''); ?>&file_id=" + fileId + "&" + 'var=' + mVar + widget + blockName + widgetId,
            title,
            {
                area: GV.IS_MOBILE ? ['100%', '100%'] : ['95%', '90%'],
                offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
                btn: ["<?php echo lang('OK'); ?>", "<?php echo lang('CANCEL'); ?>"],
                yes: function (index, layero) {
                    var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                    var result = iframeWin.confirm();

                    if (result) {
                        parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }
                },
                end: function () {
                    window.location.reload();
                }
            }
        );
    }

    function doWidgetSetting(obj) {
        var $obj = $(obj);
        var $widgetsBlock = $obj.parents('.widgets-group');
        var $parent = $obj.parent();
        var blockName = $widgetsBlock.data('block_name');
        var widgetId = $parent.data('id');
        var fileId = $widgetsBlock.data('file_id');
        var title = $parent.data('title');

        parent.openIframeLayer(
            "<?php echo url('Theme/widgetSetting'); ?>?file_id=" + fileId + "&widget_id=" + widgetId + '&block_name=' + blockName,
            title,
            {
                area: GV.IS_MOBILE ? ['100%', '100%'] : ['600px', '100%'],
                offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
                btn: ["<?php echo lang('SAVE'); ?>", "<?php echo lang('CANCEL'); ?>"],
                yes: function (index, layero) {
                    var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                    var result = iframeWin.confirm();

                    if (result) {
                        parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }

                },
                end: function () {
                    parent.simulator.location.reload(true);
                }
            }
        );
    }

    function doSelectLocation(obj) {
        var $obj = $(obj);
        var title = $obj.data('title');
        var $realInput = $obj.next();
        var location = $realInput.val();

        parent.openIframeLayer(
            "<?php echo url('dialog/map'); ?>?location=" + location,
            title,
            {
                area: GV.IS_MOBILE ? ['100%', '100%'] : ['95%', '90%'],
                offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
                btn: ["<?php echo lang('OK'); ?>", "<?php echo lang('CANCEL'); ?>"],
                yes: function (index, layero) {
                    var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                    var location = iframeWin.confirm();
                    $realInput.val(location.lng + ',' + location.lat);
                    $obj.val(location.address);
                    parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            }
        );
    }

    /**
     * 单个图片上传
     * @param dialog_title 上传对话框标题
     * @param input_selector 图片容器
     * @param extra_params 额外参数，object
     * @param app  应用名,CMF的应用名
     */
    function doUploadOneImage(dialog_title, input_selector, extra_params, app) {
        parent.openUploadDialog(dialog_title, function (dialog, files) {
            $(input_selector).val(files[0].filepath);
            $(input_selector + '-preview').attr('src', files[0].preview_url);

            $(input_selector + '-name').val(files[0].name);
            $(input_selector + '-name-text').text(files[0].name);

        }, extra_params, 0, 'image', app);
    }

    /**
     * 单个文件上传
     * @param dialog_title 上传对话框标题
     * @param input_selector 图片容器
     * @param filetype 文件类型，image,video,audio,file
     * @param extra_params 额外参数，object
     * @param app  应用名,CMF的应用名
     */
    function doUploadOne(dialog_title, input_selector, filetype, extra_params, app) {
        filetype = filetype ? filetype : 'file';
        parent.openUploadDialog(dialog_title, function (dialog, files) {
            $(input_selector).val(files[0].filepath);
            $(input_selector + '-preview').attr('href', files[0].preview_url);

            $(input_selector + '-name').val(files[0].name);
            $(input_selector + '-name-text').text(files[0].name);
        }, extra_params, 0, filetype, app);
    }

    function confirm() {
        $('#submit-btn').click();
    }

    function removeImage(wigetVarName) {
        //需要定位input和image
        //清空Input
        $('#js-' + wigetVarName + '-input').val('');
        //修改Image为原图。
        var defaultImage = $('#js-' + wigetVarName + '-button-remove').attr('defaultImage');
        $('#js-' + wigetVarName + '-input-preview').attr('src', defaultImage);
        //移除自身
        $('#js-' + wigetVarName + '-button-remove').remove();

    }

    function _openThemeFileWidgets(obj) {
        var $obj = $(obj);
        // var $parent = $obj.parent();
        // var $widgetsBlock = $obj.parents('.widgets-group');
        // var widgetId = $parent.data('id');

        var title = $obj.data('title');
        var blockName = $obj.data('block_name');
        var theme = $obj.data('theme');
        var fileId = $obj.data('file_id');

        parent.openIframeLayer(
            "<?php echo url('Theme/fileWidgets'); ?>?file=" + fileId + "&theme=" + theme + '&block_name=' + blockName,
            title,
            {
                area: GV.IS_MOBILE ? ['100%', '100%'] : ['600px', '100%'],
                offset: GV.IS_MOBILE ? ['0px', '0px'] : 'auto',
                btn: ["<?php echo lang('SAVE'); ?>", "<?php echo lang('CANCEL'); ?>"],
                yes: function (index, layero) {
                    var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                    var result = iframeWin.confirm();

                    if (result) {
                        parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }

                },
                end: function () {
                    parent.simulator.location.reload(true);
                }
            }
        );
    }

</script>

    <script>
        function successCallback(data, statusText, xhr, $form) {
            function _refresh() {
                if (data.url) {
                    //返回带跳转地址
                    window.location.href = data.url;
                } else {
                    if (data.code == 1) {
                        //刷新当前页
                        reloadPage(window);
                    }
                }
            }

            noty({
                text: data.msg,
                type: 'success',
                layout: 'topCenter',
                modal: true,
                // animation: {
                //     open: 'animated bounceInDown', // Animate.css class names
                //     close: 'animated bounceOutUp', // Animate.css class names
                // },
                timeout: 800,
                callback: {
                    afterClose: function () {
                        if (parent.afterSaveSetting) {
                            parent.afterSaveSetting();
                        }
                        _refresh();
                    }
                }
            });
        }
    </script>

</body>
</html>
