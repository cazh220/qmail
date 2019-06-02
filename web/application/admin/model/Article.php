<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use think\Paginator;

class Article extends Model
{

	public function categoryList()
	{
		$res = Db::query("select *  from article_category where is_delete = ?", [0]);
		return $res ? $res : array();
	}

	public function addArticle($content='', $category_id=0, $title='', $brief='', $thumb_pic = '')
	{
		return Db::execute('insert into article (title,category_id, content, status, brief, update_time, thumb_pic)values(?,?,?,?,?,?,?)',[$title,$category_id,$content,1, $brief, date("Y-m-d H:i:s"), $thumb_pic]);
	}

	public function editArticle($content='', $category_id=0, $title='', $brief='', $thumb_pic='', $id = 0)
	{
		return Db::execute('update article set title = ?,category_id = ?, content = ?, update_time = ?, brief = ?, thumb_pic = ? where id = ?',[$title,$category_id,$content, date("Y-m-d H:i:s"), $brief, $thumb_pic, $id]);
	}

	public function articleList($id=0, $category=0, $title='')
	{
		if($id)
		{
			$res = Db::query("select a.id,a.title, a.brief, a.category_id,a.content,a.update_time,b.category_name,a.thumb_pic from article a left join article_category b on a.category_id = b.id where a.id = ?", [$id]);
		}
		else
		{
			$sql = "select a.id,a.brief,a.title,a.category_id,a.content,a.update_time,b.category_name,a.thumb_pic from article a left join article_category b on a.category_id = b.id where 1";
			if($category)
			{
				$sql .= " and a.category_id = ".$category;
			}
			if($title)
			{
				$sql .= " and a.title like '%".$title."%'";
			}
			//echo $sql;die;
			$res = Db::query($sql);
			
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