<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Article extends Controller
{
    public function index()
    {
		$title = !empty($_GET['title']) ? trim($_GET['title']) : '';
		$category_id = !empty($_GET['category']) ? trim($_GET['category']) : '';
		
		$Article = model('Article');
		$category = $Article->categoryList();
		$category_tree = $this->get_tree($category, 0);
		//print_r($category_tree);die;
    	$Article = model('Article');
    	$list = $Article->articleList(0,$category_id,$title);

		$view = new View();
		$view->assign('category_tree', $category_tree);
		$view->assign('list', $list);
		$view->assign('title', $title);
		$view->assign('admin_name', Session::get('admin_name'));
		$view->assign('category_id', $category_id);
		$view->assign('count', count($list));
		return $view->fetch('admin/article-list');
	}
	
	public function addArticle()
	{
		$Article = model('Article');
		$category = $Article->categoryList();
		$category_tree = $this->get_tree($category, 0);
		//print_r($category_tree);die;
    	$view = new View();
		$view->assign('category', $category_tree);
		return $view->fetch('admin/article-add');
		
	}

	public function add()
	{
		$category_id 	= !empty($_REQUEST['category_id']) ? intval($_REQUEST['category_id']) : 0;
		$title 			= !empty($_REQUEST['title']) ? trim($_REQUEST['title']) : '';
		$brief 			= !empty($_REQUEST['brief']) ? trim($_REQUEST['brief']) : '';
		$content 		= !empty($_REQUEST['editorValue']) ? $_REQUEST['editorValue'] : '';
		$thumb_pic		= !empty($_REQUEST['thumb_pic']) ? $_REQUEST['thumb_pic'] : '';
		//print_r($content);
		//把content >替换
		//$content = str_replace('+', '&', $content);
		$content = urldecode($content);
		//print_r($content);die;
		$Article = model('Article');
		$result = $Article->addArticle($content, $category_id, $title, $brief, $thumb_pic);

		if($result)
		{
			//exit("<script>window.location.href='index';</script>");
			exit(json_encode(array('code'=>1, 'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'添加失败')));
			//exit("<script>alert('添加失败');</script>");
		}
	}

	public function editArticle()
	{
		$id 			= !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

		$Article = model('Article');
    	$list = $Article->articleList($id);

    	$category = $Article->categoryList();
		$category_tree = $this->get_tree($category, 0);
		//print_r($category_tree);die;
    	$view = new View();
		$view->assign('category', $category_tree);
		$view->assign('article', $list[0]);
		return $view->fetch('admin/article-edit');		
	}

	public function edit()
	{
		//print_r($_REQUEST);die;
		$category_id 	= !empty($_REQUEST['category_id']) ? intval($_REQUEST['category_id']) : 0;
		$title 			= !empty($_REQUEST['title']) ? trim($_REQUEST['title']) : '';
		$content 		= !empty($_REQUEST['editorValue']) ? $_REQUEST['editorValue'] : '';
		$brief 			= !empty($_REQUEST['brief']) ? trim($_REQUEST['brief']) : '';
		$thumb_pic 		= !empty($_REQUEST['thumb_pic']) ? trim($_REQUEST['thumb_pic']) : '';
		//print_r(urldecode($content));die;
		$content = urldecode($content);
		
		$id 	= !empty($_REQUEST['article_id']) ? intval($_REQUEST['article_id']) : 0;
		$Article = model('Article');
		$result = $Article->editArticle($content, $category_id, $title, $brief, $thumb_pic, $id);

		if($result)
		{
			//exit("<script>window.location.href='index';</script>");
			exit(json_encode(array('code'=>1, 'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'编辑失败')));
			//exit("<script>alert('编辑失败');</script>");
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
}
