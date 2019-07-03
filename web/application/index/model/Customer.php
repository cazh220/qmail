<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Paginator;

class Customer extends Model
{	
	
	public function getCustomerByName($name='')
	{
		$res = Db::query("select *  from customer where is_delete = 0 and name = ?", [$name]);
		return $res ? $res : array();
	}

	public function getCustomerByMobile($mobile = '')
	{
		$res = Db::query("select *  from customer where is_delete = 0 and mobile = ?", [$mobile]);
		return $res ? $res : array();
	}
	
}