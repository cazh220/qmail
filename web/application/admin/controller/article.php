<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Article
{
    public function index()
    {
		$view = new View();
		//$view->assign('list', $list);
		return $view->fetch('admin/article-list');
	}
	
	public function test()
	{
		//echo 'test';
		phpinfo();
		
	}
}
