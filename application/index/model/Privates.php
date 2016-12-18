<?php

namespace app\index\model;
use think\Model;
use think\Db;

class Privates extends Model
{
	// 添加私信
	public function addprivates($data)
	{
		return Db::name('privates')->insert($data);

	}

    // 删除私信
	public function deletenew($pid)
	{

		return Db::name('privates')->where('pid',$pid)->delete();
	}




}

