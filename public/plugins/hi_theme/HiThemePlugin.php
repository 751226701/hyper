<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020 SoftLu All rights reserved.
// +----------------------------------------------------------------------
// | Author: 微信 oliverwien
// +----------------------------------------------------------------------
namespace plugins\hi_theme;
use cmf\lib\Plugin;

use think\facade\Config;
use think\facade\Db;

use think\facade\Request;


class HiThemePlugin extends Plugin
{
    public $info = [
        'name'        => 'HiTheme',
        'title'       => '多域名站点',
        'description' => '如：demo.ydc.show，获取的前缀为demo，则使用名为demo的前端模版显示。',
        'status'      => 1,
        'author'      => '易东云',
        'version'     => '1.1.0',
        'demo_url'    => 'https://saas.ydc.show',
        'author_url'  => 'https://saas.ydc.show'
    ];

    public $hasAdmin = 1;
 
    public function install()
    {
        $appDbSqlFile = CMF_ROOT . "public/plugins/hi_theme/data/sql_theme.sql";
        if (file_exists($appDbSqlFile)) {
            $dbConfig = config('database.connections.mysql');
            $sqlList  = cmf_split_sql($appDbSqlFile, $dbConfig['prefix'], $dbConfig['charset']);
            $db       = Db::connect();
            $db->startTrans();
            try {
                foreach ($sqlList as $sql) {
                    $db->execute($sql);
                }
            } catch (\Exception $e) {
                $db->rollback();
                return false;
            }

            return true;
        }

        return false; //安装成功返回true，失败false
        
        
    }

    public function uninstall()
    {
        $database  = Config::get('database.connections.' . Config::get('database.default'));
        $prefix    = $database['prefix'];
        $postCount = db('plugin_theme')->count();
        if ($postCount > 0) {
            return "请先清空插件数据,再卸载！";
        }

        Db::execute("drop table {$prefix}plugin_theme");
        return true; //卸载成功返回true，失败false
    }

    public function switchTheme($param)
    {
        //获取域名前缀，比如demo001.hitheme.cn，获取的前缀为demo001
  //   	$hitheme= explode('.',$_SERVER['HTTP_HOST'])[0];
    	
    	
  //   	echo '<pre>前缀：'.print_r($hitheme,true).'</pre>';
		// $istheme= Db::name('theme')->where('theme',$hitheme)->count();
		// if($istheme){
		// 	return $hitheme;
		// }else{
		// 	return config('cmf_default_theme');
		// }

        $request = Request::instance();
        $now_url = $request->host();


        //echo '<pre>前缀：'.print_r($now_url,true).'</pre>';
        
        $data = Db::name('plugin_theme')->where(["theme_url" => $now_url,"status"=>1])->find();
        
        if(!empty($data) && !empty($data['pc_theme'])){
            if(cmf_is_mobile() == true && !empty($data['mobile_theme'])){
                $newTheme = $data['mobile_theme'];
            }else{
                $newTheme = $data['pc_theme'];
            }
            return $newTheme;
        }


    }
}