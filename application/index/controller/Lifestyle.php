<?php
namespace app\index\controller;

use think\Controller;
class Lifestyle extends Controller
{
    public function lifestyle()
    {
        return $this->fetch();
    }
}