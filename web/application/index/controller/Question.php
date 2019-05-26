<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Question extends Base
{
	public function index()
	{
		//获取文章
		$Article = model('Article');
		$list = $Article->getArticleList('常见问题');
		//print_r($list);die;
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $list);
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/common_question');
	}
	
	public function detail()
	{
		$id = $_GET['id'];
		$Article = model('Article');
		$detail = $Article->articleDetail($id);
		//print_r($detail);die;
		$list = array();
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('article', $detail[0]);
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/common_question_detail');
	}


}