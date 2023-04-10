<?php

namespace utility;

use think\Db;

/**
 * 短信验证码
 */
class Sms
{
  const SMS_EXPIRE_SECONDS = 300; //短信过期时间
  //发送短信验证码
  public static function send($mobile, $code, $event)
  {
    $ip = request()->ip();
    //验证该手机号是否是当前用户的手机号
    if ($event == 'updatemobile') {
      $userid = \cookie('uid');
      $myMobile = Db::name('enroll_members')->where('id', $userid)->value('mobile');
      if ($mobile !== $myMobile) {
        return error('该手机号不是您的手机号');
      }
    }
    //注册时验证存在手机号则跳出
    if ('register' === $event) {
      $count = Db::name('enroll_members')->where('mobile', $mobile)->count();
      if ($count > 0) {
        return error('该手机号已注册');
      }
    }
    //登录 忘记密码时验证不存在手机号则跳出
    if ('login' === $event || 'forgetpwd' === $event) {
      $count = Db::name('enroll_members')->where('mobile', $mobile)->count();
      if ($count < 1) {
        return error('找不到该手机号');
      }
    }

    //验证发送次数是否超限
    $count = Db::name('sms')->where('mobile', $mobile)->whereTime('create_time', 'd')->count();
    if ($count > 9) {
      return error('抱歉,同一手机号每天最多只能接收10次验证码');
    }

    Db::name('sms')->where('exp_time', '<', time())->setField('verify_state', -1);
    // 验证上一条短信与本次发送时间差是否少于 指定时间
    $expTime = Db::name('sms')->where(['mobile' => $mobile, 'event' => $event, 'verify_state' => 0])->order('id desc')->value('exp_time');
    if ($expTime && $expTime - time() < self::SMS_EXPIRE_SECONDS * 1000) {
      return error('您上一条验证码尚未失效，请输入上一条收到的验证码');
    }

    //限制同一IP在一小时内的发送数量
    $ipSendTotal = Db::name('sms')->where(['ip' => $ip])->whereTime('create_time', '-1 hours')->count();
    if ($ipSendTotal >= 20) {
      return error('同一IP一小时内请求接收验证码数不得超过20条');
    }

    // $sn = 'SDK-WSS-010-11792';
    // $pwd = '30D8E22BCBFE34B56B1F91ADAFC38528';
    // $content = '【山东省“省长杯”工业设计大赛】您的验证码是' . $code . ',请于5分钟内完成输入。如非本人操作，请忽略。';
    // $url = "http://sdk.entinfo.cn:8061/mdsmssend.ashx?sn={$sn}&pwd={$pwd}&mobile={$mobile}&content={$content}&ext=&stime=&rrid=&msgfmt=";
    // $returnCode = httpGet($url);
    $statusStr = array(
      "0" => "短信发送成功",
      "-1" => "参数不全",
      "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
      "30" => "密码错误",
      "40" => "账号不存在",
      "41" => "余额不足",
      "42" => "帐户已过期",
      "43" => "IP地址限制",
      "50" => "内容含有敏感词"
      );
      $smsapi = "http://api.smsbao.com/";
      $user = "SIDI"; //短信平台帐号
      $pass = md5("sidisidi"); //短信平台密码
      $content='【省长杯纺织服装分赛】您的验证码是' . $code . '，请于5分钟内完成输入。如非本人操作，请忽略。';//要发送的短信内容
      $phone = $mobile;//要发送短信的手机号码
      $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
      $returnCode =file_get_contents($sendurl);

    if ($returnCode == 0) {
      $now = time();
      $data = [
        'mobile' => $mobile,
        'code' => $code,
        'event' => $event,
        'ip' => $ip,
        'times' => 0,
        'create_time' => $now,
        'exp_time' => $now + self::SMS_EXPIRE_SECONDS * 1000,
      ];
      Db::name('sms')->insert($data);
    }

    return ['msg' => 'succeed', 'code' => 1];
  }

  /**
   * 验证输入的验证码是否正确.
   *
   * @param string $mobile 手机号
   * @param string $code   验证码
   * @param string $event  事件
   *
   * @return mixed true or error
   */
  public static function verify(string $mobile, string $code, string $event = '')
  {
    $result = Db::name('sms')->where(['mobile' => $mobile, 'event' => $event])
      ->whereTime('exp_time', '-5 minutes')
      ->order('id desc')
      ->field('id,times,code')
      ->find();
    if (!$result) {
      return error('Sorry，您输入的短信验证码无效');
    }
    if (!$result['times'] > 9) {
      Db::name('sms')->where('id', $result['id'])->update(['verify_state' => -1]);
      return error('验证码输入错误次数已超限');
    }

    //验证
    if ($result['code'] != $code) {
      Db::name('sms')->where(['id' => $result['id']])->setInc('times');

      return error('验证码输入错误');
    }

    Db::name('sms')->where('id', $result['id'])->update(['verify_state' => 1]);

    return success();
  }
}
