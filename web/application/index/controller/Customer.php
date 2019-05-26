<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Customer extends Base
{
	public function index()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function baoxian()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_baoxian');
	}

	public function gov()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_gov');
	}

	public function life()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_life');
	}

	public function internet()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_internet');
	}

	public function create()
	{
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_create');
	}

}