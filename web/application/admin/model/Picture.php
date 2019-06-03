<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Picture extends Model
{
	public function pictureList($title='')
	{
		$res = Db::query("select *  from pictures where is_delete = ? and title LIKE '%".$title."%'", [0]);
		return $res ? $res : array();
	}
	
	public function picture($id)
	{
		$res = Db::query("select * from pictures where id = ?", [$id]);
		return $res ? $res : array();
	}
	
	public function addPictures($pictures=array())
	{
		return Db::name('pictures')->insertAll($pictures);
	}
	
	public function deletePicture($id = 0)
	{
		return Db::execute('delete from pictures where id = ?',[$id]);
	}
	

}