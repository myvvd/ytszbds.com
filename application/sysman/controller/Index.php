<?php

namespace app\sysman\controller;

use think\facade\Env;
use think\Db;

class Index extends AdminBase
{
  public function initialize()
  {
    parent::initialize();
  }

  public function index()
  {
    return $this->fetch();
  }

  public function main()
  {
    $totalCount = Db::name('entry_work')->where('status',1)->count();
    $todayWorksCount = Db::name('entry_work')->whereTime('create_time', 'today')->count();
    $waitChushenCount = Db::name('entry_work')->where('checkstatus1', '0')->count();
    $stat = [
      'totalWorksCount' => $totalCount,
      'todayWorksCount' => $todayWorksCount,
      'waitChushenCount' => $waitChushenCount,
    ];
    $this->assign('stat', $stat);
    return $this->fetch();
  }

  public function clear()
  {
    $R = Env::get('runtime_path');
    if ($this->_deleteDir($R)) {
      $result['info'] = '清除缓存成功!';
      $result['status'] = 1;
    } else {
      $result['info'] = '清除缓存失败!';
      $result['status'] = 0;
    }
    $result['url'] = url('sysman/index/index');

    return $result;
  }

  private function _deleteDir($R)
  {
    $handle = opendir($R);
    while (($item = readdir($handle)) !== false) {
      if ('.' != $item and '..' != $item) {
        if (is_dir($R . '/' . $item)) {
          $this->_deleteDir($R . '/' . $item);
        } else {
          if (!unlink($R . '/' . $item)) {
            die('error!');
          }
        }
      }
    }
    closedir($handle);

    return rmdir($R);
  }

  //退出登陆
  public function logout()
  {
    cookie(null,config('cookie.prefix'));
    session(null,config('session.prefix'));
    $this->redirect('/index');
  }
}
