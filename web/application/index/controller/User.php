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

	public function checkname2()
	{
		$name = $_GET['name'];
		$Customer = model('Customer');
		$list = $Customer->getCustomerByName($name);
		if(count($list) > 1)
		{
			exit(json_encode(array('code'=>0,'msg'=>'用户名已存在')));
		}
		exit(json_encode(array('code'=>1,'msg'=>'ok')));
	}

	public function checkmobile2()
	{
		$mobile = $_GET['mobile'];
		$Customer = model('Customer');
		$list = $Customer->getCustomerByMobile($mobile);
		if(count($list) > 1)
		{
			exit(json_encode(array('code'=>0,'msg'=>'手机号已存在')));
		}
		exit(json_encode(array('code'=>1,'msg'=>'ok')));
	}

	public function add()
	{
		$param = array();
		if(!empty($_POST['param']))
		{
			$param = json_decode($_POST['param'], true);
		}

		$Customer = model('Customer');
		$result = $Customer->addCustomer($param);

		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'添加成功')));
		}
		exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
	}

	public function edit()
	{
		$param = array();
		if(!empty($_POST['param']))
		{
			$param = json_decode($_POST['param'], true);
		}
		$id = !empty($param['c_id']) ? intval($param['c_id']) : 0;
		unset($param['c_id']);
		$Customer = model('Customer');
		$result = $Customer->updateCustomer($param, $id);

		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'编辑成功')));
		}
		exit(json_encode(array('code'=>0,'msg'=>'编辑失败')));
	}

	public function del()
	{
		$id = $_GET['id'];
		$Customer = model('Customer');
		$result = $Customer->delCustomer($id);
		if(!$result)
		{
			exit(json_encode(array('code'=>0,'msg'=>'删除失败')));
		}
		exit(json_encode(array('code'=>1,'msg'=>'删除成功')));
	}

}













