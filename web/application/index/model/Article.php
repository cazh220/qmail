<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Paginator;

class Article extends Model
{	
	
	public function getArticleList($category_name='')
	{
		$res = Db::query("select *,a.id as article_id from article a left join article_category b on a.category_id = b.id where a.status = ? and b.category_name = ?", [1, $category_name]);
		return $res ? $res : array();
	}
	
	public function articleDetail($id)
	{
		$res = DB::query("select * from article where id = ?", [$id]);
		return $res ? $res : array();
	}
	
}