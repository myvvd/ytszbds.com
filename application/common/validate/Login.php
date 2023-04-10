<?php

namespace app\common\validate;

use think\Validate;

/**
 * 用户登录验证
 * Class Login
 * @package app\common\validate
 */
class Login extends Validate
{
  protected $rule = [
    'mobile|手机号' => 'require|mobile',
    'password|密码' => 'require',
  ];
}
