<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Test extends Model
{
	//查询被举报状态
	public function select()
	{

		return Db::name('test','user')->where('test_rep','>=','1')->select();

	}
	//违规帖删除
	public function dele($tid)
	{
		return Db::name('test')->where('tid',$tid)->delete();
	}

	//帖子筛选
	public function selecttest()
	{
		return Db::name('test')->select();
	}

	public function delet($tid)
	{
		return Db::name('test')->where('tid',$tid)->delete();
	}


}
