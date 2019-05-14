<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Category extends Controller
{
    public function index()
    {
		$view = new View();
		return $view->fetch('admin/system-category');
    }

    public function add()
    {
    	$view = new View();
		return $view->fetch('admin/system-category-add');
    }
	
	public function addCategory()
	{
		$category_name	= input('category_name');
		$parent_id		= input('category_id');

		$category_name 	= !empty($category_name) ? addslashes(trim($category_name)) : '';
		$parent_id 		= !empty($parent_id) ? intval($parent_id) : 0;

		$Category = model('Category');
		$result= $Category->addCategory($category_name, $parent_id);
echo 12;die;
		if($result)
		{
			$this->index();
		}
		else
		{
			exit("<script>alert('添加失败！');window.location.href='index?".time()."';</script>");
		}

	}
	
}
