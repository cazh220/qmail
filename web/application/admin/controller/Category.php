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
		$view->assign('admin_name', Session::get('admin_name'));
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
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
		}
	}

	public function categoryDelete()
	{
		$id	= input('id');

		$Category = model('Category');
		$result= $Category->delCategory($id);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'删除失败')));
		}
	}
	
	public function categoryEdit()
	{
		$id 			= input('id');
		$Category = model('Category');
		$data = $Category->getCategory($id);
		$list = $Category->categoryList();
		$topcategory = $Category->topCategory();
		foreach($list as $k => $val)
		{
			$list[$k]['parent_name'] = $val['parent_id'] ? $Category->category_name($val['parent_id']) : '无';
		}
		
		$view = new View();
		$view->assign('category', $list);
		$view->assign('data', $data);
		$view->assign('top_category', $topcategory);
		return $view->fetch('admin/system-category-edit');
	}
	
	public function edit()
	{
		$category_name	= input('category_name');
		$parent_id		= input('category_id');
		$id 			= input('edit_category_id');

		$category_name 	= !empty($category_name) ? addslashes(trim($category_name)) : '';
		$parent_id 		= !empty($parent_id) ? intval($parent_id) : 0;
		$id 			= !empty($id) ? intval($id) : 0;

		$Category = model('Category');
		$result= $Category->editCategory($id, $category_name, $parent_id);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
		}
	}
	
}
