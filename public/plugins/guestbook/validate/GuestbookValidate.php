<?php
// +----------------------------------------------------------------------
// | Wien Designs [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Wien Designs All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <oliverwien@yeah.net>
// +----------------------------------------------------------------------
namespace plugins\guestbook\validate;
use think\Validate;

class GuestbookValidate extends Validate
{
    protected $rule = [
        //'name' => 'require',
        //'tel' => 'require',
        //'email' => 'require|email',
		'phone' => 'require',
        //'subject' => 'require',
        //'message' => 'require',
    ];

    protected $message = [
        'name.require'  => '请输入您的姓名',
        'email.require'  => '请输入您的邮箱',
        'email.email'  => '请输入正确邮箱',
        'phone.require' => '请填写您的电话'
    ];

}