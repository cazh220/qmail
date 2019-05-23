<?php
namespace app\index\controller;

use think\View;
use app\model\Product;
class Home
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
		$Product = model('Product');
		$product = $Product->getList();
		print_r($product);die;
		$view = new View();
		$view->assign('huandengpian', $pictures);
		$view->assign('product', $product);
		return $view->fetch('index/index');
	}
}