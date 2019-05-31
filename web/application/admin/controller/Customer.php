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
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		
		//$view->assign('admin', $admin);
		return $view->fetch('admin/customer_list');
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
			'note'		=> $note
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

	
	
}
