<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Index extends Controller
{
    public function index()
    {
		if(!Session::get('admin_id'))
		{
			header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('请登录');window.location.href='../login/login?".time()."';</script>");
		}
		$Admin = model('Admin');
		
		
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		//$view->assign('admin', $admin);
		return $view->fetch('admin/index');
    }
	
	public function logout()
	{
		Session::clear();
		header("Content-type:text/html;charset=utf-8");
        exit("<script>window.location.href='../login/login?".time()."';</script>");
	}
	
	
}
