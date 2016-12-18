<?php

namespace app\index\model;
use think\Model;
use think\Db;
class Category extends Model
{


	//筛选文章标签
	public function artlabel()
	{
		return Db::query('select * from tang_category as c,tang_smallsection as s where c.cid = s.category_cid');

	}


}	