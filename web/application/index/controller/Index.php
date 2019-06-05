<?php
namespace app\admin\controller;

class Login
{
    public function index()
    {
		if(empty(Session::get('admin_id')))
    	{
    		//跳转到登录页面
    		header("Content-type:text/html;charset=utf-8");
            echo "<script>window.location.href='index/login';</script>";
    	}
    	else
    	{
    		//print_r(Config::get('host'));die;
	        $view = new View();
			$view->assign('top_left_picture', Session::get('top_left_picture'));
			$view->assign('qrcode', Session::get('top_left_picture'));
			$view->assign('menu', Session::get('menu'));
			$view->assign('username', Session::get('username'));
			return $view->fetch('index');
    	}
    }
	
	public function test()
	{
		//echo 'test';
		phpinfo();
	}
	
	public function login()
	{
		
	}
}
