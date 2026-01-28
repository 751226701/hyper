<?php /*a:2:{s:81:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/admin/main/index.html";i:1734405220;s:78:"/www/wwwroot/www.hyperionrobot.com/public/themes/admin_star/public/header.html";i:1760897858;}*/ ?>
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
<style>
    .panel {
        margin-bottom: 18px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 3px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    }


    .bg-teal-gradient {
        background: #39CCCC !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #39CCCC), color-stop(1, #7adddd)) !important;
        background: -ms-linear-gradient(bottom, #39CCCC, #7adddd) !important;
        background: -moz-linear-gradient(center bottom, #39CCCC 0%, #7adddd 100%) !important;
        background: -o-linear-gradient(#7adddd, #39CCCC) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7adddd', endColorstr='#39CCCC', GradientType=0) !important;
        color: #fff;
    }

    .bg-light-blue-gradient {
        background: #4397fd !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4397fd), color-stop(1, #80b8fe)) !important;
        background: -ms-linear-gradient(bottom, #4397fd, #80b8fe) !important;
        background: -moz-linear-gradient(center bottom, #4397fd 0%, #80b8fe 100%) !important;
        background: -o-linear-gradient(#80b8fe, #4397fd) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80b8fe', endColorstr='#4397fd', GradientType=0) !important;
        color: #fff;
    }

    .bg-blue-gradient {
        background: #1688f1 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #1688f1), color-stop(1, #3899f3)) !important;
        background: -ms-linear-gradient(bottom, #1688f1, #3899f3) !important;
        background: -moz-linear-gradient(center bottom, #1688f1 0%, #3899f3 100%) !important;
        background: -o-linear-gradient(#3899f3, #1688f1) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3899f3', endColorstr='#1688f1', GradientType=0) !important;
        color: #fff;
    }

    .bg-aqua-gradient {
        background: #1688f1 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #1688f1), color-stop(1, #3899f3)) !important;
        background: -ms-linear-gradient(bottom, #1688f1, #3899f3) !important;
        background: -moz-linear-gradient(center bottom, #1688f1 0%, #3899f3 100%) !important;
        background: -o-linear-gradient(#3899f3, #1688f1) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3899f3', endColorstr='#1688f1', GradientType=0) !important;
        color: #fff;
    }

    .bg-yellow-gradient {
        background: #f39c12 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f39c12), color-stop(1, #f7bc60)) !important;
        background: -ms-linear-gradient(bottom, #f39c12, #f7bc60) !important;
        background: -moz-linear-gradient(center bottom, #f39c12 0%, #f7bc60 100%) !important;
        background: -o-linear-gradient(#f7bc60, #f39c12) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7bc60', endColorstr='#f39c12', GradientType=0) !important;
        color: #fff;
    }

    .bg-purple-gradient {
        background: #605ca8 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #605ca8), color-stop(1, #9491c4)) !important;
        background: -ms-linear-gradient(bottom, #605ca8, #9491c4) !important;
        background: -moz-linear-gradient(center bottom, #605ca8 0%, #9491c4 100%) !important;
        background: -o-linear-gradient(#9491c4, #605ca8) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#9491c4', endColorstr='#605ca8', GradientType=0) !important;
        color: #fff;
    }

    .bg-green-gradient {
        background: #18bc9c !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #18bc9c), color-stop(1, #1cdcb6)) !important;
        background: -ms-linear-gradient(bottom, #18bc9c, #1cdcb6) !important;
        background: -moz-linear-gradient(center bottom, #18bc9c 0%, #1cdcb6 100%) !important;
        background: -o-linear-gradient(#1cdcb6, #18bc9c) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1cdcb6', endColorstr='#18bc9c', GradientType=0) !important;
        color: #fff;
    }

    .bg-red-gradient {
        background: #f75444 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f75444), color-stop(1, #f98175)) !important;
        background: -ms-linear-gradient(bottom, #f75444, #f98175) !important;
        background: -moz-linear-gradient(center bottom, #f75444 0%, #f98175 100%) !important;
        background: -o-linear-gradient(#f98175, #f75444) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f98175', endColorstr='#f75444', GradientType=0) !important;
        color: #fff;
    }

    .bg-black-gradient {
        background: #111 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #111), color-stop(1, #2b2b2b)) !important;
        background: -ms-linear-gradient(bottom, #111, #2b2b2b) !important;
        background: -moz-linear-gradient(center bottom, #111 0%, #2b2b2b 100%) !important;
        background: -o-linear-gradient(#2b2b2b, #111) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2b2b2b', endColorstr='#111', GradientType=0) !important;
        color: #fff;
    }

    .bg-maroon-gradient {
        background: #D81B60 !important;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #D81B60), color-stop(1, #e73f7c)) !important;
        background: -ms-linear-gradient(bottom, #D81B60, #e73f7c) !important;
        background: -moz-linear-gradient(center bottom, #D81B60 0%, #e73f7c 100%) !important;
        background: -o-linear-gradient(#e73f7c, #D81B60) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e73f7c', endColorstr='#D81B60', GradientType=0) !important;
        color: #fff;
    }

    .no-border {
        border: 0 !important;
    }

    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 15px;
        color: inherit;
    }

    .pull-right {
        float: right !important;
    }

    .label-primary {
        background-color: #444c69;
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }

    .panel h5 {
        font-size: 14px;
        margin-top: 9px;
        margin-bottom: 9px;
    }

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3 {
        margin-top: 18px;
        margin-bottom: 9px;
    }

    .parentp {
        position: relative;
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
    }

    .grid-demo {
        padding: 10px;
        line-height: 50px;
        text-align: center;
        background-color: #79C48C;
        color: #fff;
    }
</style>

<body style="background-color:#f5f7f9 ;    background-repeat: no-repeat;
background-position: 50%;
background-size: 100%;">
<?php 
    $json = '{
        "show_win_arr": {
            "all": 37,
            "wei": 37
        },
        "list": [
            {
                "post_title": "王楚钦:拿生命换混双金牌 我做到了",
                "create_time": "2024-07-31",
                "category_name": "公告消息"
            },
            {
                "post_title": "中共中央召开党外人士座谈会 习近平主持并发表",
                "create_time": "2024-07-31",
                "category_name": "公告消息"
            },
            {
                "post_title": "数智化转型助推大学教育高质量发展",
                "create_time": "2024-07-31",
                "category_name": "填报须知"
            },
            {
                "post_title": "关于PDF文件上传的要求",
                "create_time": "2024-07-26",
                "category_name": "填报须知"
            },
            {
                "post_title": "关于2024年度精神文明填报须知",
                "create_time": "2024-07-25",
                "category_name": "公告消息"
            },
            {
                "post_title": "关于PDF文件上传的要求",
                "create_time": "2024-07-25",
                "category_name": "填报须知"
            },
            {
                "post_title": "关于2024年度精神文明填报须知",
                "create_time": "2024-07-25",
                "category_name": "公告消息"
            }
        ],
        "type_radio": [
            {
                "value": 924,
                "name": "规范性文件"
            },
            {
                "value": 99,
                "name": "说明报告"
            },
            {
                "value": 13,
                "name": "通知"
            },
            {
                "value": 2,
                "name": "方案、计划"
            }
        ],
        "pass_arr": [
            {
                "back_num": "0",
                "task_num": 6,
                "pass_radio": 100,
                "department_name": "国有资产"
            },
            {
                "back_num": "0",
                "task_num": 10,
                "pass_radio": 100,
                "department_name": "财务处"
            },
            {
                "back_num": "0",
                "task_num": 1,
                "pass_radio": 100,
                "department_name": "党委宣传"
            },
            {
                "back_num": "0",
                "task_num": 13,
                "pass_radio": 100,
                "department_name": "创新创业"
            },
            {
                "back_num": "0",
                "task_num": 1,
                "pass_radio": 100,
                "department_name": "党委宣传"
            }
        ],
        "yue_arr": [
            "2024-01",
            "2024-02",
            "2024-03",
            "2024-04",
            "2024-05",
            "2024-06",
            "2024-07",
            "2024-08",
            "2024-09",
            "2024-10",
            "2024-11",
            "2024-12"
        ],
        "yue_arr_tj": [
            0,
            0,
            0,
            0,
            0,
            0,
            704,
            0,
            0,
            0,
            0,
            0
        ],
        "yue_arr_tg": [
            0,
            0,
            0,
            0,
            0,
            0,
            703,
            0,
            0,
            0,
            0,
            0
        ],
        "rel_return_yq": [
            {
                "task_num": 52,
                "department_id": 3,
                "department_name": "党委宣传",
                "task_yuqi_nmu": 51
            },
            {
                "task_num": 40,
                "department_id": 23,
                "department_name": "文化旅游",
                "task_yuqi_nmu": 26
            },
            {
                "task_num": 40,
                "department_id": 25,
                "department_name": "财经管理",
                "task_yuqi_nmu": 19
            },
            {
                "task_num": 37,
                "department_id": 30,
                "department_name": "马克思主",
                "task_yuqi_nmu": 18
            },
            {
                "task_num": 30,
                "department_id": 12,
                "department_name": "教务处（",
                "task_yuqi_nmu": 15
            },
            {
                "task_num": 39,
                "department_id": 40,
                "department_name": "国际教育",
                "task_yuqi_nmu": 14
            }
        ],
        "rel_return_df": [
            {
                "task_num": 40,
                "department_id": 28,
                "department_name": "汽车与交",
                "task_score": "99.62"
            },
            {
                "task_num": 14,
                "department_id": 36,
                "department_name": "创新创业",
                "task_score": "99.42"
            },
            {
                "task_num": 34,
                "department_id": 6,
                "department_name": "院团委",
                "task_score": "99.14"
            },
            {
                "task_num": 40,
                "department_id": 24,
                "department_name": "现代信息",
                "task_score": "99.10"
            },
            {
                "task_num": 40,
                "department_id": 26,
                "department_name": "电商物流",
                "task_score": "99.10"
            },
            {
                "task_num": 12,
                "department_id": 14,
                "department_name": "招生就业",
                "task_score": "99.08"
            }
        ],
        "rel_return": [
            {
                "task_num": 12,
                "department_id": 14,
                "department_name": "招生就业",
                "task_num_ready": 12,
                "radio": 100
            },
            {
                "task_num": 14,
                "department_id": 36,
                "department_name": "创新创业",
                "task_num_ready": 13,
                "radio": 93
            },
            {
                "task_num": 40,
                "department_id": 28,
                "department_name": "汽车与交",
                "task_num_ready": 37,
                "radio": 93
            },
            {
                "task_num": 11,
                "department_id": 37,
                "department_name": "继续教育",
                "task_num_ready": 10,
                "radio": 91
            },
            {
                "task_num": 34,
                "department_id": 6,
                "department_name": "院团委",
                "task_num_ready": 31,
                "radio": 91
            },
            {
                "task_num": 40,
                "department_id": 26,
                "department_name": "电商物流",
                "task_num_ready": 35,
                "radio": 88
            },
            {
                "task_num": 40,
                "department_id": 24,
                "department_name": "现代信息",
                "task_num_ready": 35,
                "radio": 88
            },
            {
                "task_num": 19,
                "department_id": 16,
                "department_name": "科技开发",
                "task_num_ready": 16,
                "radio": 84
            },
            {
                "task_num": 40,
                "department_id": 20,
                "department_name": "智能制造",
                "task_num_ready": 33,
                "radio": 83
            }
        ],
        "myechart": {
            "department_name": [
                "党政办公室（内控办、维稳办、法制办）",
                "组织部（机关党总支、党校）",
                "党委宣传部（统战部、文明办）",
                "院工会（离退休人员服务处、关工委）",
                "纪检监察室",
                "院团委",
                "学生工作部（学生处、武装部）",
                "人事处（教师工作部、教师发展中心）",
                "发展规划处（高等职业教育研究中心）",
                "财务处",
                "审计处",
                "教务处（质量办）",
                "后勤管理处",
                "招生就业处（校友工作办公室、基金会）",
                "保卫处（保卫工作部、综治办）",
                "科技开发处",
                "国有资产管理处",
                "基本建设处",
                "合作交流处",
                "智能制造学院",
                "电子与物联网学院",
                "智慧健康学院",
                "文化旅游学院",
                "现代信息技术学院（软件学院、大数据双创基地）",
                "财经管理学院",
                "电商物流学院",
                "数字创意与设计学院",
                "汽车与交通学院",
                "音乐学院（公共艺术教学部）",
                "马克思主义学院",
                "基础教学部",
                "附属技校",
                "图文中心",
                "信息中心",
                "综合实训中心（职业技能鉴定中心）",
                "创新创业中心（创业学院）",
                "继续教育与培训中心",
                "督导办公室（专业建设与产业发展研究院）",
                "招标采购中心",
                "国际教育学院（国际工程学院）"
            ],
            "sum_task": [
                30,
                29,
                52,
                17,
                17,
                34,
                42,
                41,
                14,
                18,
                12,
                30,
                25,
                12,
                16,
                19,
                11,
                12,
                11,
                40,
                40,
                40,
                40,
                40,
                40,
                40,
                40,
                40,
                43,
                37,
                16,
                11,
                14,
                15,
                13,
                14,
                11,
                12,
                11,
                39
            ],
            "push_task": [
                "21",
                "22",
                "1",
                "12",
                "12",
                "31",
                "33",
                "29",
                "10",
                "10",
                "7",
                "15",
                "20",
                "12",
                "13",
                "16",
                "6",
                "8",
                "7",
                "33",
                "33",
                "29",
                "14",
                "35",
                "21",
                "35",
                "32",
                "37",
                "35",
                "19",
                "10",
                "0",
                "8",
                "11",
                "10",
                "13",
                "10",
                "8",
                "0",
                "25"
            ]
        },
        "return": {
            "dtb": 335,
            "yq": 335,
            "ytb": 703
        },
        "year": 2023
    }';
    $json_arr = json_decode($json,true);
    $show_win_arr = $json_arr['show_win_arr'];
    $list = $json_arr['list'];
    $type_radio = json_encode($json_arr['type_radio']);
    $pass_arr = $json_arr['pass_arr'];
    $yue_arr = json_encode($json_arr['yue_arr']);
    $yue_arr_tj = json_encode($json_arr['yue_arr_tj']);
    $yue_arr_tg = json_encode($json_arr['yue_arr_tg']);
    $rel_return_yq = $json_arr['rel_return_yq'];
    $rel_return_df = $json_arr['rel_return_df'];
    $rel_return = $json_arr['rel_return'];
    $myechart = json_encode($json_arr['myechart']);
    $return = $json_arr['return'];
    $year = $json_arr['year'];
 ?>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md9">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md4" style="opacity: 0.9;color: white;">
                        <div class="layui-card" style="background-color: gray;">
                            <div class="layui-card-header"  style="background-color: gray;color: white;"><i class="layui-icon layui-icon-spread-left"
                                    style="font-size: 14px;padding-right: 5px;color: white;"></i>待填报任务</div>
                            <div class="layui-card-body"  style="background-color: gray;">
                                <div class="layadmin-shortcut"
                                    style="height: 115px;">
                                    <div class="layui-col-md6">
                                        <div class="panel-body   no-border">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="no-margins"><?php echo $return['dtb']; ?><span style="font-size: 14px;margin-left: 20px;">个</span></h1>
                                                        <div class="font-bold">
                                                            <small><span class="layui-badge layui-bg-gray"><?php echo $year; ?>年待填报任务</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md6">
                                        <div id="echart" style="width: 100%;height: 100px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md4">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="layui-icon layui-icon-ok-circle"
                                    style="font-size: 14px;padding-right: 5px;"></i>已完成总任务数</div>
                            <div class="layui-card-body">
                                <div class="layui-carousel layadmin-shortcut"
                                    style="height: 115px;background-color: white;">
                                    <div class="layui-col-md6">
                                        <div class="panel-body   no-border">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="no-margins"><?php echo $return['ytb']; ?><span style="font-size: 14px;margin-left: 20px;">个</span></h1>
                                                        <div class="font-bold">
                                                            <small><span class="layui-badge layui-bg-gray"><?php echo $year; ?>年已完成任务总数</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md6">
                                        <div id="echart1" style="width: 100%;height: 100px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md4">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="layui-icon layui-icon-close-fill"
                                    style="font-size: 14px;padding-right: 5px;"></i>已逾期任务数</div>
                            <div class="layui-card-body">
                                <div class="layui-carousel layadmin-shortcut"
                                    style="height: 115px;background-color: white;">
                                    <div class="layui-col-md6">
                                        <div class="panel-body   no-border">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="no-margins"><?php echo $return['yq']; ?><span style="font-size: 14px;margin-left: 20px;">个</span></h1>
                                                        <div class="font-bold">
                                                            <small><span class="layui-badge layui-bg-gray"
                                                                   ><?php echo $year; ?>年已逾期任务总数</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md6">
                                        <div id="echart2" style="width: 100%;height: 100px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md8">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <i class="layui-icon layui-icon-spread-left" style="font-size: 14px;padding-right: 5px;"></i>单位得分情况
                            </div>
                            <div class="layui-card-body">
                                <div class="layui-row layui-col-space15">
                                    <div class="layui-col-md6">
                                        <table class="layui-table">
                                            <colgroup>
                                              <col>
                                              <col>
                                              <col>
                                            </colgroup>
                                            <thead>
                                              <tr>
                                                <th>排行</th>
                                                <th>部门</th>
                                                <th>总任务</th>
                                                <th>分值</th>
                                              </tr> 
                                            </thead>
                                            <tbody>
                                                <?php if(is_array($rel_return_df) || $rel_return_df instanceof \think\Collection || $rel_return_df instanceof \think\Paginator): if( count($rel_return_df)==0 ) : echo "" ;else: foreach($rel_return_df as $key=>$value): ?>
                                                    <tr>
                                                        <td><?php echo $key+1; ?></td>
                                                        <td><?php echo $value['department_name']; ?></td>
                                                        <td><?php echo $value['task_num']; ?></td>
                                                        <td><?php echo $value['task_score']; ?></td>
                                                      </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="layui-col-md6">
                                        <div id="myechart" style="width: 100%;height: 270px;"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md4">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="layui-icon layui-icon-screen-restore" style="font-size: 14px;padding-right: 5px;"></i>单位逾期预警</div>
                            <div class="layui-card-body">
                                <div class="layui-row layui-col-space15">
                                    <div class="layui-col-md12">
                                        <table class="layui-table">
                                            <colgroup>
                                            <col>
                                            <col>
                                            <col>
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>部门</th>
                                                <th>总任务</th>
                                                <th>逾期</th>
                                            </tr> 
                                            </thead>
                                            <tbody>
                                                <?php if(is_array($rel_return_yq) || $rel_return_yq instanceof \think\Collection || $rel_return_yq instanceof \think\Paginator): if( count($rel_return_yq)==0 ) : echo "" ;else: foreach($rel_return_yq as $key=>$value): ?>
                                                    <tr>
                                                        <td><?php echo $key+1; ?></td>
                                                        <td><?php echo $value['department_name']; ?></td>
                                                        <td><?php echo $value['task_num']; ?></td>
                                                        <td><?php echo $value['task_yuqi_nmu']; ?></td>
                                                    </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="layui-icon layui-icon-spread-left" style="font-size: 14px;padding-right: 5px;"></i>各部门完成排行</div>
                    <div class="layui-card-body">
                        <br>
                        <?php if(is_array($rel_return) || $rel_return instanceof \think\Collection || $rel_return instanceof \think\Paginator): if( count($rel_return)==0 ) : echo "" ;else: foreach($rel_return as $key=>$value): ?>
                            <div class="layui-progress"  lay-showPercent="yes">
                                <div class="layui-progress-bar layui-bg-blue" lay-percent="<?php echo $value['radio']; ?>%"></div>
                            </div>
                            <div style="padding-bottom: 20px;"><?php echo $key+1; ?>&nbsp;&nbsp;&nbsp;<?php if($key == 0): ?>🚀<?php endif; ?><?php echo $value['department_name']; ?></div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="layui-icon layui-icon-spread-left" style="font-size: 14px;padding-right: 5px;"></i>月任务提交数量图表</div>
                    <div class="layui-card-body">
                        <div id="twomyechart" style="width: 100%;height: 245px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="layui-icon layui-icon-slider" style="font-size: 14px;padding-right: 5px;"></i>各部门活跃度</div>
                    <div class="layui-card-body">
                        <table class="layui-table">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                <th>排行</th>
                                <th>名称</th>
                                <th>驳回</th>
                                <th>总任务</th>
                                <th>通过率</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php if(is_array($pass_arr) || $pass_arr instanceof \think\Collection || $pass_arr instanceof \think\Paginator): if( count($pass_arr)==0 ) : echo "" ;else: foreach($pass_arr as $key=>$vo): ?>
                                <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $vo['department_name']; ?></td>
                                <td><?php echo $vo['back_num']; ?></td>
                                <td><?php echo $vo['task_num']; ?></td>
                                <td><?php echo $vo['pass_radio']; ?>%</td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="layui-icon layui-icon-radio"  style="font-size: 14px;padding-right: 5px;"></i>各指标点任务数占比</div>
                    <div class="layui-card-body">
                        <div id="myechart2" style="width: 100%;height: 245px;">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="layui-icon layui-icon-speaker"  style="font-size: 14px;padding-right: 5px;"></i>平台信息通知</div>
                    <div class="layui-card-body">
                        <ul style="line-height: 35px;">
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$value): ?>
                                <li><span class="layui-badge-dot" style="margin-right: 10px;"></span><?php echo $value['post_title']; ?></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="layui-row layui-col-space15" style="height: 30px;"></div> -->
    </div>
    <script src="/themes/admin_star/public/assets/js/echarts.js"></script>
    <script src="/themes/admin_star/public/assets/js/echarts-theme.js"></script>
    <script>
        var myChart = echarts.init(document.getElementById('echart'), 'walden');
        var myChart1 = echarts.init(document.getElementById('echart1'), 'walden');
        var myChart2 = echarts.init(document.getElementById('echart2'), 'walden');
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '',
                subtext: ''
            },
            color: [
                "#18d1b1",
                "#3fb1e3",
                "#626c91",
                "#a0a7e6",
                "#c4ebad",
                "#96dee8"
            ],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            toolbox: {
                show: false,
                feature: {
                    magicType: { show: true, type: ['stack', 'tiled'] },
                    saveAsImage: { show: true }
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            yAxis: {
                axisLine: {
                    show: false // 这里设置为false即可去掉Y轴线
                }
            },
            grid: [{
                left: '1',
                top: '1',
                right: '1',
                bottom: 1
            }],
            series: [{
                name: '',
                type: 'line',
                smooth: true,
                areaStyle: {
                    normal: {}
                },
                lineStyle: {
                    normal: {
                        width: 1.5
                    }
                },
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            }]
        };
        var option1 = {
            title: {
                text: '',
                subtext: ''
            },
            color: [
                "#3fb1e3",
            ],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            toolbox: {
                show: false,
                feature: {
                    magicType: { show: true, type: ['stack', 'tiled'] },
                    saveAsImage: { show: true }
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            yAxis: {
                axisLine: {
                    show: false // 这里设置为false即可去掉Y轴线
                }
            },
            grid: [{
                left: '1',
                top: '1',
                right: '1',
                bottom: 1
            }],
            series: [{
                name: '',
                type: 'line',
                smooth: true,
                areaStyle: {
                    normal: {}
                },
                lineStyle: {
                    normal: {
                        width: 1.5
                    }
                },
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            }]
        };
        var option2 = {
            title: {
                text: '',
                subtext: ''
            },
            color: [
                "#626c91",
                
            ],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            toolbox: {
                show: false,
                feature: {
                    magicType: { show: true, type: ['stack', 'tiled'] },
                    saveAsImage: { show: true }
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            yAxis: {
                axisLine: {
                    show: false // 这里设置为false即可去掉Y轴线
                }
            },
            grid: [{
                left: '1',
                top: '1',
                right: '1',
                bottom: 1
            }],
            series: [{
                name: '',
                type: 'line',
                smooth: true,
                areaStyle: {
                    normal: {}
                },
                lineStyle: {
                    normal: {
                        width: 1.5
                    }
                },
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            }]
        };

        myChart.setOption(option);
        $(window).resize(function () {
            myChart.resize();
        });
        myChart1.setOption(option1);
        $(window).resize(function () {
            myChart1.resize();
        });
        myChart2.setOption(option2);
        $(window).resize(function () {
            myChart2.resize();
        });


        $(document).on("click", ".btn-refresh", function () {
            setTimeout(function () {
                myChart.resize();
            }, 0);
        });
        //双线图
        var twomyechart = echarts.init(document.getElementById("twomyechart"), 'walden');
        var option8 = {
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['提交', '通过']
            },
            xAxis: {
                type: 'category',
                data: <?php echo $yue_arr; ?>
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                name: '提交',
                type: 'line',
                data: <?php echo $yue_arr_tj; ?>
            }, {
                name: '通过',
                type: 'line',
                data: <?php echo $yue_arr_tg; ?>
            }],
            grid: [{
                left: '40',
                top: '50',
                right: '20',
                bottom: 30
            }],
        };
        twomyechart.setOption(option8);
        $(window).resize(function () {
            twomyechart.resize();
        });


        $(document).on("click", ".btn-refresh", function () {
            setTimeout(function () {
                twomyechart.resize();
            }, 0);
        });


        // 第二个图表
        var myechart = echarts.init(document.getElementById("myechart"), 'walden');
        var temp = <?php echo $myechart; ?>;
        var option9 = {
            title: {
                text: '',
                subtext: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['全部任务', '完成任务']
            },
            toolbox: {
                show: false,
                feature: {
                    magicType: { show: true, type: ['stack', 'tiled'] },
                    saveAsImage: { show: true }
                }
            },
            calculable: true,
            xAxis: [
                {
                 type: 'category',
                 data: temp.department_name,
                 axisLabel: {
                             formatter: function(value) {
                                var res = value;
                                if(res.length > 5) {
                                    res = res.substring(0, 2) + "..";
                                }
                                return res;
                            }
                        }
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            grid: [{
                left: '40',
                top: '50',
                right: '20',
                bottom: 30
            }],
            series: [
                {
                    name: '全部任务',
                    radius: "100%",
                    type: 'bar',
                    data: temp.sum_task,
                    markPoint: {
                        data: [
                            { type: 'max', name: '最大值' },
                            { type: 'min', name: '最小值' }
                        ]
                    },
                    markLine: {
                        data: [
                            { type: 'average', name: '平均值' }
                        ]
                    }
                },
                {
                    radius: "100%",
                    name: '完成任务',
                    type: 'bar',
                    data: temp.push_task,
                    markPoint: {
                        data: [
                            { name: '年最高', value: 182.2, xAxis: 7, yAxis: 183, symbolSize: 18 },
                            { name: '年最低', value: 2.3, xAxis: 11, yAxis: 3 }
                        ]
                    },
                    markLine: {
                        data: [
                            { type: 'average', name: '平均值' }
                        ]
                    }
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myechart.setOption(option9);
        $(window).resize(function () {
            myechart.resize();
        });


        $(document).on("click", ".btn-refresh", function () {
            setTimeout(function () {
                myechart.resize();
            }, 0);
        });
        //第三个图表
        var bingechart = echarts.init(document.getElementById('myechart2'), 'walden');
        var bingoption = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                left: 'center'
            },
            series: [
                {
                name: '',
                type: 'pie',
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 3
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                    show: true,
                    fontSize: 10,
                    }
                },
                labelLine: {
                    show: false
                },
                data: <?php echo $type_radio; ?>
                }
            ]
        };

         // 使用刚指定的配置项和数据显示图表。
        bingechart.setOption(bingoption);
        $(window).resize(function () {
            bingechart.resize();
        });


        $(document).on("click", ".btn-refresh", function () {
            setTimeout(function () {
                bingechart.resize();
            }, 0);
        });
    </script>
</body>

</html>