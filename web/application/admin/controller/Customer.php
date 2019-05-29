<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Customer extends Controller
{
    public function index()
    {
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		
		//$view->assign('admin', $admin);
		return $view->fetch('admin/customer');
    }

	
	
}
