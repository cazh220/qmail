<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Customer extends Model
{
	public function getCustomerList($keyword='')
	{
		if($keyword)
		{
			$sql = "select * from customer where is_delete = 0 and name like '%".$keyword."%' or mobile like '%".$keyword."%' or email like '%".$keyword."%'";
		}
		else
		{
			$sql = "select *  from customer where is_delete = 0";
		}
		//echo $sql;die;
		
		$res = Db::query($sql);
		return $res ? $res : array();
	}

	public function addCustomer($data = array())
	{
		return  Db::execute('insert into customer(name,weixin,mobile,qq,email,end_time,users_num,uses_info,track_info,note,create_time,tel,contact_man)values(?,?,?,?,?,?,?,?,?,?,?,?,?)',[$data['name'],$data['weixin'],$data['mobile'],$data['qq'], $data['email'], $data['end_time'], $data['users_num'], $data['uses_info'], $data['track_info'], $data['note'], date("Y-m-d H:i:s"),$data['tel'],$data['contact_man']]);
	}

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
	
	public function getMem($id=0)
	{
		$res = Db::query("select *  from customer where is_delete = 0 and id = ?", [$id]);
		return $res ? $res : array();
	}
	
	public function updateMem($data=array(), $id=0)
	{
		$sql = "update customer set ";
		foreach($data as $key => $val)
		{
			$sql .= $key." = '".$val."',";
		}
		$sql = rtrim($sql, ',');
		$sql .= " where id = ".$id;
		return  Db::execute($sql);
	}
	
	public function delMem($id=0)
	{
		$sql = "update customer set is_delete = 1 where id in (".$id.")";
		//echo $sql;die;
		
		return  Db::execute($sql);
	}

}