<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Category;
use think\Request;
use app\admin\model\Replay;
use app\admin\model\Test;
use think\Db;

class Index extends Controller
{
	public function index()
	{

		if (input('session.user_type') == null) {
			$this->error('您没有权限');
		}

		return $this->fetch();
	}
	public function welcome()
	{
		return $this->fetch();
	}
	// 板块管理
	public function pulist1()
	{

			$data = Db::name('category')->where('category_pid',0)->select();
		if ($_POST) {
		
			$cid = $_POST['cid'];
			$dat = Db::name('category')->where('category_pid','=',$cid)->select();		
			$this->assign('dat',$dat);
		} else {
			$dat = Db::name('category')->where('category_pid','=',1)->select();
			$this->assign('dat',$dat);
		}
			$this->assign('data',$data);
		
		return $this->fetch();		
	}


	public function pulist2()
	{
		return $this->fetch();
	}
	//个人信息管理
	public function information()
	{
		return $this->fetch();
	}
	// 文章分类管理
	public function wen()
	{
		return $this->fetch();
	}
	// 评论管理
	public function pin()
	{

		$replay = new Replay();

		$rep = $replay->select();

		
		foreach ($rep as $key => $value) {
			$data[] = $value;
		}
	
			$this->assign('data',$data);	
	
		
		return $this->fetch();
	}



	//举报
	public function feedback()
	{
		$test = new Test();
		$data = $test->select();
		
		$this->assign('data',$data);

		return $this->fetch();
	}

	//用户编辑
	public function memberedit()
	{
		 //$request = new Request();
		 $data['username'] = $_POST['username'];
		 $data['sex']  = $_POST['sex'];
		 $data['tel'] = $_POST['tel'];
		 $data['qqemail']  = $_POST['email'];
		$data['address'] = $_POST['address'];
		 $data['perlabel']  = $_POST['perlabel'];

		 $uid = $_POST['uid'];
		if (Db::name('user')->where('uid',$uid)->update($data)) {
			$this->success();
		} else {
			$this->error();
		}
		
	}

	public function adminadd()
	{
		return $this->fetch();
	}

	public function update()
	{
		//dump($_POST);
		$upda = new Category();

		if($upda->upda()) {

			$this->success('修改成功');
		} else {
			$this->error('修改失败');
		};


	}

	//评论删除
	public function delet()
	{
		$replay = new Replay;
		$rid = input('param.rid');

	if($replay->del($rid)) {
		echo '删除成功';

	}

	}

	//举报贴删除
	public function del()
	{
		$test = new Test;
		$tid = input('param.tid');
		if($test->dele($tid)) {
			echo '删除成功';
		}

	}









}