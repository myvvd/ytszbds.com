<?php

namespace app\common\controller;

use think\Controller;
use think\Image;

use think\Db;

class HomeBase extends Controller
{
  protected $auth = null;
  protected $uid = 0;

  protected function initialize()
  {

    $req = $this->request;
    $req->filter('strip_tags');

    $url = strtolower($req->pathinfo());
    $this->uid = cookie('uid');

	$webset = Db::name('web_set')->find(1);

	$webset['undertake'] = explode(",",$webset['undertake']);
	$webset['xieban'] = explode(",",$webset['xieban']);
	$webset['tel'] = explode(",",$webset['tel']);

    $this->assign('url', $url);
    $this->assign('webset', $webset);
  }
}
