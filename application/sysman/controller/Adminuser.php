<?php

namespace app\sysman\controller;

use app\common\model\Admin;
use think\facade\Request;
use think\Validate;
use think\Db;


class Adminuser extends AdminBase
{
  public function initialize()
  {
    parent::initialize();
    if ($this->rolecode !== 'admin') {
      $this->error('无权访问');
    }
    $this->model = new Admin();
  }

  //管理员列表
  public function index()
  {
    if (Request::isAjax()) {
      $getGroupList = $this->getGroupList();
      $list = $this->model->order('id', 'desc')->hidden(['password'])->select()->toArray();
      foreach ($list as &$value) {
        foreach ($getGroupList as $item) {
          if ($item['id'] == $value['expert_group_id']) {
            $value['expert_group_name'] = $item['name'];
          }
        }
      }
      return ['code' => 0, 'msg' => '获取成功!', 'data' => $list];
    }
    return view();
  }

  public function add()
  {
    if (Request::isAjax()) {
      $data = input('post.');
      $hasRepeatUser = Admin::get(['username' => $data['username']]);
      if ($hasRepeatUser) {
        return ['code' => 0, 'msg' => '用户已存在，请重新输入用户名!'];
      }

      //单独验证密码
      $checkPwd = Validate::make([input('post.password') => 'require']);
      if (false === $checkPwd) {
        return ['code' => 0, 'msg' => '密码不能为空！'];
      }
      //添加
      $data['password'] = md5($data['password'] . config('salt'));

      if ($data['rolecode'] === 'specialist') {
        if (empty(session('current_stage'))) {
          session('current_stage', getCurrentStage());
        }
        $data['expert_type'] = session('current_stage');
      }


      if (Admin::create($data)) {
        return ['code' => 1, 'msg' => '管理员添加成功!', 'url' => url('index')];
      } else {
        return ['code' => 0, 'msg' => '管理员添加失败!'];
      }
    }

    $this->assign('info', 'null');
    return view('edit');
  }

  //删除管理员
  public function del()
  {
    $id = input('post.id');
    Admin::where('id', '=', $id)->delete();
    $this->success();
  }

  //更新管理员信息
  public function edit()
  {
    if (request()->isPost()) {
      $data = input('post.');
      $password = input('post.password');
      $map[] = ['id', '<>', $data['id']];
      $where['id'] = $data['id'];

      if ($data['username']) {
        $map[] = ['username', '=', $data['username']];
        $hasRepeatUser = Admin::where($map)->find();
        if ($hasRepeatUser) {
          return ['code' => 0, 'msg' => '用户已存在，请重新输入用户名!'];
        }
      }
      if ($password) {
        $data['password'] = md5($password . config('salt'));
      } else {
        unset($data['password']);
      }

      Admin::update($data, $where);
      if (cookie('aid') == $data['id']) {
        cookie('username', $data['username']);
        cookie('rolecode', $data['rolecode']);
        session('rolecode', $data['rolecode']);
      }
      return ['code' => 1, 'msg' => '管理员修改成功!', 'url' => url('index')];
    }

    $model = new Admin();
    $info = $model->field('id,username,rolecode,expert_group_id')->find(input('id'))->getData();
    $this->assign('info', json_encode($info));
    return view();
  }

  //获取专家对应分组
  public function getGroupList(){
    $list = Db::name('expert_group')->field('id,name')->select();
    return $list;
  }
}
