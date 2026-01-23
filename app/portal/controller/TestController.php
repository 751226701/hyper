<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\auth\service\AuthService;
use cmf\controller\HomeBaseController;
use app\portal\model\PortalTagModel;

class TestController extends HomeBaseController
{
    /**
     * 标签
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $sub    = "alice"; // 想要访问资源的用户
        $obj    = "data2"; // 将要被访问的资源
        $act    = "read"; // 用户对资源进行的操作
        $result = AuthService::check($sub, $obj, $act);

        if ($result === true) {
            echo "验证通过！";
        } else {
            echo "验证失败！";
        }
    }

}
