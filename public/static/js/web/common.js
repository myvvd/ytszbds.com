//发送验证码
$(".smscode-button").on("click", function () {
  var el = $(this);
  var telInput = el.parents("form").find("input[name=mobile]");
  var eventType = el.parents("form").find("input[name=action]").val();
  var errMsg = getVerificationCode(el, telInput, "#FF3E3E", eventType);
  if (errMsg) {
    var tipsIndex = layer.tips(errMsg, telInput, {
      tips: [2, "#ed0000"],
      tipsMore: true,
      time: 3000,
    });
    telInput.data("tipsIndex", tipsIndex);
  }
});

/**
 * 发送验证码
 * @param {object} button 获取验证码的按钮
 * @param {string} telInput 电话
 */
function getVerificationCode(button, telInput, buttonColor, eventType) {
  var errMsg;
  var mobile = $.trim(telInput.val());
  if (!mobile) {
    errMsg = "请输入您的手机号";
  } else if (!isMobile(mobile)) {
    errMsg = "请输入正确的手机号格式";
  }
  if (errMsg) {
    return errMsg;
  }
  button.attr("disabled", "disabled").css({
    background: "#999",
    cursor: "no-drop",
  });
  //获取验证码
  var time = 60;
  button.text("重新发送(" + time + "s)");
  var Interval = window.setInterval(function () {
    time--;
    button.text("重新发送(" + time + "s)");
    if (time < 1) {
      button.text("获取验证码").removeAttr("disabled").css({
        background: buttonColor,
        cursor: "pointer",
      });
      window.clearInterval(Interval);
    }
  }, 1000);
  //send sms code
  $.ajax({
    url: "/api/utils/sendCode",
    type: "post",
    data: {
      front: 1,
      mobile: mobile,
      event: eventType,
    },
    success: function (res) {
      if (res.code === 0) {
        button.text("获取验证码").removeAttr("disabled").css({
          background: buttonColor,
          cursor: "pointer",
        });
        window.clearInterval(Interval);
        showMsg(res.msg, 2);
      }
    },
  });
}

function showMsg(msg, icon) {
  var shade = 0;
  if (icon) {shade = 0.01; }
  layer.msg(msg, {icon: icon, shade: shade, time: 2000});
}

function showErrorAlert(msg) {
  layer.alert(msg,{title:'出错啦！',icon:2});
}

function isMobile(mobile) {
  if (mobile.length != 11) return false;
  var regexp = /^1[3-9][0-9]{9}$/g;
  return regexp.test(mobile);
}

/**
 * 获取字符串长度,汉字+2英文+1
 * @param {string} str
 */
function getCnLen(str) {
  var len = 0;
  for (var i = 0; i < str.length; i++) {
    if (str.charCodeAt(i) > 127 || str.charCodeAt(i) == 94) {
      len += 2;
    } else {
      len++;
    }
  }
  return len;
}
