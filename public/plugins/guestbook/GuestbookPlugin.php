<?php
// +----------------------------------------------------------------------
// | Wien Designs [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Wien Designs All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <oliverwien@yeah.net>
// +----------------------------------------------------------------------
namespace plugins\guestbook;
use cmf\lib\Plugin;

// use think\facade\lang;
use think\Cookie;

use think\facade\Config;
use think\facade\Db;

class GuestbookPlugin extends Plugin {

    public $info = [
        'name' => 'Guestbook',
        'title' => '留言板',
        'description' => '网站留言板',
        'status' => 1,
        'author' => '易东云',
        'version' => '1.0',
        'demo_url' => 'https://saas.ydc.show',
        'author_url' => 'http://saas.ydc.show'
    ];

    //插件是否有后台管理界面
    public $hasAdmin = 1;

    // 插件安装
    public function install() {
        //读取数据库配置内容
        $appDbSqlFile = CMF_ROOT . "public/plugins/guestbook/data/guestbook.sql";
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

    // 插件卸载
    public function uninstall() {
        $database  = Config::get('database.connections.' . Config::get('database.default'));
        $prefix    = $database['prefix'];
        $postCount = db('plugin_guestbook')->count();
        if ($postCount > 0) {
            return "请先清空插件数据,再卸载！";
        }

        Db::execute("drop table {$prefix}plugin_guestbook");
        return true; //卸载成功返回true，失败false
    }
    
    public function guestbook($param){
        $config = $this->getConfig();
    
        $this->assign('config', $config);
        return $this->fetch( 'widget' );
    }
    


}