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
		$view->assign('category', '高等教育');
		$view->assign('article', $list);
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function baoxian()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('金融保险');

		$view = new View();
		$view->assign('article', $list);
		$view->assign('category', '金融保险');
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function gov()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('政府组织');

		$view = new View();
		$view->assign('article', $list);
		$view->assign('category', '政府组织');
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function life()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('生活服务');

		$view = new View();
		$view->assign('article', $list);
		$view->assign('category', '生活服务');
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function internet()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('互联网');

		$view = new View();
		$view->assign('article', $list);
		$view->assign('category', '互联网');
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function create()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('生产制造');

		$view = new View();
		$view->assign('article', $list);
		$view->assign('category', '生产制造');
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer');
	}

	public function detail()
	{
		$id = $_GET['id'];
		$category_name = $_GET['category'];
		$Article = model('Article');
		$detail = $Article->articleDetail($id);
		//print_r($detail);die;
		$list = array();
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $detail[0]);
		$view->assign('category', $category_name);
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/customer_detail');
	}

}