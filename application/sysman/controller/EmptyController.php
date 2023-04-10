<?php

namespace app\sysman\controller;

use think\Db;
use think\facade\Request;
use clt\Form;


class EmptyController extends AdminBase
{
  protected  $dao, $fields;

  public function initialize()
  {
    parent::initialize();
  }

  public function index()
  {
    if (Request::isAjax()) {
      $request = Request::instance();
      $modelname = strtolower($request->controller());
      $model = db($modelname);
      $keyword = input('post.key');
      $page = input('page') ? input('page') : 1;
      $pageSize = input('limit') ? input('limit') : config('pageSize');
      $order = "sort asc,id desc";
      if (input('post.catid')) {
        $catids = db('category')->where(array('parentid' => input('post.catid')))->column('id');
        if ($catids) {
          $catid = input('post.catid') . ',' . implode(',', $catids);
        } else {
          $catid = input('post.catid');
        }
      }
      $cinfo = db('category')->where(array('id' => input('post.catid')))->field('catdir,is_show')->find();
      if (!empty($keyword)) {
        $map[] = array('title', 'like', '%' . $keyword . '%');
      }
      $prefix = config('database.prefix');
      $Fields = Db::getConnection()->getFields($prefix . $modelname);
      foreach ($Fields as $k => $v) {
        $field[$k] = $k;
      }
      if (in_array('catid', $field)) {
        $map[] = array('catid', 'in', $catid);
      }
      $list = $model
        ->where($map)
        ->order($order)
        ->paginate(array('list_rows' => $pageSize, 'page' => $page))
        ->toArray();
      $rsult['code'] = 0;
      $rsult['msg'] = "获取成功";
      $lists = $list['data'];
      foreach ($lists as $k => $v) {
        $lists[$k]['createtime'] = date('Y-m-d H:i:s', $v['createtime']);
        $lists[$k]['catdir'] =  $cinfo['catdir'];
        $lists[$k]['is_show'] =  $cinfo['is_show'];
        $lists[$k]['url'] = url('home/' . $cinfo['catdir'] . '/info', ['id' => $v['id'], 'catId' => $v['catid']]);
      }
      $rsult['data'] = $lists;
      $rsult['count'] = $list['total'];
      $rsult['rel'] = 1;
      return $rsult;
    } else {
      return $this->fetch('content/index');
    }
  }
}
