<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Customer extends Controller
{
    public function index()
    {
		$keyword = !empty($_GET['keyword']) ? trim($_GET['keyword']) : '';
		
		$Customer = model('Customer');
		$list = $Customer->getCustomerList($keyword);
		
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		$view->assign('count', count($list));
		$view->assign('member', $list);
		$view->assign('keyword', $keyword);
		return $view->fetch('admin/customer_list');
    }
	
	public function list()
	{
		$keyword = !empty($_GET['keyword']) ? trim($_GET['keyword']) : '';
		
		$Customer = model('Customer');
		$list = $Customer->getCustomerList($keyword);
		
		$data = array('code'=>0, 'msg'=>'ok', 'count'=>count($list), 'data'=>$list);
		exit(json_encode($data));
	}
	
	public function addCustomer()
	{
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		
		return $view->fetch('admin/customer_add');
	}

	public function add()
	{
		$name = !empty($_POST['username']) ? trim($_POST['username']) : '';
		$weixin = !empty($_POST['weixin']) ? trim($_POST['weixin']) : '';
		$qq = !empty($_POST['qq']) ? trim($_POST['qq']) : '';
		$mobile = !empty($_POST['mobile']) ? trim($_POST['mobile']) : '';
		$email = !empty($_POST['email']) ? trim($_POST['email']) : '';
		$users_num = !empty($_POST['users_num']) ? intval($_POST['users_num']) : 0;
		$end_time = !empty($_POST['end_time']) ? trim($_POST['end_time']) : '';
		$uses_info = !empty($_POST['uses_info']) ? trim($_POST['uses_info']) : '';
		$track_info = !empty($_POST['track_info']) ? trim($_POST['track_info']) : '';
		$note = !empty($_POST['note']) ? trim($_POST['note']) : '';
		$tel = !empty($_POST['tel']) ? trim($_POST['tel']) : '';
		$contact_man = !empty($_POST['contact_man']) ? trim($_POST['contact_man']) : '';

		$data = array(
			'name'		=> $name,
			'weixin'	=> $weixin,
			'qq'		=> $qq,
			'mobile'	=> $mobile,
			'email'		=> $email,
			'users_num'	=> $users_num,
			'end_time'	=> $end_time,
			'uses_info'	=> $uses_info,
			'track_info'=> $track_info,
			'note'		=> $note,
			'contact_man'=>$contact_man,
			'tel'		=> $tel
			);
		//判断用户是否存在
		$Customer = model('Customer');
		if($Customer->getCustomerByName($name) || $Customer->getCustomerByMobile($mobile))
		{
			exit(json_encode(array('code'=>0,'msg'=>'用户名或手机号已存在')));
		}

		$result = $Customer->addCustomer($data);

		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
		}
		
	}
	
	//编辑
	public function editCustomer()
	{
		$id = !empty($_GET['id']) ? $_GET['id'] : 0;
		
		$Customer = model('Customer');
		$member = $Customer->getMem($id);
		//print_r($member);die;
		$view = new View();
		$view->assign('customer', !empty($member[0])?$member[0]:array());
		$view->assign('admin_name', Session::get('admin_name'));
		return $view->fetch('admin/customer_edit');
	}
	
	public function edit()
	{
		$name = !empty($_POST['username']) ? trim($_POST['username']) : '';
		$weixin = !empty($_POST['weixin']) ? trim($_POST['weixin']) : '';
		$qq = !empty($_POST['qq']) ? trim($_POST['qq']) : '';
		$mobile = !empty($_POST['mobile']) ? trim($_POST['mobile']) : '';
		$email = !empty($_POST['email']) ? trim($_POST['email']) : '';
		$users_num = !empty($_POST['users_num']) ? intval($_POST['users_num']) : 0;
		$end_time = !empty($_POST['end_time']) ? trim($_POST['end_time']) : '';
		$uses_info = !empty($_POST['uses_info']) ? trim($_POST['uses_info']) : '';
		$track_info = !empty($_POST['track_info']) ? trim($_POST['track_info']) : '';
		$note = !empty($_POST['note']) ? trim($_POST['note']) : '';
		$tel = !empty($_POST['tel']) ? trim($_POST['tel']) : '';
		$contact_man = !empty($_POST['contact_man']) ? trim($_POST['contact_man']) : '';
		$id = !empty($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;

		$data = array(
			'name'		=> $name,
			'weixin'	=> $weixin,
			'qq'		=> $qq,
			'mobile'	=> $mobile,
			'email'		=> $email,
			'users_num'	=> $users_num,
			'end_time'	=> $end_time,
			'uses_info'	=> $uses_info,
			'track_info'=> $track_info,
			'note'		=> $note,
			'contact_man'=>$contact_man,
			'tel'		=> $tel
			);
		
		$Customer = model('Customer');
		$result = $Customer->updateMem($data, $id);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'编辑失败')));
		}	
		
	}
	
	public function detail()
	{
		$id = !empty($_GET['id']) ? $_GET['id'] : 0;
		
		$Customer = model('Customer');
		$member = $Customer->getMem($id);
		//print_r($member);die;
		$view = new View();
		$view->assign('customer', !empty($member[0])?$member[0]:array());
		$view->assign('admin_name', Session::get('admin_name'));
		return $view->fetch('admin/customer_detail');
	}
	
	public function deleteCustomer()
	{
		$id = !empty($_GET['id']) ? $_GET['id'] : 0;
		
		$Customer = model('Customer');
		$result = $Customer->delMem($id);
		
		if($result)
		{
			exit(json_encode(array('code'=>1,'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0,'msg'=>'删除失败')));
		}
	}

	
	
}
