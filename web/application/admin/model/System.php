<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class System extends Model
{
	public function save($data)
	{
		return Db::execute('update system SET company = ?, tel = ?, mobile = ?, email = ?, address = ?, qq = ?, price = ?  where id = 1 ',[$data['name'],$data['tel'],$data['mobile'], $data['email'], $data['address'], $data['qq'], $data['price']);
	}
}