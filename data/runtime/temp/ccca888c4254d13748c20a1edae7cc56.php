<?php /*a:2:{s:93:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/portal/admin_category/select.html";i:1760681397;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/header.html";i:1760897858;}*/ ?>
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
            <div class="layui-card-body">
                <form method="post" class="layui-form js-ajax-form" action="<?php echo url('AdminCategory/listorders'); ?>">
                    <table class="layui-table" lay-size="sm">
                        <thead>
                            <tr>
                                <th width="16">
                                    <input type="checkbox" lay-skin="primary" lay-filter="allChoose" 
                                           class="js-check-all" data-direction="x" data-checklist="js-check-x">
                                </th>
                                <th width="50">ID</th>
                                <th>分类名称</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $categories_tree; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/static/js/admin.js?v=<?php echo $_static_version; ?>"></script>
<script>
    $('.data-td').click(function (e) {
        // console.log(e);
        var $parent = $(this).parents('.data-item-tr');
        
        var $input = $parent.find('input');
        if ($input.is(':checked')) {
            $input.prop('checked', false);
        } else {
            $input.prop('checked', true);
        }
    });
    
    function confirm() {
        var selectedCategoriesId   = [];
        var selectedCategoriesName = [];
        var selectedCategories     = [];
        $('.js-check:checked').each(function () {
            var $this = $(this);
            selectedCategoriesId.push($this.val());
            selectedCategoriesName.push($this.data('name'));

            selectedCategories.push({
                id: $this.val(),
                name: $this.data('name')
            });
        });

        return {
            selectedCategories: selectedCategories,
            selectedCategoriesId: selectedCategoriesId,
            selectedCategoriesName: selectedCategoriesName
        };
    }
</script>
<script>
layui.use(['form'], function(){
    var form = layui.form;
    
    // 全选
    form.on('checkbox(allChoose)', function(data){
        var child = $(data.elem).closest('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item){
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
    
    // form.on('checkbox(choose)', function(data){
       
    //     form.render('checkbox');
    // });
    
});

</script>
</body>
</html>
