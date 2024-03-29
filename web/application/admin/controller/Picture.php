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
		$title = !empty($_GET['title']) ? trim($_GET['title']): '';
    	$Picture = model('Picture');
    	$list = $Picture->pictureList($title);
		if($list)
		{
			foreach($list as $key => $val)
			{
				$type_name = '';
				switch($val['type'])
				{
					case 99:
						$type_name = '幻灯片';break;
					case 98:
						$type_name = '顶部右侧公用图片';break;
					case 97:
						$type_name = '顶部左侧公用图片';break;
					case 96:
						$type_name = '联系二维码';break;
					default:
						$type_name = '默认';
				}
				$list[$key]['type_name'] = $type_name;
				$list[$key]['path']  = Config::get('host_url')."upload/".$val['path'];
			}
		}
		
		$view = new View();
		$view->assign('list', $list);
		$view->assign('title', $title);
		$view->assign('count', count($list));
		$view->assign('admin_name', Session::get('admin_name'));
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
		$type 			= !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;
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
					'url'			=> $url,
					'create_time'	=> date("Y-m-d H:i:s", time())
				);
			}
			$Picture = model('Picture');
			$result = $Picture->addPictures($data);
			if($result)
			{
				exit(json_encode(array('code'=>1, 'msg'=>'success')));
				//exit("<script>window.location.href='index';</script>");
			}
		}
		exit(json_encode(array('code'=>0, 'msg'=>'添加失败')));
		//exit("<script>alert('添加失败');</script>");
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
