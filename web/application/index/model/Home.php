<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Paginator;

class Home extends Model
{	
	public function getHuandengPian($param = array())
	{
		$res = Db::query("select *  from pictures where type = 99");
		return $res ? $res : array();
	}
	
	public function getList()
	{
		$res = Db::query("select *  from product where is_delete = ?", [0]);
		return $res ? $res : array();
	}
	
}