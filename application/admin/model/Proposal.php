<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Proposal extends Model
{

	public function select()
	{
		return Db::name('proposal')->select();
	}


	public function deletepro($pid)
	{
		return Db::name('proposal')->where('pid',$pid)->delete();
	}
}

