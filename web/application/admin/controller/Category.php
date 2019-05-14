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
		$Category = model('Category');
		$list = $Category->categoryList();
		foreach($list as $k => $val)
		{
			$list[$k]['parent_name'] = $val['parent_id'] ? $Category->category_name($val['parent_id']) : '无';
		}
		
		$view = new View();
		$view->assign('category', $list);
		return $view->fetch('admin/system-category');
    }

    public function add_cat()
    {
		$Category = model('Category');
		$topcategory = $Category->topCategory();

    	$view = new View();
		$view->assign('top_category', $topcategory);
		return $view->fetch('admin/system-category-add');
    }
	
	public function add()
	{
		$category_name	= input('category_name');
		$parent_id		= input('category_id');

		$category_name 	= !empty($category_name) ? addslashes(trim($category_name)) : '';
		$parent_id 		= !empty($parent_id) ? intval($parent_id) : 0;

		$Category = model('Category');
		$result= $Category->addCategory($category_name, $parent_id);
		
		/*
		if($result)
		{
			$this->index();
		}
		else
		{
			exit("<script>alert('添加失败！');window.location.href='index?".time()."';</script>");
		}
		*/
	}

	
	public function categoryList()
	{
		
	}
	
}
