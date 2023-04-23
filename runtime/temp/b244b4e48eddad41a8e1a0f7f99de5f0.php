<?php /*a:5:{s:72:"/Users/xingyoulin/www/ytszbds.com/application/home/view/index_index.html";i:1682230174;s:65:"/Users/xingyoulin/www/ytszbds.com/application/home/view/base.html";i:1682229258;s:65:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head.html";i:1649741300;s:69:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head-nav.html";i:1682229520;s:67:"/Users/xingyoulin/www/ytszbds.com/application/home/view/footer.html";i:1682216409;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head>
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



<style>

  h1{font-size: 29px;color: #060500;text-align: center;font-weight: bold;}

  h2{font-size: 20px;color: #9fa0a0;text-align: center;}

  .contest-intro{margin-top: 50px;}

  .intro-box{font-size: 16px;color: #221815;line-height: 30px;font-weight: 550;margin: 36px 215px 78px 215px;}

  .intro-box p{text-indent:2em}

  .schedule-img-box{background:url(/static/images/web/zuopinzhengji.jpg);height: 172px;width:942px;position: relative;margin: 45px 219px 82px 219px;}

  .schedule-img-box span{font-size: 13px;color: #fff;}

  .schedule-img-box span:first-child{position: absolute;top: 149px;left: 73px;}

  .schedule-img-box span:nth-child(2){position: absolute;top: 149px;left: 298px;}

  .schedule-img-box span:nth-child(3){position: absolute;top: 149px;left: 527px;}

  .schedule-img-box span:nth-child(4){position: absolute;top: 149px;left: 788px;}

  .category-box{display: flex;align-items: flex-start;flex-wrap:wrap;margin: 40px 219px 93px 214px;}

  .category-box div{width: 32.8%;height: 41px;border-radius: 10.63px;background: #4092db; font-size: 16px;color: #fff;display: flex;justify-content: center;align-items: center;margin: 5px 0px 0px 5px;}

  .procedure-box{background:url(/static/images/web/procedure.jpg);height: 257px;width: 944px;margin: 45px 219px 88px 219px;}

  .criteria-box{background:url(/static/images/web/index_psbz_text.jpg);height: 443px;width: 943px;margin: 45px 219px 88px 219px;position: relative;}

  .prizes-box{margin: 45px 215px 82px 205px;position: relative;}

  .prizes-box img{padding-left: 5px;}

  .prizes-box span:nth-child(6){position: absolute;top: 95px;left: 79px;font-size: 16px;color: #fff;letter-spacing:2px;}

  .prizes-box span:nth-child(7){position: absolute;top: 118px;left: 82px;font-size: 13px;color: #fff;}

  .prizes-box span:nth-child(8){position: absolute;top: 145px;left: 13px;font-size: 12px;color: #fff;}

  .prizes-box span:nth-child(9){position: absolute;top: 95px;left: 270px;font-size: 16px;color: #fff;letter-spacing:2px;}

  .prizes-box span:nth-child(10){position: absolute;top: 118px;left: 273px;font-size: 13px;color: #fff;}

  .prizes-box span:nth-child(11){position: absolute;top: 95px;left: 460px;font-size: 16px;color: #fff;letter-spacing:2px;}

  .prizes-box span:nth-child(12){position: absolute;top: 118px;left: 463px;font-size: 13px;color: #fff;}

  .prizes-box span:nth-child(13){position: absolute;top: 95px;left: 643px;font-size: 16px;color: #fff;letter-spacing:2px;}

  .prizes-box span:nth-child(14){position: absolute;top: 118px;left: 657px;font-size: 13px;color: #fff;}

  .prizes-box span:nth-child(15){position: absolute;top: 145px;left: 605px;font-size: 12px;color: #fff;}

  .prizes-box span:nth-child(16){position: absolute;top: 95px;left: 815px;font-size: 16px;color: #fff;letter-spacing:2px;}

  .prizes-box span:nth-child(17){position: absolute;top: 118px;left: 832px;font-size: 13px;color: #fff;}

  .prizes-box span:nth-child(18){position: absolute;top: 145px;left: 778px;font-size: 12px;color: #fff;}

</style>


</head>
<body>
<div class="header">
  <div class="header-box">
  	<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'logo' && $v['cateid'] == 11): ?>
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
<script src="/static/js/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css">
  .index_ban  { width: 1380px;height: 425px;margin: 0 auto;}
  .ban-swiper {
   width: 100%;
   height: 100%;
  }
  .ban-swiper .ban_pc {
    width: 100%;
    height: 100%;
  }
  .ban-swiper .ban-pagination .swiper-pagination-bullet {
  background-color: #B10B1B;
  opacity: 1;
  margin: 0 5px;
  width: 10px;
  height: 10px;
}
.ban-swiper .ban-pagination .swiper-pagination-bullet-active {background: #fff;}

</style>


<div class="index_ban">
  <div class="swiper-container ban-swiper">
      <div class="swiper-wrapper">
	  <?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'banner' && $v['cateid'] == 1): ?>
		
		<div class="swiper-slide">
            <a href="<?php echo htmlentities($v['eng']); ?>">
            <div class="ban_pc" style="background-image: url(<?php echo htmlentities($v['pic']); ?>);">
            </div>
         
            </a>
        </div>
		<?php endif; ?>
		<?php endforeach; endif; else: echo "" ;endif; ?>
        
       
        
      </div>
      <div class="swiper-pagination ban-pagination"></div>
  </div>
  </div>
<div class="main">


<div class="contest-intro">

  <?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'dsjj' && $v['cateid'] == '1'): ?>

    <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

    <h2><?php echo htmlentities($v['eng']); ?></h2>

    <div class="intro-box">

        <?php echo $v['content']; ?>

    </div>

  <?php endif; ?>

  <?php endforeach; endif; else: echo "" ;endif; ?>

</div>

<div class="contest-schedule">

  <?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'dsrc' && $v['cateid'] == '1'): ?>

  <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

  <h2><?php echo htmlentities($v['eng']); ?></h2>

  <div class="schedule-img-box">

      <?php echo $v['content']; ?>

    <span></span>

  </div>

  <?php endif; ?>

  <?php endforeach; endif; else: echo "" ;endif; ?>

</div>

<div class="declaration-category">

  <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'GATEGORY'): ?>

  <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

  <h2><?php echo htmlentities($v['ftitle']); ?></h2>

  <?php endif; ?>

  <?php endforeach; endif; else: echo "" ;endif; ?>

  <div class="category-box">

    <?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['cateid'] == '9'): ?>

    <div><?php echo htmlentities($v['title']); ?></div>

    <?php endif; ?>

    <?php endforeach; endif; else: echo "" ;endif; ?>

  </div>

</div>

<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

<div class="declaration-procedure">

  <?php if($v['cateid'] == 1 && $v['ftitle'] == 'sblc'): ?>

  <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

  <h2><?php echo htmlentities($v['eng']); ?></h2>

  <div class="procedure-box" style="background: url(<?php echo htmlentities($v['pic']); ?>);">

  </div>

  <?php endif; ?>

</div>

<?php endforeach; endif; else: echo "" ;endif; if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

<div class="evaluation-criteria">

  <?php if($v['cateid'] == 1 && $v['ftitle'] == 'psbz'): ?>

  <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

  <h2><?php echo htmlentities($v['eng']); ?></h2>

  <div class="criteria-box" style="background: url(<?php echo htmlentities($v['pic']); ?>);"></div>

  <?php endif; ?>

</div>

<?php endforeach; endif; else: echo "" ;endif; if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

<div class="prizes-set-up">

  <?php if($v['cateid'] == 1 && $v['ftitle'] == 'jxzz'): ?>

  <h1 class="mgb"><?php echo htmlentities($v['title']); ?></h1>

  <h2><?php echo htmlentities($v['eng']); ?></h2>

  <?php echo $v['content']; ?>

  <?php endif; ?>

</div>

<?php endforeach; endif; else: echo "" ;endif; ?>


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



<script type="text/javascript">
var banSwiper = new Swiper(".ban-swiper", {
speed:600,  
loop:true,
pagination: {
  el: ".ban-pagination",
  clickable: true,
},
autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
          },
});
</script>

</body>
</html>
