<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Product extends Base
{
	public function index()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/product_better');
	}


	public function detail()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/product_detail');
	}

	public function solution()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/product_solution');
	}


}