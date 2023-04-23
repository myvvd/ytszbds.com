<?php

namespace app\home\controller;

use app\common\controller\HomeBase;
use think\Db;

class Index extends HomeBase
{
  public function index()
  {

  	$cate = Db::name('category')
            ->order('sort ASC')
            ->field('id,title,create_time,ftitle')
        ->where('status',1)
            ->select();
            
//     dump($cate);die;
    $this->assign('cate', $cate);

    $listcate = Db::name('cate')
            ->where('status = 0')
            ->order('sort ASC')
            ->select();
            
//     dump($listcate);die;
    $this->assign('listcate', $listcate);
    return $this->fetch();
  }
}
