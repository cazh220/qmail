<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Product extends Model
{
	public function getList()
	{
		$res = Db::query("select *  from product where is_delete = ?", [0]);
		return $res ? $res : array();
	}

	public function addProduct($title, $content, $price)
	{
		return Db::execute('insert into product (title,price,content)values(?,?,?)',[$title,$price,$content]);
	}

	public function editProduct($id, $title, $content, $price)
	{
		return Db::execute('update product SET title = ?, content = ?, price = ?  where id = ? ',[$title,$content,$price,$id]);
	}

	public function getProduct($id)
	{
		$res = Db::query("select *  from product where is_delete = ? and id = ?", [0, $id]);
		return $res ? $res : array();
	}

	public function delProduct($id)
	{
		return Db::execute('delete from product where id = ?',[$id]);
	}

}