<?php

namespace app\index\model;
use think\Model;
use think\Db;


class Proposal extends Model
{

	public function insertproposal($data)
	{
		return Db::name('proposal')->insert($data);
	}


}