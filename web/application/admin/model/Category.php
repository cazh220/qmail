<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Category extends Model
{

	public function addCategory($category_name='', $parent_id='')
	{
		return Db::execute('insert into article_category (category_name,parent_id)values(?,?)',[$category_name,$parent_id]);
	}
	
	public function topCategory()
	{
		$res = Db::query("select *  from article_category where parent_id = ?", [0]);
		return $res ? $res : array();
	}
	
	public function categoryList()
	{
		$res = Db::query("select *  from article_category where is_delete = ?", [0]);
		return $res ? $res : array();
	}
	
	public function category_name($category_id)
	{
		$res = Db::query("select *  from article_category where id = ?", [$category_id]);
		return $res[0]['category_name'] ? $res[0]['category_name'] : array();
	}

}