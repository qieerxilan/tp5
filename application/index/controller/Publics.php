<?php

namespace app\index\controller;
use app\index\model\User as userModel;
use think\Controller;
use think\Db;//链接数据库
use think\Validate;


class Publics extends Controller
{
     public function header ()
     {
        	$userModel = new UserModel();

		     $data = $userModel->info();
		     $this->assign('data',$data);
     }


     public function sou()
     {
          $ha= input('post.search');


          // $sou = Db::query("select * from tang_art where art_wen like '%$ha%'");
          // $this->assign('sou',$sou);

          $sou = Db::table('tang_art')->where('art_title&aid','like','%'.$ha)->find();
          
              $this->assign('sou',$sou);
     	  return  $this->fetch();
     }
}