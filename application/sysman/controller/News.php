<?php

namespace app\sysman\controller;

use think\Db;

class News extends AdminBase
{
  public function initialize()
  {
    parent::initialize();
  }

  public function index()
  {
    if ($this->request->isAjax()) {
      $page = input('page') ? input('page') : 1;
      $pageSize = input('limit') ? input('limit') : config('pageSize');
      $list = Db::name('news')
        ->field('id,title,create_time')
        ->order('id desc')
        ->paginate(array('list_rows' => $pageSize, 'page' => $page))
        ->toArray();

      foreach ($list['data'] as $k => $v) {
        $list['data'][$k]['create_time'] = date('Y-m-d H:i', $v['create_time']);
      }

      return ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
    }

    return $this->fetch();
  }

  /**
   * 显示编辑页面
   *
   * @param string $id
   */
  public function edit($id = '')
  {
    $record = null;
    if (!empty($id)) {
      $record = Db::name('news')->find($id);
    }
    $this->assign('record', $record);

    return $this->fetch('add');
  }

  /**
   * 执行保存
   */
  public function save()
  {
    if (false == $this->request->isPost()) {
      $this->error('非法请求');
    }
    $data = $this->request->except('file');
    $data['create_time'] = time();
    // var_dump($data);exit;
    // return json($data);
    $result = Db::name('news')->where('id', $data['id'])->find();
    if ($result) {
      $result = Db::name('news')->update($data);
    } else {
      $result = Db::name('news')->insert($data);
    }
    if ($result) {
      $this->success('保存成功');
    }
    $this->error('保存失败');
  }

  //删除
  public function del()
  {
    $map['id'] = input('id/d');
    Db::name('news')->where($map)->delete();

    return $result = ['code' => 1, 'msg' => '删除成功!'];
  }

  //批量删除
  public function delall()
  {
    $map[] = array('id', 'IN', input('id/a'));
    Db::name('news')->where($map)->delete();
    $result['msg'] = '删除成功！';
    $result['code'] = 1;
    $result['url'] = url('index');

    return $result;
  }

  public function isIndex()
  {
    $id = input('id');
    $is_enable = input('val');
    // return $is_enable;
    Db::name('news')->where('id', $id)->update(['is_index' => $is_enable]);
    $result['msg'] = '设置成功';
    $result['code'] = 1;
    $result['url'] = url('index');

    return $result;
  }

  public function updateState()
  {
    $id = input('post.id/d');
    $field = input('post.field');
    $val = input('post.val');
    Db::name('news')->where('id', $id)->setField($field, $val);
    $result['msg'] = '设置成功';
    $result['code'] = 1;
    $result['url'] = url('index');

    return $result;
  }
}
