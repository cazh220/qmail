<?php
namespace app\index;

use think\Db;
use think\Session;
use think\Controller;
use think\Request;
use think\Cookie;
use think\Cache;
use think\Config;

class Base
{
	public function __construct()
	{
		$data = Db::query("select * from system where id = 1");
		Session::set('system_info',$data[0]);
	}

}