<?php
namespace app\index;

use think\Db;
use think\Session;
use think\Controller;
use think\Request;
use think\Cookie;
use think\Cache;
use think\Config;
use app\index\Mac;

class IpBase
{
	public function __construct()
	{
		$ip = $this->getIp();

		$mac = new Mac(); 
		$mymac = $mac->GetMacAddr(PHP_OS);
		
		$set = array();
		$data = Db::query("select mac from users");
		if($data)
		{
			foreach($data as $key => $val)
			{
				$set[] = $val['mac'];
			}
		}

		if(!in_array($mymac, $set))
		{
			echo "<script>window.location.href='/404.html'</script>";
		}
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