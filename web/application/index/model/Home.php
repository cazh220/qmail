<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Paginator;

class Home extends Model
{	
	public function getHuandengPian($param = array())
	{
		$res = Db::query("select *  from admins where admin_id = ?", [$id]);
		return $res ? $res : array();
	}
	
}