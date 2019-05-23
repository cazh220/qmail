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
		if($list)
		{
			foreach($list as $key => $val)
			{
				$list[$key]['type_name'] = ($val['type'] == 99) ? '幻灯片' : '默认';
				$list[$key]['path']  = "http://qmail.com/upload/".$val['path'];
			}
		}
		
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
		$pictures 		= !empty($_REQUEST['pictures']) ? trim($_REQUEST['pictures']) : '';
		$title 			= !empty($_REQUEST['title']) ? trim($_REQUEST['title']) : '';
		$type 			= !empty($_REQUEST['type']) ? $_REQUEST['type'] : '';
		$url 			= !empty($_REQUEST['url']) ? trim($_REQUEST['url']) : '';
		if($pictures)
		{
			$temp = explode(",", $pictures);
			foreach($temp as $key => $val)
			{
				$data[$key] = array(
					'title'			=> $key > 0 ? $title.$key : $title,
					'type'			=> $type,
					'path'			=> $val,
					'url'			=> $url
				);
			}
			$Picture = model('Picture');
			$result = $Picture->addPictures($data);
			if($result)
			{
				exit("<script>window.location.href='index';</script>");
			}
		}
		exit("<script>alert('添加失败');</script>");
	}
	
	public function delete()
	{
		$id 	= $_GET['id'];
		$Picture = model('Picture');
		$result = $Picture->deletePicture($id);
		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'ok')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'删除失败')));
		}
	}
	

}
