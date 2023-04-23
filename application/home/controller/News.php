<?php

namespace app\home\controller;

use app\common\controller\HomeBase;
use think\Db;

/**
 * 赛事动态
 */
class News extends HomeBase
{
  public function index()
  {
    $cate = Db::name('category')
            ->order('sort ASC')
            ->field('id,title,create_time,ftitle')
        ->where('status','1')
            ->select();

    $this->assign('cate', $cate); 
        $listcate = Db::name('cate')
            ->select();
            
    // var_dump($cate);die;
    $this->assign('listcate', $listcate);
    $list = Db::name('news')
            ->order('id desc')
            ->field('id,title,create_time')
            ->paginate(10);
    foreach ($list as &$item) {
      $item['title'] = strip_tags($item['title'],'');
    }
//    dump($list);die;
    $this->assign('list', $list);

    return $this->fetch('index');
  }

  /**
   * 查看详情.
   */
  public function view($id=20)
  {
    $cate = Db::name('category')
            ->order('sort ASC')
            ->field('id,title,create_time,ftitle')
            ->select();

    $this->assign('cate', $cate); 
        $listcate = Db::name('cate')
            ->select();
            
    // var_dump($cate);die;
    $this->assign('listcate', $listcate);
    if (empty($id) || !is_numeric($id)) {
      $this->error('错误参数');
    }

    $result = Db::name('news')->where('id', $id)
      ->field('id,title,content,create_time')
      ->find();

    $result['create_time'] = date('Y-m-d H:i:s', $result['create_time']);
    $this->assign('view', $result);

    return $this->fetch();
  }
}
