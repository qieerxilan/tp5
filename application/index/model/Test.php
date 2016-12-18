<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Test extends Model
{

	//发表文章
	public function articeladd($data)
	{
		return Db::name('test')->insert($data);
	}
	//筛选用户状态
	public function selectart()
	{
		return Db::query('select * from tang_user as u,tang_test as t where u.uid = t.user_uid order by t.tid desc');

		
	}

	//获取最大id
	public function maxid()
	{
		return Db::query('select * from tang_test where tid>0 order by tid desc limit 0,1');
	}
	//删除状态
	public function delet($tid)
	{
		return Db::name('test')->where('tid',$tid)->delete();
	}

	//举报
	public function report($tid)
	{
		return Db::name('test')->where('tid', $tid)->setInc('test_rep');
	} 
	
	//筛选标签
	public function section()
	{
		return Db::field('test_label')
				->name('test')
				->limit(10)->select();
	}

	// public  function  lifes()
	// {

	// 	   return Db:
	// }


}