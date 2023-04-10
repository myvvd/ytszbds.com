<?php

namespace app\common\validate;

use think\Validate;

class ForgetPwd extends Validate
{
  protected $rule = [
    'mobile|手机号' => 'require|mobile',
    'smscode|短信验证码' => 'require',
    'password|密码' => 'require|is_password',
    'confirmpwd|确认密码' => 'require|confirm:password',
  ];

  protected $message = [
    'password.is_password' => '密码长度限制为4-20个字符且不得包含空格',
  ];

  //  验证密码
  protected function is_password($password)
  {
    if (strlen($password) < 4 || strlen($password) > 20) {
      return false;
    }
    return preg_match('/^\S{4,20}$/', $password) ? true : false;
  }
}
