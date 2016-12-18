<?php

namespace app\index\model;
use think\Model;
use think\Db;
class User extends Model
{
	public function upload($data,$uid){

         return User::where('uid', $uid)->update($data);
   
	}

	//展示个人信息
	public function info()
	{
		  $uid= input('session.uid');

         return Db::table('tang_user')->where('uid',$uid)->select();
	}

	public function loginadd($uid)
	{
		return Db::name('user')->where('uid', $uid)->setInc('login_num');
	}


	//筛选活跃用户
	public function hotuser()
	{
		return Db::name('user')					
					->order('login_num desc')
					->limit(7)
					->select();
	}
     
   // 修改密码 
	public function  updatepwd($data,$uid)
	{
		 
	  return User::where('uid', $uid)->update($data);

	} 

	//个人主页
	public function selffolow($uid)
	{
		return Db::query('select * from tang_user as u,tang_test as t where t.user_uid = u.uid and u.uid ='.$uid);
	
	}
    // 个人主页
	public function self($uid)
	{
		return Db::name('user')->where('uid',$uid)->select();
	}
   // 筛选 关注的人
	public function selectfolow($uid)
	{
		return Db::query('select * from tang_user as u,tang_follow as f where f.follow_uid = u.uid and f.self_uid = '.$uid);	
	}
    // 筛选分析
	public function selectfans($uid)
	{
		return Db::query('select * from tang_user as u,tang_follow as f where u.uid=f.self_uid and f.follow_uid ='.$uid);
	}
	//发私信
	public function selectUser($uid)
	{
		return Db::name('user')->where('uid',$uid)->select();
	}


	// 查看原始密码
		public function selectpwd()
		{
			$uid= session::get('uid');
			 return Db::table('tang_user')->where('uid',$uid)->value('password');
		}
   // 筛选私信
	public function selectnews($uid)
	{
		return Db::query('select * from tang_user as u,tang_privates as p where u.uid=p.write_uid and p.privates_uid='.$uid);
	}

	//取消关注
	public function cancelfoll($fid)
	{

	return Db::name('follow')->where('fid',$fid)->delete();
	
	}



	
}