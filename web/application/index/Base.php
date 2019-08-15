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
		Session::set('system_info',!empty($data[0])?$data[0]:array());
		
		//顶部左侧图片
		$pic = Db::query("select * from pictures where type = 97 limit 1");
		Session::set('top_left_picture',!empty($pic[0])?$pic[0]:array());

		//二维码
		$qrc = Db::query("select * from pictures where type = 96 limit 1");
		Session::set('qrcode',!empty($qrc[0])?$qrc[0]:array());
	}

}