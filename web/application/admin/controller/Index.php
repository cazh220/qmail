<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Index extends Controller
{
    public function index()
    {
		if(!Session::get('admin_id'))
		{
			header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('请登录');window.location.href='../admin/login/login?".time()."';</script>");
		}
		$System = model('System');
		$list = $System->getSystem();
		//print_r($list);die;
		
		$view = new View();
		$view->assign('admin_name', Session::get('admin_name'));
		$view->assign('system', !empty($list[0])?$list[0]:array());
		return $view->fetch('admin/index');
    }
	
	public function logout()
	{
		Session::clear();
		header("Content-type:text/html;charset=utf-8");
        exit("<script>window.location.href='../login/login?".time()."';</script>");
	}
	

	public function save()
	{
		$name = !empty($_GET['name']) ? trim($_GET['name']) : '';
		$tel = !empty($_GET['tel']) ? trim($_GET['tel']) : '';
		$mobile = !empty($_GET['mobile']) ? trim($_GET['mobile']) : '';
		$email = !empty($_GET['email']) ? trim($_GET['email']) : '';
		$address = !empty($_GET['address']) ? trim($_GET['address']) : '';
		$qq = !empty($_GET['qq']) ? trim($_GET['qq']) : '';
		$price = !empty($_GET['price']) ? intval($_GET['price']) : 0;


		$data = array(
			'name'		=> $name,
			'tel'		=> $tel,
			'mobile'	=> $mobile,
			'email'		=> $email,
			'address'	=> $address,
			'qq'		=> $qq,
			'price'		=> $price
			);

		$System = model('System');

		$result = $System->saveSystem($data);

		if($result)
		{
			exit(json_encode(array('code'=>1, 'msg'=>'success')));
		}
		else
		{
			exit(json_encode(array('code'=>0, 'msg'=>'保存失败')));
		}

	}
	
}
