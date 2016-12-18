<?php
namespace app\admin\controller;

use think\Controller;

use app\admin\model\User;
use think\Request;

class Member extends Controller
{
	
	public function adminlist()
	{
		$user = new User();
		$data = $user->userlist();
		//dump($data);
		$this->assign('data',$data);
		//dump($data);
		return $this->fetch();
	}


	public  function adminrole()
	{
		return $this->fetch();
	}


	public function memberdel()
	{
		return $this->fetch();
	}

	public  function memberlevel()
	{
		return $this->fetch();
	}

	public function memberfen()
	{
		return $this->fetch();
	}
	//会员编辑
	public function memberadd()
	{

		
		 $user = new User();
		$data = $user->useredit();
		
		 $this->assign('data',$data);
		return $this->fetch();
	}
	public function changepassword()
	{
		return $this->fetch();
	}
	public function membershare()
	{
		return $this->fetch();
	}
	public function memberbrowse()
	{
		return $this->fetch();
	}
	
	public function memberdownload()
	{
		return $this->fetch();
	}

	//会员删除
	public function memberdel1()
	{    

		$user = new User();
		if($user->del()) {

			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}

	}
	
	
	
}	
	