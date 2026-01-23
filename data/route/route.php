<?php
use think\facade\Route;

Route::get('啊啊啊啊/:id', 'discuss/Article/index?cid=2')->append(array('cid' => '2',));

Route::get('产品中心/:id', 'portal/Article/index?cid=7')->append(array('cid' => '7',))
->pattern(array('id' => '\d+',  'cid' => '\d+',));

Route::get('测试分类/:id', 'discuss/Article/index?cid=11')->append(array('cid' => '11',))
->pattern(array('id' => '\d+',  'cid' => '\d+',));

Route::get('快A/:id', 'portal/Article/index?cid=20')->append(array('cid' => '20',))
->pattern(array('id' => '\d+',  'cid' => '\d+',));

Route::get('快B/:id', 'portal/Article/index?cid=21')->append(array('cid' => '21',))
->pattern(array('id' => '\d+',  'cid' => '\d+',));

Route::get('啊啊啊啊', 'discuss/List/index?id=2')->append(array('id' => '2',))
->pattern(array('id' => '\d+',  'cid' => '\d+',));

Route::get('产品中心', 'portal/List/index?id=7')->append(array('id' => '7',))
->pattern(array('id' => '\d+',));

Route::get('测试分类', 'discuss/List/index?id=11')->append(array('id' => '11',))
->pattern(array('id' => '\d+',));

Route::get('快A', 'portal/List/index?id=20')->append(array('id' => '20',))
->pattern(array('id' => '\d+',));

Route::get('快B', 'portal/List/index?id=21')->append(array('id' => '21',))
->pattern(array('id' => '\d+',));


