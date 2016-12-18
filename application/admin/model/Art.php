<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Art extends Model
{

	public function selectart()
	{
		return Db::name('art')->select();
	}

	public function deleteart($aid)
	{
		return Db::name('art')->where('aid',$aid)->delete();
	}
}