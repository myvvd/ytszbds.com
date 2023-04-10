<?php

namespace app\sysman\controller;

use think\Controller;

class AdminBase extends Controller
{
  protected $model;
  protected $rolecode;

  public function initialize()
  {
    //判断管理员是否登录
    if (!cookie('aid')) {
		
	  if(isMobile()){		 
		  $furl = $_SERVER['REQUEST_URI'];
		  cookie('furl', $furl, 7200);
		  $this->redirect('/expertlogin');		  
	  }else{		  
		  $this->redirect('/index');
		  
	  }
      
    }
    $result = \think\Db::name('admin')->where('id', cookie('aid'))->find();
    if ($result['status'] == 0 || cookie('rolecode') !== $result['rolecode']) {
      $this->redirect('/index');
    }
    $this->username = cookie('username');
    $this->rolecode = cookie('rolecode');
    $this->assign('rolecode',$this->rolecode);
    $this->assign('username',$this->username);
  }


  //空操作
  public function _empty()
  {
    return $this->error('空操作，返回上次访问页面中...');
  }

  public function removeFile($url)
  {
    if (!$url) {
      return;
    }
    $apppath = \think\facade\Env::get('root_path');
    $path = ($apppath . 'public' . $url);
    unlink($path);
  }

  public function rtnSuccess($msg = '操作成功!', $url = 'index')
  {
    return ['code' => 1, $msg, $url];
  }


  /**
   * 公用获取分页页码及页大小.
   *
   * @return [page,limit]
   */
  protected function buildLayParms()
  {
    $page = $this->request->get('page', 1);
    $limit = $this->request->get('limit', 0);

    return [$page, $limit];
  }
}
