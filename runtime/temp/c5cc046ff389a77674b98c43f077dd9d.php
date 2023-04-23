<?php /*a:5:{s:73:"/Users/xingyoulin/www/ytszbds.com/application/home/view/user_ucenter.html";i:1682218924;s:67:"/Users/xingyoulin/www/ytszbds.com/application/home/view/bgbase.html";i:1682211104;s:65:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head.html";i:1649741300;s:69:"/Users/xingyoulin/www/ytszbds.com/application/home/view/head-nav.html";i:1682229520;s:67:"/Users/xingyoulin/www/ytszbds.com/application/home/view/footer.html";i:1682216409;}*/ ?>
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


<style>
.main-box{width: 100%;display: flex;flex-direction: column;min-height: 566px;
background: #F9F9F9;padding: 50px;padding-top: 40px;}
.btn-box{margin-top: 40px;}
.btn-box a:hover{color:#fff;}
.btn{width: 110px;height: 40px;line-height:40px;cursor: pointer;border-radius: 4px;background: #ed0000;font-size: 15px;color: #fff;text-align: center;float: right;}
.list-box{display:flex;padding: 0 70px;padding-bottom: 100px;
background: #FFFFFF;margin-top: 40px;}
.tblList tr{height: 86px;border-bottom: 1px solid #eee;width: 100%;}
.tblList tr .title{width:520px;padding: 0 20px 0 0;  overflow: hidden;text-overflow: ellipsis;white-space: nowrap;display: block;line-height: 86px;font-weight: bold;font-size: 18px;color: #333333;}
.tblList tr .title a{color: inherit;font-size: inherit;}
.tblList tr .subtitle{text-align: center;padding-right: 10px;padding-left: 10px;font-size: 15px;position: relative;}
.tblList tr .subtitle:before {
  content: "";
  position: absolute;
  right: 0;
  top: 50%;
  width: 1px;
  height: 21px;
  background: #CCCCCC;
     -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}
.tblList tr .subtitle:last-child:before {
  display: none;
}
.color{color:#ed0000;cursor: pointer;}
.color:hover{color:#ed0000;font-weight:bold}
.color2{color:#2690C2;cursor: pointer;}
.emptytip {font-size: 20px;color: #060500;text-align: center;}.tips1{margin-top: 100px}.tips2{margin-top: 20px}
.passed {color: #E60010;}
.m_title {font-size: 24px;
font-weight: bold;
line-height: 40px;
text-align: center;
width: 100%;
color: #333333;}

.clear {
  clear: both;
  height: 0px;
  font-size: 1px;
  line-height: 0px;
}
.tip_img {
  text-align: center;
  padding-bottom: 50px;
}
.m_tip p {text-align: center;font-size: 20px;
line-height: 40px;
color: #000000;}
.m_tip_a {text-align: center;padding-top: 60px;}
.m_tip_a a {width: 200px;display:inline-block;
height: 50px;
background: #4092db;color: #fff;
font-size: 18px;
line-height: 50px;
border-radius: 29px;}
</style>

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

<div class="main-box">
  <!-- <div class="btn-box"><a href="/enroll" class="btn fr">添加新作品</a></div> -->

  <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
    <div class="m_tip">
    <div class="tip_img"><img src="/static/images/web/tip.png" alt=""></div>
    <p>您还没有产品（作品）提交，快来申报吧<br>
（建议使用非IE核心浏览器如谷歌浏览器、QQ浏览器、搜狗浏览器、360浏览器等访问）</p>
<div class="m_tip_a"><a href="/enroll">开始申报</a></div>

</div>
    <!-- <span class="emptytip tips1">您还未申报作品，快点击右上角按钮去发布属于你的作品吧!</span>
    <span class="emptytip tips2">（建议使用非IE核心浏览器如谷歌浏览器、QQ浏览器、搜狗浏览器、360浏览器等访问）</span> -->
  <?php else: ?>
   <h3 class="m_title">我的作品</h3>
    <div class="clear"></div>
  <div class="list-box">
   
    <table class="tblList">
      <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <tr>
        <td class="title">
         
		  <?php if($vo['checkstatus1']==-1||$vo['checkstatus1']==1): ?>
			<a><?php echo htmlentities($vo['title']); ?></a>
		  
		  <?php else: ?>
		    <a href="/enroll?id=<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></a>
		  <?php endif; ?>
          <!--<?php 
          if($vo['submitto']==1){
            switch ($vo['checkstatus1']) {
              case -1:
                echo '<span style="color: #C7464D;">【资格审查被驳回】</span>';
                break;
              case 1:
                echo '<span style="color: #67C164;">【资格审查已通过】</span>';
                break;
              default:
                echo '<span style="color: #4FACDC;">【已提交】</span>';
                break;
            }
          } else {
            echo '<span style="color:#fea250;">【待提交】</span>';
          }
           ?>-->
        </td>
		  <td class="subtitle">
		 <?php 
          if($vo['submitto']==1){
            switch ($vo['checkstatus1']) {
              case -1:
                echo '<span style="color: #ed0000;">资格审查被驳回</span>';
                break;
              case 1:
                echo '<span style="color: #ed0000;">资格审查已通过</span>';
                break;
              default:
                echo '<span style="color: #ed0000;">已提交</span>';
                break;
            }
          } else {
            echo '<span style="color:#ed0000;">待提交</span>';
          }
           ?>
		</td>
        <td class="subtitle"><?php if(( $vo['zj_audit1'] == 1) OR ( $vo['gx_audit'] == 1)): ?><p class="passed">初评通过</p><?php else: ?>待初评<?php endif; ?></td>
        <?php if($isopen == 1): ?><td class="subtitle"><?php switch($vo['zj_audit2']): case "0": ?>待复评<?php break; case "1": ?><p class="passed">复评通过</p><?php break; default: ?>复评未通过<?php endswitch; ?></td><?php endif; ?>
        <td class="subtitle"><?php switch($vo['zj_audit3']): case "0": ?>待终评<?php break; case "1": ?><p class="passed">终评通过</p><?php break; default: ?>终评未通过<?php endswitch; ?></td>
        <td class="subtitle"><a class="color" href="/enroll?id=<?php echo htmlentities($vo['id']); ?>">查看作品</a></td>
         <?php if($ispdf == 1): ?><td class="subtitle"><?php if(empty($vo['pdf_upload_url']) || (($vo['pdf_upload_url'] instanceof \think\Collection || $vo['pdf_upload_url'] instanceof \think\Paginator ) && $vo['pdf_upload_url']->isEmpty())): ?><span onclick="nopdf_upload_url();">下载申报书</span><?php else: ?><a href="<?php echo htmlentities($vo['pdf_upload_url']); ?>" <?php if($vo['checkstatus1']==1): ?>class="color"<?php endif; ?> title="下载申报书" target="_blank" >下载申报书</a><?php endif; ?></td><?php endif; ?>
         <td class="subtitle">
		
		<?php if($vo['checkstatus1']==1): ?>
			<a href="javascript:void(0);" class="createCertificate color" data-id="<?php echo htmlentities($vo['id']); ?>">下载参赛证明</a>
		<?php else: ?>
			<a href="javascript:void(0);" onclick="noCertificate();" title="下载参赛证明">下载参赛证明</a>
		<?php endif; ?>
		</td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
	
  </div>
  <div class="m_tip">
   
	<div class="m_tip_a"><a href="/enroll">新增申报</a></div>
	</div>
  <?php endif; ?>
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
$('.createCertificate').click(function () {
  $.post('/home/enroll/createCertificate',{id:$(this).data('id')},function(res) {
    if(res.code == 1){
      window.open(res.data);
    }else{
      layer.msg('下载失败',{icon: 2,shade: [0.3,'#000']});
    }
  });
})

function noCertificate(){
	layer.msg('资格审查通过后即可下载参赛证明',{icon: 2,shade: [0.3,'#000']});
}
function nopdf_upload_url(){
layer.msg('资格审查通过后下载打印申报书',{icon: 2,time:5000,shade: [0.3,'#000']});
}
</script>

</body>
</html>

