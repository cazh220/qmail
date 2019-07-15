<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\IpBase;

class User extends IpBase
{
	public function index()
	{
		$view = new View();

		return $view->fetch('index/user');
	}

	public function list()
	{
		$keyword = !empty($_GET['keyword']) ? trim($_GET['keyword']) : '';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$limit = !empty($_GET['limit']) ? intval($_GET['limit']) : 10;

		$Customer = model('Customer');
		$list = $Customer->getCustomerList($keyword, $page, $limit);
		$data = array('code'=>0, 'msg'=>'ok', 'count'=>$list['count'], 'data'=>$list['data']);
		exit(json_encode($data));
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

		if(empty($param['uses_num']))
		{
			$param['uses_num'] = 0;
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













