<?php

namespace app\index\model;
use think\Model;
use think\Db;


class Replay extends Model
{
	public function replayadd($data)
	{
		return Db::name('replay')->insert($data);
	}
	public function replaysel()
	{
		 

         return Db::table('tang_replay')->select();
	}

	
}