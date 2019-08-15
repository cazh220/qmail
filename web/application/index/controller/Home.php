<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;

class Home extends Base
{
	public function index()
	{
		//获取幻灯片
		$Home = model('Home');
		$pictures = $Home->getHuandengPian();

		$count = count($pictures);
		foreach($pictures as $key => $val)
		{
			if($key == $count-1)
			{
				$pictures[$key]['show'] = 1;
			}
			else
			{
				$pictures[$key]['show'] = 0;
			}
		}

		$product = $Home->getList();
		
		$view = new View();
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('qrcode', Session::get('qrcode'));
		$view->assign('huandengpian', $pictures);
		$view->assign('product', $product);
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/index');
	}

}