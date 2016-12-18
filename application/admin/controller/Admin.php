<?php

namespace app\admin\controller;

use think\Controller;

use app\admin\model\User;

class Admin extends Controller
{


	public function adminroleadd()
	{
		return $this->fetch();
	}

	public function adminpermission()
	{
		return $this->fetch();
	}

	public function adminlist()
	{
		return $this->fetch();		
	}

	public function adminadd()
	{
		return $this->fetch();
	}
	//管理员权限
	public function memberlist()
	{
		$use = new User();
		$data = $use->usertype();
		$ord = '';
		
		foreach ($data as $key => $value) {

			if ($value['user_type'] == 1) {				
				$v = $value['username'];				
				$dat[] = $v;
			} 
			elseif ($value['user_type'] == 2) {
				
				$or = $value['username'];			
				$ord[] = $or;
			
			}
		}
		$this->assign('data',$data);
		$this->assign('dat',$dat);
		$this->assign('ord',$ord);
		return $this->fetch();
	}
	public function frameborder()
	{
		return $this->fetch();
	}

	public function admina()
	{
		$use = new User();

		if($use->updata()) {

			$this->success('修改成功');
		} else {
			$this->error('修改失败');
		};


	}

	public function admindel()
	{
		$use = new User();

		if($use->admindelete()) {

			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		};
	}

}