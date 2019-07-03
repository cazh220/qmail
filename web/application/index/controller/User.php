<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class User extends Base
{
	public function index()
	{
		
		/*
		$User = model('User');
		$list = $Article->getArticleList('关于我们');
		*/
		$view = new View();
		/*
		$view->assign('article', !empty($list[0]) ? $list[0] : array());
		$view->assign('system', Session::get('system_info'));
		$view->assign('qrcode', Session::get('qrcode'));
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		*/
		return $view->fetch('index/user');
	}

	public function checkname()
	{
		$name = $_GET['name'];
		$Customer = model('Customer');
		if($Customer->getCustomerByName($name))
		{
			exit(json_encode(array('code'=>0,'msg'=>'用户名已存在')));
		}
		exit(json_encode(array('code'=>1,'msg'=>'ok')));
	}

	public function checkmobile()
	{
		$mobile = $_GET['mobile'];
		$Customer = model('Customer');
		if($Customer->getCustomerByMobile($mobile))
		{
			exit(json_encode(array('code'=>0,'msg'=>'手机号已存在')));
		}
		exit(json_encode(array('code'=>1,'msg'=>'ok')));
	}

	public function add()
	{

	}

}