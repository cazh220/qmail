<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class User extends Model
{
	
	public function addUser($name='', $mac='')
	{
		return Db::execute('insert into users (name,mac)values(?,?)',[$name,$mac]);
		
	}
	
	public function editUser($name='', $mac='', $id=0)
	{
		return Db::execute('update users set name = ?, mac = ? where id = ?',[$name,$mac,$id]);
		
	}
	
	public function getUserList($param = array())
	{
		$obj_data = $obj_data = Db::name('users');
		if (!empty($param['name']))
		{
			$obj_data = $obj_data->where('name', 'like', '%'.$param['name'].'%');
		}
		$obj_data = $obj_data->order('id desc')->paginate();
		return $obj_data->toArray();
	}
	
	public function userDel($id)
	{
		return Db::execute('delete from users where id = ?',[$id]);
	}
	
	public function getUser($id)
	{
		$res = Db::query("select *  from users where id = ?", [$id]);
		return $res ? $res : array();
	}
	
}