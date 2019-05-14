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
		$obj_data = $obj_data = Db::name('hg_admin_users');
		if (!empty($param['username']))
		{
			$obj_data = $obj_data->where('username', 'like', '%'.$param['username'].'%');
		}
		$obj_data = $obj_data->order('admin_id asc')->paginate();
		
		return $obj_data;
	}
	
	
	public function getAdmin($condition=array(), $order=0, $page=array())
	{
		$where_ary = array();
		//拼接参数
		foreach($condition as $key => $val)
		{
			array_push($where_ary, $key."= :".$key);
		}
		$where_condition = implode(' AND ', $where_ary);
		$order = " ORDER BY admin_id DESC";
		if ($order=='1')
		{
			$order = " ORDER BY admin_id ASC";
		}
		$where_condition .= $order;
		
		if (!empty($page))
		{
			$start = $page['current_page'] - 1;
			$page_size = $page['page_size'];
			$start = ($start > 0) ? intval($start) : 0;
			$limit = " LIMIT $start, $page_size";
			$where_condition .= $limit;
		}
	
		$res = Db::query("select *  from hg_admin_users where $where_condition", $condition);
		return $res;
	}
	
	public function updateAdmin($param=array(), $where=array())
	{
		if (!empty($param) && !empty($where))
		{
			$set = $this->join2param($param, ',');
			$where_condition = $this->join2param($where, 'AND');
			$params = array_merge($param, $where);
			//echo "update hg_admin_users set $set where $where_condition";print_r($params);die;
			$res = Db::execute("update hg_admin_users set $set where $where_condition", $params);
		}
		
		return $res==1 ? 1 : 0;
	}
	

}