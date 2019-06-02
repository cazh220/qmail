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















	public function addArticle($content='', $category_id=0, $title='')
	{
		return Db::execute('insert into article (title,category_id, content, status, update_time)values(?,?,?,?,?)',[$title,$category_id,$content,1, date("Y-m-d H:i:s")]);
	}

	public function editArticle($content='', $category_id=0, $title='', $id = 0)
	{
		return Db::execute('update article set title = ?,category_id = ?, content = ?, update_time = ? where id = ?',[$title,$category_id,$content, date("Y-m-d H:i:s"), $id]);
	}

	public function articleList($id=0)
	{
		if($id)
		{
			$res = Db::query("select a.id,a.title,a.category_id,a.content,a.update_time,b.category_name from article a left join article_category b on a.category_id = b.id where a.id = ?", [$id]);
		}
		else
		{
			$res = Db::query("select a.id,a.title,a.category_id,a.content,a.update_time,b.category_name from article a left join article_category b on a.category_id = b.id");
		}

		return $res;
	}
	
	public function deleteArticle($id)
	{
		return Db::execute('delete from article where id = ?',[$id]);
	}


	public function addCategory($category_name='', $parent_id='')
	{
		return Db::execute('insert into article_category (category_name,parent_id)values(?,?)',[$category_name,$parent_id]);
	}
	
	public function topCategory()
	{
		$res = Db::query("select *  from article_category where parent_id = ?", [0]);
		return $res ? $res : array();
	}
	
	
	
	public function category_name($category_id)
	{
		$res = Db::query("select *  from article_category where id = ?", [$category_id]);
		return $res[0]['category_name'] ? $res[0]['category_name'] : array();
	}
	
	public function delCategory($category_id)
	{
		return Db::execute('delete from article_category where id = ? or parent_id = ?',[$category_id,$category_id]);
	}
	
	public function editCategory($id, $name, $parent_id=0)
	{
		return Db::execute('update article_category SET category_name = ?, parent_id = ?  where id = ? ',[$name,$parent_id,$id]);
	}
	
	public function getCategory($id)
	{
		$res = Db::query("select *  from article_category where id = ?", [$id]);
		return $res[0] ? $res[0] : array();
	}
	

}