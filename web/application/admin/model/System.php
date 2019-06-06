<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class System extends Model
{
	public function saveSystem($data)
	{
		//print_r($data);die;
		return Db::execute('replace system SET company = ?, tel = ?, mobile = ?, email = ?, address = ?, qq = ?, price = ?  where id = 1 ',[$data['name'],$data['tel'],$data['mobile'], $data['email'], $data['address'], $data['qq'], $data['price']]);
	}
	
	public function getSystem()
	{
		$res = Db::query("select * from system where id = 1");
		return $res ? $res : array();
	}
}