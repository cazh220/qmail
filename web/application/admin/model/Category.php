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

	

}