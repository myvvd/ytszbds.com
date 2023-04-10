<?php

namespace app\api\controller;

use app\common\controller\Api;
use utility\Sms;
use wxJsSdk\JsSdk;

class Utils extends Api
{
  //发送验证码
  public function sendCode($mobile, $event = 'register')
  {
   // if($event == 'register') {
   //   $this->error('抱歉，当前已停止申报，无法新注册用户了');
   // }

    //4位随机数验证码
    $code = rand_string(4, 1);
    //获取ip
    $result = Sms::send($mobile, $code, $event);

    if ($result['code'] == 1) {
      $this->success();
    }
    $this->error($result['msg']);
  }
}
