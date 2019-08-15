<?php
namespace app\index\controller;

use think\View;
use think\Session;
use app\index\Base;
use app\index\Mac;

class Contact extends Base
{
	public function index()
	{
		$Article = model('Article');
		$list = $Article->getArticleList('联系我们');

		$ip = $this->getIp();
		//$mac = new Mac(); 
		//$mymac = $mac->GetMacAddr(PHP_OS);

		$set = array();
		$Customer = model('Customer');
		$data = $Customer->userslist();
		if($data)
		{
			foreach($data as $key => $val)
			{
				$set[] = $val['ip'];
			}
		}

		$show = 0;
		if(in_array($ip, $set))
		{
			$show = 1;
		}
		
		$view = new View();
		$view->assign('show', $show);
		$view->assign('article', !empty($list[0]) ? $list[0] : array());
		$view->assign('qrcode', Session::get('qrcode'));
		$view->assign('top_left_picture', Session::get('top_left_picture'));
		$view->assign('system', Session::get('system_info'));
		return $view->fetch('index/contact');
	}

	public function getIp()
	{
		static $realip;
	    if(isset($_SERVER)){
	        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
	            $realip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	        }
	        else if(isset($_SERVER['HTTP_CLIENT_IP'])){
	            $realip=$_SERVER['HTTP_CLIENT_IP'];
	        }
	        else{
	            $realip=$_SERVER['REMOTE_ADDR'];
	        }
	    }
	    else{
	        if(getenv('HTTP_X_FORWARDED_FOR')){
	            $realip=getenv('HTTP_X_FORWARDED_FOR');
	        }
	        else if(getenv('HTTP_CLIENT_IP')){
	            $realip=getenv('HTTP_CLIENT_IP');
	        }
	        else{
	            $realip=getenv('REMOTE_ADDR');
	        }
	    }
	    return $realip;
	}


}