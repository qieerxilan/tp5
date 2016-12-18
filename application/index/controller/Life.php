<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;

class Life extends Controller
{
    public function life()
    { 

           
       
		  $dat = Db::name('category')->where('category_pid','=',2)->select();


		  $this->assign('dat',$dat);

      $lifeselect = Db::name('art')->where('aid','>',0)->paginate(4);

      $this->assign('lifeselect',$lifeselect);
		   // 最新体验馆
       // 
       $newuser = Db::query('select * from tang_user  order by create_time desc limit 4');

          $this->assign('newuser',$newuser);

        return $this->fetch();
    }


    public  function video()
    {
    	    $data= input('param.cid');
    	   //$da = Db::name('art')->where('aid','=',$data)->select();
    	     //$this->assgin('da',$da); 
    	       $dat = Db::name('category')->where('category_pid','=',2)->select();		
		  $this->assign('dat',$dat);

    	    
    	   $dat2 = Db::name('art')->where('category_cid','=',$data)->paginate(4);	
    	    
		    $this->assign('dat2',$dat2);
        $this->assign('data',$data);

     // 最新体验馆
          $lifeselect = Db::name('art')->where('aid','>',0)->paginate(4);

      $this->assign('lifeselect',$lifeselect);
       $newuser = Db::query('select * from tang_user  order by create_time desc limit 4');

          $this->assign('newuser',$newuser);

    	  return  $this->fetch();

    }
    // 展示板块
    public function arts()
    {
          $ar= Db::name('category')->where('category_pid','=',2)->select();		
		      $this->assign('ar',$ar);

		    //  $dat = Db::name(art)->where('','=',2)->select();		
		    // $this->assign('dat',$dat);
          $uid= input('session.uid');
        $artsuser = Db::name('user')->where('uid','=',$uid)->select(); 

        $this->assign('artsuser',$artsuser);
        

    	return $this->fetch();
    }
    // 发表帖子
      public function artsinsert()
    {

    	
    	  if (request()->file('image')) {
              
              		$file = request()->file('image');
			// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH. 'public' . DS . 'uploadsqqqq');
				if($info){

		      $path1 = 'public/uploads'; 

			  $path6 =  $info->getSaveName();
              
			  $path2 =str_replace('\\', '/', $path6);
			   $data['art_pic'] = $path2;

              }
          }
          $data['art_title'] = $_REQUEST['title'];

          $data['category_cid'] = $_REQUEST['cate'];
          $data['art_username'] = input('session.username');
         
          $data['ping'] = $_REQUEST['ping'];
          $data['art_wen'] = $_REQUEST['content'];
          // 标签
          $data['art_label'] = $_REQUEST['art_label'];

         
          $artin =  Db::name('art')->insert($data);
           
            
             if($artin ){
             

             	$this->success('插入成功','index/life/video');
             }else{
             	$this->error('插入失败!');

            }

    }




}