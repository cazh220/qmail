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
			echo 3;die;
    		//print_r(Config::get('host'));die;
	        $view = new View();
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
