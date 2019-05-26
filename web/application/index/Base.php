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
		$data = Db::query("select * from system limit 1");
		Session::set('system_info',$data[0]);
		
		//顶部左侧图片
		$pic = Db::query("select * from pictures where type = 97 limit 1");
		Session::set('top_left_picture',$pic[0]);
	}

}