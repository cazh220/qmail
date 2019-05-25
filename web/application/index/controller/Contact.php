<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Contact extends Base
{
	public function index()
	{
		$view = new View();
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/contact');
	}


}