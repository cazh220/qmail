<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class System extends Model
{
	public function saveSystem($data)
	{
		$info = $this->getSystem();
		if(!empty($info[0]['id']))
		{
			return Db::execute('update system SET company = ?, tel = ?, mobile = ?, email = ?, address = ?, qq = ?, price = ?  where id = ?',[$data['name'],$data['tel'],$data['mobile'], $data['email'], $data['address'], $data['qq'], $data['price'], $info[0]['id']]);
		}
		else
		{
			return Db::execute('insert into system SET company = ?, tel = ?, mobile = ?, email = ?, address = ?, qq = ?, price = ?',[$data['name'],$data['tel'],$data['mobile'], $data['email'], $data['address'], $data['qq'], $data['price']]);
		}
		
	}
	
	public function getSystem()
	{
		$res = Db::query("select * from system limit 1");
		return $res ? $res : array();
	}
}