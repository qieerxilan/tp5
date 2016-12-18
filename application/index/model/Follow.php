<?php

namespace app\index\model;
use think\Model;
use think\Db;

class Follow extends Model 
{
	public function followadd($data)
	{
		return Db::name('follow')->insert($data);
	}


}