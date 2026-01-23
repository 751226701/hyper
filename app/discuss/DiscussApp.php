<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------

namespace app\discuss;

//Demo应用英文名，改成你的应用英文就行了
use think\facade\Config;
use think\facade\Db;

class DiscussApp
{

    // 应用安装
    public function install()
    {
        $appDbSqlFile = CMF_ROOT . "app/discuss/data/discuss.sql";
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

    // 应用卸载
    public function uninstall()
    {
      
        return true; //卸载成功返回true，失败false
    }

}
