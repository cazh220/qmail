<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Product extends Controller
{
    public function index()
    {
		$Product = model('Product');
		$list = $Product->getList();
		
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		$view->assign('list', $list);
		return $view->fetch('admin/product_list');
    }

    public function add_product()
    {
    	$view = new View();
		return $view->fetch('admin/product_add');
    }
	
	public function add()
	{
		$title			= input('title');
		$price			= input('price');
		$content		= input('content');

		$title 			= !empty($title) ? addslashes(trim($title)) : '';
		$price 			= !empty($price) ? trim($price) : '';
		$content 		= !empty($content) ? trim($content) : '';

		$Product = model('Product');
		$result= $Product->addProduct($title, $content, $price);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
		}
	}

	
	public function productEdit()
	{
		$id = input('id');

		$Product = model('Product');
		$list = $Product->getProduct($id );
	
		$view = new View();
		$view->assign('data', $list[0]);
		return $view->fetch('admin/product_edit');
	}
	
	public function edit()
	{
		$title			= input('title');
		$content		= input('content');
		$price			= input('price');
		$id 			= input('id');

		$title 			= !empty($title) ? addslashes(trim($title)) : '';
		$content 		= !empty($content) ? trim($content) : '';
		$price 			= !empty($price) ? trim($price) : '';
		$id 			= !empty($id) ? intval($id) : 0;

		$Product = model('Product');
		$result= $Product->editProduct($id, $title, $content, $price);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'编辑失败')));
		}
	}
	
}
