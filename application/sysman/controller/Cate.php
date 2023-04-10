<?php

namespace app\sysman\controller;

use think\Db;
use think\Request;

class cate extends AdminBase
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
      $list = Db::name('category')
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
      $record = Db::name('category')->find($id);
    }
    // var_dump($record);exit;
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

    $result = Db::name('category')->where('id', $data['id'])->find();
    // var_dump($data);exit;
    if(empty($data['id'])){
       unset($data['id']);
    }
    unset($data['Image']);

    if ($result) {
      $result = Db::name('category')->update($data);
    } else {
      $result = Db::name('category')->insert($data);
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
    Db::name('category')->where($map)->delete();

    return $result = ['code' => 1, 'msg' => '删除成功!'];
  }

  //批量删除
  public function delall()
  {
    $map[] = array('id', 'IN', input('id/a'));
    Db::name('category')->where($map)->delete();
    $result['msg'] = '删除成功！';
    $result['code'] = 1;
    $result['url'] = url('index');

    return $result;
  } 

  //图片上传
  public function uploadimg()
  {
      $file = $_FILES['Image'];//得到传输的数据
        
      $imgname = date('Ymdhis',time());

      $tmp = $file['tmp_name'];
      $type = explode('.', $file['name']);

      $filepath = './uploads/';

      if(move_uploaded_file($tmp,$filepath.$imgname.'.'.$type[1])){
          $path = $_SERVER['HTTP_ORIGIN'].'/uploads/';
          echo $path.$imgname.'.'.$type[1];

      }else{

          echo "上传失败";

      }
  }

 
  public function isIndex()
  {
    $id = input('id');
    $is_enable = input('val');
    // return $is_enable;
    Db::name('category')->where('id', $id)->update(['is_index' => $is_enable]);
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
    Db::name('category')->where('id', $id)->setField($field, $val);
    $result['msg'] = '设置成功';
    $result['code'] = 1;
    $result['url'] = url('index');

    return $result;
  }
}