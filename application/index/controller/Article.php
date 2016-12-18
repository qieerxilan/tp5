<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Category;
use app\index\model\Test;
use app\index\model\Enjoy;
use app\index\model\Replay;
use app\index\model\User;
use app\index\model\Follow;
use think\REQUEST;
use think\Db;
class Article extends Controller
{
    // 发表状态
	public function article()
	{
			$test = new Test;
       $list = $test-> where('tid','>',1)->paginate(5,true);
      // $page = $list->render();
       $count = $test-> where('tid','>',1)->count();
       $first = 1;
       $last = ceil($count/5);
       if(isset($_GET['page'])){

       	$thisPage = $_GET['page'];

       }else{

       	  $thisPage = 1;
       }

       if ($thisPage == 1){
			$prev = $thisPage;
		} else{
			$prev = $thisPage - 1;
		}

		if($thisPage == $last){
			$next = $last;
		} else {
			$next = $thisPage + 1;		
		}


      $this->assign([
			'list' => $list,
			//'page' => $page,
			'first' => $first,
			'last' => $last,
			'next' => $next,
			'prev' => $prev
			]);



      

		$cate = new Category;
		$tes = new Test;
		$use = new User;
		$label = $cate->artlabel();
		$test = $tes->selectart();
		//热门标签
		$section = $tes->section();
		$users = $use->hotuser();
		
       //  发帖的评论
		 $replaymodel = new Replay;

          $data = $replaymodel->replaysel();

		  $this->assign('data',$data);

		$this->assign('users',$users);
		$this->assign('label',$label);
		$this->assign('section',$section);
		$this->assign('test',$test);



		return $this->fetch();
	}

     //举报
	public function repor()
	{

		if (input('session.uid') == null) {
			$this->error('请先登录');
		}

		$report = new Test;
		$tid = input('param.tid');
		if($report->report($tid)) {
			$this->success('举报成功');
		 } else {
		 	$this->error('举报失败');
		 };

	}

	//筛选回复
	public function replayy()
	{

		echo 111;
	}

	




	//发布文章
	public function artinsert()
	{

		$test = new Test();

		if (request()->file('image')) {			
			// 获取表单上传文件 例如上传了001.jpg
			$file = request()->file('image');
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				$path1 = 'public/uploads'; 

			  $path6 =  $info->getSaveName();
              
			  $path2 = str_replace('\\', '/', $path6);
			   $data['test_picture'] = $path2;
			

			}else{
			// 上传失败获取错误信息
			echo $file->getError();			
		}
		}
	
		$data['test_article'] = $_POST['test_article'];
		$data['test_label'] = $_POST['label'];
		$data['user_uid'] =input('session.uid');

		if($test->articeladd($data)) {

		 //   	$id = $test->maxid()[0]['tid'];
			// $arr = explode(' ',$_POST['label']);
				
			// for ($i=0; $i < count($arr); $i++) {
			//  	$dat['test_tid'] = $id;
			//  	$dat['label'] = $arr[$i];
			// 	$a= Db::name('smallsection')->insert($dat);
				// smallsection::get($a);
				// echo smallsection::getLastSql();

			$this->success('发表成功');
		} else {
			$this->error('发表失败');
		};
		
		
	}  

    // 删除文章
	public function dele()
	{
		$tes = new Test;

		$tid = input('param.tid');
		if($tes->delet($tid)) {

			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		};
	}

	//收藏
	public function enjoy()
	{

		$enjoy = new Enjoy;
		$data['enjoy_tid'] = input('param.tid');
		$data['enjoy_uid'] = input('session.uid');

		$enjoy->add($data);

	} 

     // 状态的评论
	public function replay()
	{
		$replay = new Replay;
		$data['text_tid'] = $_POST['tid'];
		$data['replay_content'] = $_POST['replay_content'];
		$data['user_uid'] = input('session.uid');

		if($replay->replayadd($data)) {
			$this->success('评论成功');
		} else {
			$this->error('评论失败');
		}
	}

	//关注
	public function follow()
	{
		$follow = new Follow;

		if (input('param.uid') == input('session.uid')) {
			return '不能关注自身';


		}
		$data['follow_uid'] = input('param.uid');
		$data['self_uid'] = input('session.uid');


		if($follow->followadd($data)) {
			echo '关注成功';
		}


	}
     // 待法 没用到
	public function status()
	{
		return $this->fetch();
	}
      // 收藏的文章
     
     public function friend()
	{

		$enjoy = new Enjoy;
		$uid = input('session.uid');
		$data = $enjoy->selectenjoy($uid);

		$dd = [];


		for($a=0;$a<count($data );$a++){
			$a =$data[$a]['user_uid'];
			$dat = $enjoy->selectuser($a);

		}


		$this->assign('data',$data);
		return $this->fetch();
	}


	// wen  发表
	 public function wen ()
	 {
	 	return $this->fetch();
	 }

	 //内容展示
	  public function neirong()
	  {

	  	    
             
               $aid = input('param.aid');

               $dat2 = Db::name('art')->where('aid','=',$aid)->select();

               // 发表内容的时候 选出作者
               $uid = input('session.uid');
               $userdata = Db::name('user')->where('uid','=',$uid)->select();
               $this->assign('userdata',$userdata);

                // 在 tang_art 发帖的 浏览次数
               $updates = Db::name('art')->where('aid',$aid)->setInc('hits');
               $this->assign('dat2',$dat2);
    	    
		        // tang_hui 回复表的 回复内容
		        $huiselect = Db::name('hui')->where('art_aid','=',$aid)->paginate(5);
              
                

		        $this->assign('huiselect',$huiselect);
   
                
	  	return $this->fetch();
	  }


	  // tang_hui表的回复
	  public function  huiinsert()
	  {
		   //$request = Request::instance();

	        
	       $data['hui_content']=input('param.hui_content');
	       $data['art_aid']= input('param.art_aid');
	       $data['user_uid'] = input('session.uid');
	       $data['hui_username'] = input('session.username');
	      
       
	         $artinsert = Db::name('hui')->insert($data);

	         if($artinsert) {
			     echo json_encode($data);
		     } else {
			        echo 111;    
		     }

	  }





	






}    