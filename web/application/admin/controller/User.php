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

	public function edit()
	{
		$name	= input('name');
		$ip	= input('ip');
		$id	= input('cid');

		$name 	= !empty($name) ? addslashes(trim($name)) : '';
		$ip 	= !empty($ip) ? addslashes(trim($ip)) : '';
		$id 	= !empty($id) ? intval($id) : 0;
		
		$User = model('User');
		$result 	= $User->editUser($name, $ip, $id);
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
		return $view->fetch('admin/user-list');
	}
	
	public function addUser()
	{
		$view = new View();
		return $view->fetch('admin/user-add');
	}
	
	public function userDel()
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
	
	public function editUser()
	{
		$id	= input('id');
		
		$User = model('User');
		$result = $User->getUser($id);
		$view = new View();
		$view->assign('list', $result[0]);
		return $view->fetch('admin/user-edit');
	}
}
