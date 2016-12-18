<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Category extends Model
{
	//板块管理
	public function cate()
	{
		$data = Db::name('category')->where('pid',0)->select();

		//dump($data);


	}

	//版块更新
	public function upda()
	{
		$data['category_title'] = $_POST['category_title'];
		$data['description'] = $_POST['description'];
		$data['user_uid'] = $_POST['user_uid'];
		$cid = $_POST['cid'];
		return Db::name('category')->where('cid',$cid)->update($data);
	}


}