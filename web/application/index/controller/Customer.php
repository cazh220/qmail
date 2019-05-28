<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Customer extends Base
{
	public function index()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('高等教育');

		$view = new View();
		$view->assign('article', $list);
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

	public function detail()
	{
		$id = $_GET['id'];
		$category_name = $_GET['category_name'];
		$Article = model('Article');
		$detail = $Article->articleDetail($id);
		//print_r($detail);die;
		$list = array();
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $detail[0]);
		$view->assign('category_name', $category_name);
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/common_question_detail');
	}

}