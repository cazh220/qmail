<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class User extends Controller
{
	public function add()
	{
		$name	= input('name');
		$ip	= input('ip');

		$name 	= !empty($name) ? addslashes(trim($name)) : '';
		$ip 	= !empty($ip) ? addslashes(trim($ip)) : '';
		
		$User = model('User');
		$result 	= $User->addUser($name, $ip);
		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'fail')));
		}
	}
	
	
	public function user()
	{
		//获取所有用户
		$User = model('User');
		$list = $User->getUserList();
		//print_r($list);die;
		$view = new View();
		$view->assign('list', $list);
		$view->assign('admin_name', Session::get('admin_name'));
		return $view->fetch('admin/admin-list');
	}
	
	public function addUser()
	{
		$view = new View();
		return $view->fetch('admin/admin-add');
	}
	
	public function adminDel()
	{
		$id	= input('id');
		
		$User = model('User');
		$result = $User->userDel($id);
		
		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'fail')));
		}
	} 
	
	public function editAdmin()
	{
		$id	= input('id');
		
		$User = model('User');
		$result = $User->getadmin($id);
		
		$view = new View();
		$view->assign('list', $result);
		return $view->fetch('admin/admin-add');
	}
}
