<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Admin extends Model
{
	public function checkLogin($username='', $password='')
	{
		$res = Db::query("select *  from admins where admin_name = ? AND password = ?", [$username, md5($password)]);
		return $res ? $res : array();
	}
	
	public function addAdmin($admin_name='', $password='', $mobile='')
	{
		return Db::execute('insert into admins (admin_name,password,mobile)values(?,?,?)',[$admin_name,md5($password),$mobile]);
		
	}
	
	
	public function getAdminList($param = array())
	{
		$obj_data = $obj_data = Db::name('admins');
		if (!empty($param['username']))
		{
			$obj_data = $obj_data->where('username', 'like', '%'.$param['username'].'%');
		}
		$obj_data = $obj_data->order('admin_id asc')->paginate();
		return $obj_data->toArray();
	}
	 
	public function adminStop($id, $status=0)
	{
		return Db::execute('update admins SET is_delete = ? where admin_id = ?',[$status,$id]);
	}
	
	public function adminDel($id)
	{
		return Db::execute('delete from admins where admin_id = ?',[$id]);
	}
	
	public function getAdmin($id)
	{
		$res = Db::query("select *  from admins where admin_id = ?", [$id]);
		return $res ? $res : array();
	}
	
}