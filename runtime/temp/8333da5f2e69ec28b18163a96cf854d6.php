<?php /*a:5:{s:69:"/Users/xingyoulin/www/ytszbds.com/application/home/view/user_reg.html";i:1649741300;s:67:"/Users/xingyoulin/www/ytszbds.com/application/home/view/bgbase.html";i:1682211104;s:65:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head.html";i:1649741300;s:69:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head-nav.html";i:1682229520;s:67:"/Users/xingyoulin/www/ytszbds.com/application/home/view/footer.html";i:1682216409;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head>
  <title><?php echo htmlentities($webset['name']); ?></title>
<!-- <title><?php echo htmlentities(app('config')->get('sys_name')); ?></title> -->
<title><?php echo htmlentities($webset['name']); ?></title>
<link rel="shortcut icon" type="image/x-icon" href="/static/favicon.ico"/>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<link rel="stylesheet" href="/static/plugins/layui/css/layui.css">
<link rel="stylesheet" href="/static/css/home/global.css">
<link rel="stylesheet" href="/static/css/home/swiper.min.css">
<?php if(app('request')->server('REMOTE_ADDR') != '127.0.0.1'): ?>
<script type="text/javascript">
var _hmt = _hmt || [];

(function () {
  var userAgent = window.navigator.userAgent;
  if (/windows|win32/i.test(userAgent)) {
    if (/Windows NT 5/.test(userAgent)) {
      document.writeln('<style type="text/css">body,button,input,select,textarea,code{font-family:tahoma,sans-serif}</style>');
    }
  } else if (/macintosh/i.test(userAgent)) {
    document.writeln('<style type="text/css">body,button,input,select,textarea,code{font-family: "Heiti SC","Lucida Grande","Hiragino Sans GB","Hiragino Sans GB W3",verdana;}</style>');
  }
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?322c7a85bde7e0eeaa7502257a003db5";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<?php endif; ?>


</head><body>
<!-- 	<style>
		.nav a:hover,.nav a:active{color:#fff;} 
	</style> -->
<div class="header">
  <div class="header-box">
  	<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'wlogo' && $v['cateid'] == 11): ?>
    <div class="logo-box"><img width="277" src="/static/images/logo2.jpg" alt="<?php echo htmlentities(app('config')->get('sys_name')); ?>"></div>
    <?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="nav">
  <ul>
    <?php $k = 1;if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($k<3): ?>
    <li><a href="/<?php echo htmlentities($vo['ftitle']); ?>"><?php echo htmlentities($vo['title']); ?></a></li>
    <?php endif; $k++;?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
<!--	<li><a target="_blank" href="http://www.sdgcup-id.com/enroll">省长杯申报</a></li>-->
	
  </ul>
</div>
<div class="usercenter">
  <ul>
    <?php if(app('cookie')->get('uid') != null): ?>
    <li style="min-width: 60px;"><a href="/ucenter">账户中心</a></li>
    <li style="min-width: 30px;"><a href="/logout">退出</a></li>
    <?php else: ?>
    <li style="min-width: 30px;"><a href="/login">登录</a></li>
    <li style="min-width: 30px;"><a href="/reg">注册</a></li>
    <?php endif; ?>
    <li><img src="/static/images/web/my.png" alt="账户中心"></li>
  </ul>
</div>

  </div> 
</div>
<div class="main">

<div class="usertool-box reg-box reg_bg">
<!--   <div class="img-box"><img src="/static/images/web/reg-bg.jpg" alt=""></div>
 -->  <div class="form-box">
   <h3 style="color:#333333">注册</h3>
    <form class="layui-form" onsubmit="return false">
      <input type="hidden" name="action" value="register">
      <div class="form-group">
        <i class="layui-icon layui-icon-cellphone"></i>
        <div class="splitter"></div>
        <input type="text" maxlength="11" placeholder="填写手机号" name="mobile" class="form-control" lay-verify="phone" onkeyup="value=value.replace(/[^\d]/g,'')">
      </div>
      <div class="form-group">
        <i class="layui-icon layui-icon-vercode"></i>
        <div class="splitter"></div>
        <input type="text" placeholder="输入短信验证码" name="smscode" class="form-control" maxlength="4" lay-verify="required|number" onkeyup="value=value.replace(/[^\d]/g,'')">
        <button class="smscode-button" >发送短信验证码</button>
      </div>
      <div class="form-group">
        <i class="layui-icon layui-icon-key"></i>
        <div class="splitter"></div>
        <input type="password" placeholder="设置密码" name="password" class="form-control" maxlength="20" lay-verify="required">
      </div>
      <div class="form-group">
        <i class="layui-icon layui-icon-password"></i>
        <div class="splitter"></div>
        <input type="password" placeholder="确认密码" name="confirmpwd" class="form-control" maxlength="20" lay-verify="required">
      </div>
      <div class="form-submit"><button class="layui-btn" lay-submit lay-filter="smtReg">注册</button></div>
    </form>
  </div>
</div>

</div>
<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['ftitle'] == 'dbxx' && $vo['cateid'] == '10'): ?>
    <!-- <?php echo $vo['content']; ?>
     -->
     <div class="footer">
  <div class="mfoot_l">
    <div class="mfoot_logo"><img src="/static/images/logo3.jpg" alt="" width="179"></div>
    <div class="mfoot_img"><img  src="<?php echo htmlentities($webset['erweima_one']); ?>" width="80" height="80"><!--<img  src="<?php echo htmlentities($webset['erweima_two']); ?>" width="80" height="80">--></div>
	<br/>
	 <p class="beian" style="text-align:center;"><a style="color:#FFFFFF" href="https://beian.miit.gov.cn/" target="_blank"><?php echo htmlentities($webset['beian']); ?></a></p>
  </div>
  <div class="mfoot_m">
      <div class="mfoot_m_cont m_one">
        <div class="left">
          <strong>主办单位：</strong>
          <span><?php echo htmlentities($webset['host']); ?></span>
        </div>
<!--        <div class="right">-->
<!--          <strong>支持单位：</strong>-->
<!--          <span><?php echo htmlentities($webset['support']); ?></span>-->
<!--        </div>-->
        <div class="clear"></div>
      </div>
      <div class="mfoot_m_cont m_two">
        <div class="left">
          <strong>支持单位：</strong>
<!--          <div class="mfoot_list">-->
<!--		  <?php if(is_array($webset['undertake']) || $webset['undertake'] instanceof \think\Collection || $webset['undertake'] instanceof \think\Paginator): if( count($webset['undertake'])==0 ) : echo "" ;else: foreach($webset['undertake'] as $key=>$vo): ?>-->
<!--		  <?php if($key%2==0): ?>-->
<!--          <span style="display:block;"><?php echo htmlentities($vo); ?></span>-->
<!--		  <?php endif; ?>-->
<!--		  <?php endforeach; endif; else: echo "" ;endif; ?>-->

<!--          </div>-->
            <span><?php echo htmlentities($webset['support']); ?></span>
        </div>
        <div class="right">
		 <?php if(is_array($webset['undertake']) || $webset['undertake'] instanceof \think\Collection || $webset['undertake'] instanceof \think\Paginator): if( count($webset['undertake'])==0 ) : echo "" ;else: foreach($webset['undertake'] as $key=>$vo): if($key%2==1): ?>
          <span style="display:block;"><?php echo htmlentities($vo); ?></span>
		  <?php endif; ?>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
          
        </div>
        <div class="clear"></div>
      </div>
      <div class="mfoot_m_cont">
          <strong>承办单位：</strong>
          <?php if(is_array($webset['xieban']) || $webset['xieban'] instanceof \think\Collection || $webset['xieban'] instanceof \think\Paginator): if( count($webset['xieban'])==0 ) : echo "" ;else: foreach($webset['xieban'] as $key=>$vo): if($key==0): ?>
          <p><span></span><?php echo htmlentities($vo); ?></p>
          <?php else: ?>
          <p><span>&nbsp;</span><?php echo htmlentities($vo); ?></p>
          <?php endif; ?>
          <?php endforeach; endif; else: echo "" ;endif; ?>


<!--          < div class="">-->
<!--          <strong>承办单位：</strong>-->

<!--&lt;!&ndash;		   <?php if(is_array($webset['xieban']) || $webset['xieban'] instanceof \think\Collection || $webset['xieban'] instanceof \think\Paginator): if( count($webset['xieban'])==0 ) : echo "" ;else: foreach($webset['xieban'] as $key=>$vo): ?>&ndash;&gt;-->
<!--&lt;!&ndash;		  <?php if($key==0): ?>&ndash;&gt;-->
<!--&lt;!&ndash;          <span><?php echo htmlentities($vo); ?></span>&ndash;&gt;-->
<!--&lt;!&ndash;		  <?php endif; ?>&ndash;&gt;-->
<!--&lt;!&ndash;		    <?php endforeach; endif; else: echo "" ;endif; ?>&ndash;&gt;-->
<!--        </div>-->


<!--        <div class="right">-->
<!--		 <?php if(is_array($webset['xieban']) || $webset['xieban'] instanceof \think\Collection || $webset['xieban'] instanceof \think\Paginator): if( count($webset['xieban'])==0 ) : echo "" ;else: foreach($webset['xieban'] as $key=>$vo): ?>-->
<!--		  <?php if($key>0): ?>-->
<!--          <span>山东省工业设计协会</span>-->
<!--		  <?php endif; ?>-->
<!--		  <?php endforeach; endif; else: echo "" ;endif; ?>-->
<!--        </div>-->
        <div class="clear"></div>
      </div>
  </div>
  <div class="mfoot_r">
    <strong><?php echo htmlentities($webset['zuwei']); ?></strong>
    <div class="height170">
    <p><span>联&nbsp;&nbsp;系&nbsp;&nbsp;人：</span><?php echo htmlentities($webset['contacts']); ?></p>
	<p>王  晨     焦玉杰</p>
	<?php if(is_array($webset['tel']) || $webset['tel'] instanceof \think\Collection || $webset['tel'] instanceof \think\Paginator): if( count($webset['tel'])==0 ) : echo "" ;else: foreach($webset['tel'] as $key=>$vo): if($key==0): ?>
    <p><span>电 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</span><?php echo htmlentities($vo); ?></p>
	<?php else: ?>
	<p><span>&nbsp;</span><?php echo htmlentities($vo); ?></p>
	<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
    
   <!-- <p><span>微&nbsp;&nbsp;信&nbsp;&nbsp;号：</span><?php echo htmlentities($webset['weixin']); ?></p>-->
    <p><span>邮 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</span><?php echo htmlentities($webset['email']); ?></p>
	 <p><span>邮寄地址：</span>烟台市高新区科技大道69号创业大厦</p>
    </div>
   
  </div>

  <?php endif; ?>

<?php endforeach; endif; else: echo "" ;endif; ?>
<script src="/static/plugins/layui/layui.all.js"></script>
<script>
var $=layui.$,form=layui.form,upload=layui.upload,layer=layui.layer,laydate=layui.laydate,upload = layui.upload;;
//顶部导航栏不同模块增加style
var headerNavLinks = $('.nav li a');
var headerUserCenterLinksImg = $('.usercenter li');
var headerUserCenterLinks = $('.usercenter li a');
var cookie = <?php echo json_encode(app('cookie')->get('uid')); ?>;
switch (window.location.pathname) {
  case '/index':
    headerNavLinks.eq(0).css('color','#e50013')
    break;
  case '/news':
    headerNavLinks.eq(1).css('color','#e50013')
    break;
  case '/view':
    headerNavLinks.eq(1).css('color','#e50013')
    break;
  case '/enroll':
    headerNavLinks.eq(2).css('color','#e50013');
    //headerUserCenterLinks.eq(0).css('color','#fff')
    //headerUserCenterLinks.eq(1).css('color','#fff')
    //if(cookie){headerUserCenterLinksImg.eq(1).find('img').attr('src','/static/images/web/my-white.png')}
   // headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  case '/enroll_agreement':
    headerNavLinks.eq(2).css('color','#e50013');
    //headerUserCenterLinks.eq(0).css('color','#fff')
    //headerUserCenterLinks.eq(1).css('color','#fff')
//if(cookie){headerUserCenterLinksImg.eq(1).find('img').attr('src','/static/images/web/my-white.png')}
   // headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  case '/login':
    headerUserCenterLinks.eq(0).addClass('active');
  //  headerUserCenterLinks.eq(1).css('color','#fff')
  //  headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  case '/reg':
   // headerUserCenterLinks.eq(0).css('color','#fff')
    headerUserCenterLinks.eq(1).addClass('active');
    //headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  case '/forgetpwd':
    //headerUserCenterLinks.eq(0).css('color','#fff')
    headerUserCenterLinks.eq(1).addClass('active');
//headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  case '/ucenter':
    headerUserCenterLinks.eq(0).addClass('active');
    //if(cookie){headerUserCenterLinksImg.eq(1).find('img').attr('src','/static/images/web/my-white.png')}
  //  headerUserCenterLinks.eq(1).css('color','#fff');
  //  headerUserCenterLinksImg.eq(2).find('img').attr('src','/static/images/web/my-white.png')
    break;
  default:
    headerNavLinks.eq(0).css('color','#e50013')
    break;
}

// function temporary() {
//   layer.alert('尚未开放,请耐心等待:)',{title:'提示'})
// }
</script>
<script src="/static/js/web/common.js"></script>



<script>
form.on('submit(smtReg)',function (data) {
  $.post('/reg',data.field,function (res) {
    if (res.code!=1) {
      return layer.alert(res.msg?res.msg:'注册出错啦！');
    }
    layer.msg('恭喜，注册成功！请使用注册使用的手机号密码登录');
    setTimeout(function() {top.location.href = '/login'}, 5000);
  })
  return false;
});
</script>

</body>
</html>

