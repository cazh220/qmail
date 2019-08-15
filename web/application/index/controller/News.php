<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class News extends Base
{
	public function index()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('公司动态');
		
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $list);
		$view->assign('system', Session::get('system_info'));
		$view->assign('qrcode', Session::get('qrcode'));
		return $view->fetch('index/company_news');
	}
	
	public function yingxiao()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('营销动态');
		
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $list);
		$view->assign('qrcode', Session::get('qrcode'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/news_yingxiao');
	}


}