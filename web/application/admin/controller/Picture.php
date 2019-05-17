<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Picture
{
    public function index()
    {
    	$Picture = model('Picture');
    	$list = $Picture->pictureList();

		$view = new View();
		$view->assign('list', $list);
		return $view->fetch('admin/picture-list');
	}
	
	public function addPicture()
	{
    	$view = new View();
		return $view->fetch('admin/picture-add');
		
	}

	public function add()
	{
		print_r($_REQUEST);die;

		$category_id 	= !empty($_REQUEST['category_id']) ? intval($_REQUEST['category_id']) : 0;
		$title 			= !empty($_REQUEST['title']) ? trim($_REQUEST['title']) : '';
		$content 		= !empty($_REQUEST['editorValue']) ? $_REQUEST['editorValue'] : '';

		$Picture = model('Picture');
		$result = $Picture->addArticle($content, $category_id, $title);

		if($result)
		{
			exit("<script>window.location.href='index';</script>");
		}
		else
		{
			exit("<script>alert('添加失败');</script>");
		}
	}

	/*
	public function editArticle()
	{
		$id 			= !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

		$Picture = model('Picture');
    	$list = $Picture->articleList($id);

    	$category = $Article->categoryList();
		$category_tree = $this->get_tree($category, 0);

    	$view = new View();
		$view->assign('category', $category_tree);
		$view->assign('article', $list[0]);
		return $view->fetch('admin/article-edit');		
	}

	public function edit()
	{
		$category_id 	= !empty($_REQUEST['category_id']) ? intval($_REQUEST['category_id']) : 0;
		$title 			= !empty($_REQUEST['title']) ? trim($_REQUEST['title']) : '';
		$content 		= !empty($_REQUEST['editorValue']) ? $_REQUEST['editorValue'] : '';

		$id 	= !empty($_REQUEST['article_id']) ? intval($_REQUEST['article_id']) : 0;
		$Article = model('Article');
		$result = $Article->editArticle($content, $category_id, $title, $id);

		if($result)
		{
			exit("<script>window.location.href='index';</script>");
		}
		else
		{
			exit("<script>alert('编辑失败');</script>");
		}
	}
	
	public function delete()
	{
		$id 	= $_GET['id'];
		$Article = model('Article');
		$result = $Article->deleteArticle($id);
		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'删除失败')));
		}
	}


	public function get_tree($data, $pid)
	{
	    $tree = array();
	    foreach($data as $k => $v)
	    {
	      if($v['parent_id'] == $pid)
	      {        
	       //父亲找到儿子
	       $v['children'] = $this->get_tree($data, $v['id']);
	       $tree[] = $v;
	      }
	    }
	    return $tree;
	}
	*/
}
