<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class About extends Base
{
	public function index()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('关于我们');

		$view = new View();
		$view->assign('article', !empty($list[0]) ? $list[0] : array());
		$view->assign('system', Session::get('system_info'));
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		return $view->fetch('index/about');
	}


}