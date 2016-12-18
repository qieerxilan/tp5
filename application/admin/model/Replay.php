<?php
namespace app\admin\model;

use think\Model;
use think\Db;


class Replay extends Model
{

	public function select()
	{
		return Db::query('select * from tang_user as u,tang_replay as r,tang_test as t where u.uid = r.user_uid and r.text_tid = t.tid');

	}

	//评论删除
	public function del($rid)
	{
		return Db::name('replay')->where('rid',$rid)->delete();
	}


}
	


