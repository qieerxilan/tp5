<?php
namespace app\index\controller;
use app\index\model\User as userModel;
use think\Controller;
use think\Db;//链接数据库
use think\Validate;
use app\index\model\Follow;
use app\index\model\Privates;// 私信
use app\index\model\Proposal;// 网站的意见



class User extends Controller
{
	public function login()
	{
		return $this->fetch();
	}
	//判断登录
	public function doLogin(UserModel $user)
	{



		$rule = [
		'username|真实姓名' => 'require|length:6,12',
		'password|用户密码' => 'require|length:6,12',
	
		];
		$message = [
		'username.require' => '用户名不符合',
		'password.length' => '用户密码长度应该为6至12位',
		];
		$data = input('post.');

		
		$validate = new Validate($rule,$message);
		$result = $validate->check($data);

		if(!$result){
			return $validate->getError();
		}
		$data = $user->get(['username'=>input('post.username')]);
		if($data == null) {

			$this->error('用户名或密码不正确');
		}

		if($data->password == md5(input('post.password'))){
			session('username',$data->username);
			session('uid',$data->uid);
			session('user_type',$data->user_type);
			$avatar = $data->avatar;
			$user->loginadd($data->uid);


			
			session('avatar',$avatar);
			
			$this->success('登录成功','Index/index');
		}else{
			$this->error('登录失败');
		}

	}

   //关注
	public function follow()
	{
		
	}

	public function register()
	{
		return $this->fetch();
	}





		public function doRegister()
	{


			
		 //判断验证码
		 if(!captcha_check(input('post.code'))){

		


			 $use = new userModel();
			 if ($_POST['username'] == null || $_POST['password'] == null|| $_POST['tel'] == null) {
			 	return '<font color="red">注册不合法</font>';

			 	
			 } else {

			 $data['username'] = $_POST['username'];
			 $data['password'] = md5($_POST['password']);
			 $data['tel'] = $_POST['tel'];

			 $inser = Db::table('tang_user')->insert($data);

			 if ($inser) {
			 	
			 	echo $this->success('注册成功','User/login');
			 	
			 }

			}
			
		} 

	}



	// 修改密码
	public function updatepwd()
	{
		  $usermodel= new UserModel;
		  $password = md5($_REQUEST['pwd']);
		  $data['password'] = $password;
		  $uid=input('session.uid');
		  $result = $usermodel->updatepwd($data,$uid);
		  if($result){
		  	session(null);
		  	echo 1;
		  	die();
		  }
	}

	// 判断密码
	public function dopwd()
	{ 
		  $usermodel= new UserModel;
		   $result = $usermodel->selectPwd();
		   if($result == md5($_REQUEST['pwd'])){
		   	echo 4;
		   	die();
		   }

		

	}

	//用户信息设置
	public function info()
	{
		$userModel = new UserModel();

		$data = $userModel->info();
		$this->assign('data',$data);
		

		return $this->fetch();
	}

	// 更新个人信息
   public function upload(){

              $usermodel= new UserModel;
			// 获取表单上传文件 例如上传了001.jpg
			
              if (request()->file('image')) {
              
              		$file = request()->file('image');
			// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH. 'public' . DS . 'uploads');
				if($info){

		      $path1 = 'public/uploads'; 

			  $path6 =  $info->getSaveName();
              
			  $path2 =str_replace('\\', '/', $path6);
			   $data['avatar'] = $path2;

              }
          }

 

			   $data['username'] = $_POST['username'];
			  
			   $data['works'] = $_POST['works'];
			   $data['sex'] = $_POST['sexs'];
			   $data['perlabel'] = $_POST['perlabel'];
			   $uid=input('session.uid');
			   $username=input('session.username');
			   // dump($uid);
			   // dump($username);
			   // die;	
               $relupdate=$usermodel->upload($data,$uid);
              
             if($relupdate){
             	 session('avatar',$path2);

             	$this->success('更新成功');
             }else{
             	$this->error('更新失败');

            }

        }
			// }else{
			// // 上传失败获取错误信息
			// echo $file->getError();
			// }
 // 个人主页
	
	public function self()
	{
		$use = new userModel;

		$uid = input('param.uid');

		$data = $use->selffolow($uid);
		$dat  = $use->self($uid);
		$follow = $use->selectfolow($uid);
		$fans = $use->selectfans($uid);
		//dump($data);

		$count = count($follow);
		$coun = count($fans);
		$this->assign('fans',$fans);
		$this->assign('coun',$coun);
		$this->assign('count',$count);
		$this->assign('follow',$follow);
		$this->assign('data',$data);
		$this->assign('dat',$dat);
		return $this->fetch();
	}
   // 添加关注
	public function followad()
	{
		$data['follow_uid'] = input('param.follow_uid');
		$data['self_uid'] = input('session.uid');

		$follow = new Follow;
		if($follow->followadd($data)) {

			echo '关注成功';
		};

			

	}
	// 查找私信	 
	public function message()
	{
		$privates = new Privates;
		$user = new userModel;
		$uid = input('param.uid');
		$person = $user->selectUser($uid);
		
		
		$this->assign('person',$person);
		return $this->fetch();
	}
	//发留言
	public function addmessage()
	{

		$privates = new Privates;
		//echo 111;	
		$data['privates_uid'] = $_POST['private_uid'];	
		$data['write_uid'] = input('session.uid');
		$data['privates_content'] = input('post.privates_content');

		if($privates->addprivates($data)) {
               
              $this->success('留言成功');
		
		}else{
			$this->error('留言失败');
		}
	

	}




	
    

	//用户退出
	public function loginout()
	{

		session(null);
		$this->success('退出成功','index/index/index');

	}
	//消息中心
	public function news()
	{
		$user = new userModel;

		$uid = input('param.uid');
		$data = $user->selectnews($uid);


		$this->assign('data',$data);
		return $this->fetch();
	}
	// 回复留言
	public function replaynews()
	{

		$privates_uid = input('param.privates_uid');
		

		 $this->assign('privates_uid',$privates_uid);

		//echo $this->privates;
		
		return $this->fetch();
	}


      // 回复留言
	public function request()
	{
		$privates = new Privates;

		$data['privates_uid'] = input('param.uid');

		$data['write_uid'] = input('session.uid');
		if (!input('post.privates_content')) {
				$this->error('回复内容不能为空');
				return false;
		}
		$data['privates_content'] = input('post.privates_content');
		if($privates->addprivates($data)) {
               
              $this->success('回信成功');
		
		}else{

			 $this->error('回信失败');
		}

	}

      // 删除留言
	public function deletenews()
	{
		$privates = new Privates;

		$pid = input('param.pid');

		if($privates->deletenew($pid)) {

			$this->success('删除成功');
		} else {
			$this->errror('删除失败');
		}




	}

      //网站建议
	public function proposal()
	{
		return $this->fetch();
	}
   // 提交建议

	public function addproposal()
	{

		$proposal = new Proposal;
		$data['proposal_uid'] = input('session.uid');
		$data['proposal_qq'] = input('param.proposal_qq');
		$data['proposal_content'] = input('param.proposal_content');
		$data['proposal_name'] = input('session.username');
		if ($proposal->insertproposal($data)) {
			echo '成功提交意见';
		}
	}


		//取消关注
	public function cancelfollow()
	{

		$user = new userModel;
		$fid = input('param.fid');
		

		if ($user->cancelfoll($fid)) {
			echo '取消关注';
		}

	}







}



