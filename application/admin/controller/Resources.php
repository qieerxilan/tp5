<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Proposal;
use app\admin\model\Test;
use app\admin\model\Art;

class Resources extends Controller
{
	
	
	public function music()
	{
		$art = new Art;
		$data = $art->selectart();
		$this->assign('data',$data);

		return $this->fetch();
	}


	public function delet()
	{

		$art = new Art;
		$aid = input('param.aid');
		if ($art->deleteart($aid)) {
			$this->success('删除成功');
		}
	}


	public  function proposal()
	{
		$proposal = new Proposal;
		$data = $proposal->select();
		$this->assign('data',$data);
		return $this->fetch();
	}


	public function article()
	{
		$test = new Test;
		$data = $test->selecttest();

		$this->assign('data',$data);
		return $this->fetch();
	}

	public function deletearticle()
	{

		$tid = input('param.tid');

		$test = new Test;

		if ($test->delet($tid)) {
			$this->success('删除成功');
		}


	}
	//删除意见
	public function deletepro()
	{
		$pro = new Proposal;
		$pid = input('param.pid');
		if ($pro->deletepro($pid)) {
			$this->success('删除成功');
		}

	}


	
	
	
}	