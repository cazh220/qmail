<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Contact extends Base
{
	public function index()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('联系我们');
		
		$view = new View();
		$view->assign('article', $list[0]);
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/contact');
	}


}