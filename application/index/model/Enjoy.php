<?php

namespace app\index\model;
use think\Model;
use think\Db;


class Enjoy extends Model 
{
     // 添加文章
	public function add($data)
	{

		return Db::name('enjoy')->insert($data);
	}



	//选择收藏文章
	public function selectenjoy($uid)
	{
		return Db::query('select * from tang_enjoy as e,tang_test as t where e.enjoy_tid=t.tid and e.enjoy_uid = '.$uid);
	}


	//被收藏人信息
	public function selectuser($id)
	{
		return Db::query('select * from tang_user where uid='.$id);
	}
	
}


