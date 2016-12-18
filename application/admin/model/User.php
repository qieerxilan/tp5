<?php

namespace app\admin\model;

use think\Model;
use think\Db;



class User extends Model
{

	public function userlist()
	{
		return Db::name('user')->select();
	}

	public function useredit()
	{
		$uid = $_GET['uid'];
		return Db::name('user')->where('uid',$uid)->select();
	}
	//用户删除
	public function del()
	{
		$uid = input('param.uid');

		return Db::name('user')->where('uid',$uid)->delete();
	}
	//管理员权限
	public function usertype()
	{
		return Db::name('user')->select();
	}
	//管理员添加
	public function updata()
	{
		$data['user_type'] = $_POST['user_type'];
		$uid = $_POST['uid'];

		return Db::name('user')->where('uid',$uid)->update($data);
	}

	//管理员删除
	public function admindelete()
	{
		$data['user_type'] = 0;
		$uid = $_POST['uid'];

		return Db::name('user')->where('uid',$uid)->update($data);
	}

}	





