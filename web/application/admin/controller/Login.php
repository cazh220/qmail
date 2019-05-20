<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Login extends Controller
{
    public function index()
    {
		
    }
	
	public function login()
	{
		$view = new View();
		return $view->fetch('admin/login');
	}
	
	public function doLogin()
	{
		$username	= input('username');
		$password	= input('password');
		//$code		= input('verify_code');
		
		$username 	= !empty($username) ? addslashes(trim($username)) : '';
		$password 	= !empty($password) ? addslashes(trim($password)) : '';
		//$code 		= !empty($code) ? addslashes(trim($code)) : '';
		/*
		if(!captcha_check($code) && self::$verify == 1)
		{
			header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('验证码错误！');window.location.href='login?".time()."';</script>");
		}
		*/
		
		$Admin = model('Admin');
		$admin_detail = $Admin->checkLogin($username, $password);
		
		//密码校验
		if (empty($admin_detail))
		{
			header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('用户名或密码错误！');window.location.href='login?".time()."';</script>");
		}
		//写session
		Session::set('admin_id',$admin_detail[0]['admin_id']);
		Session::set('admin_name',$username);
		
		$target_url = Config::get('host_url')."admin.php/admin/index/index";
		header("Location:".$target_url);
		exit();
	}
	
	public function register()
	{
		$username	= input('username');
		$password	= input('password');
		$mobile 	= input('mobile');

		$username 	= !empty($username) ? addslashes(trim($username)) : '';
		$password 	= !empty($password) ? addslashes(trim($password)) : '';
		$mobile  	= !empty($mobile) ? addslashes(trim($mobile)) : '';
		
		$Admin = model('Admin');
		$result 	= $Admin->addAdmin($username, $password, $mobile);
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
		$Admin = model('Admin');
		$list = $Admin->getAdminList();
		//print_r($list);die;
		$view = new View();
		$view->assign('list', $list);
		return $view->fetch('admin/admin-list');
	}
	
	public function addAdmin()
	{
		$view = new View();
		return $view->fetch('admin/admin-add');
	}
	
	public function adminStop()
	{
		$id	= input('id');
		$is_delete	= input('is_delete');
		
		$Admin = model('Admin');
		$result = $Admin->adminStop($id,$is_delete);
		
		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'fail')));
		}
	}
	
	public function adminDel()
	{
		$id	= input('id');
		
		$Admin = model('Admin');
		$result = $Admin->adminDel($id);
		
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
		
		$Admin = model('Admin');
		$result = $Admin->getadmin($id);
		
		$view = new View();
		$view->assign('list', $result);
		return $view->fetch('admin/admin-add');
	}
	
}
