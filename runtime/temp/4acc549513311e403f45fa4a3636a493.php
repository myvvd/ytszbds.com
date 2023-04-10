<?php /*a:5:{s:65:"/Users/xingyoulin/www/szb/application/home/view/enroll_index.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/home/view/bgbase.html";i:1649741300;s:57:"/Users/xingyoulin/www/szb/application/home/view/head.html";i:1649741300;s:61:"/Users/xingyoulin/www/szb/application/home/view/head-nav.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/home/view/footer.html";i:1649741300;}*/ ?>
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
.post-content {background: #EFEFEF;padding-top: 50px;min-height: 780px;display: flex;flex-direction: column;align-items: center;}
.page-tip-bar{background-color:#FBFCC5;color: red;border: 1px solid #FFCC66;padding: 2px;margin: 5px 0;width: 1260px;display: none;}
.page-tip-bar span{padding-left: 30px;}
#frmPost {width: 1260px;background: #fff;margin-bottom: 40px;}
#frmPost h1{font-size: 26px;color: #000;margin:50px 0 5px 30px;}
#frmPost hr{width: 1200px;display: block;margin: 0 auto;}
#frmPost div {display: flex;align-items: center;}
#frmPost div span {display: flex;margin: 21px 30px 16px 200px;width: 200px;justify-content: flex-end;}
#frmPost div span p{text-align: right;}
#frmPost div span p:nth-child(1) {font-size: 16px;color: #3e3a39;font-weight: bold;}
#frmPost div span p:nth-child(2) {font-size: 22px;color: #ed0000;margin: 5px 12px 0 0;}
#frmPost div span p:nth-child(3) {font-size: 18px;color: #3e3a39;font-weight: bold;}
#frmPost input,#frmPost select{height: 46px;padding-left: 16px;border: 1px solid #e6e6e6;border-radius: 5px;}
#frmPost select{font-size: 16px;color: #3e3a39;}
#frmPost .shortinput-box input,select{width: 240px;}
#frmPost .middleinput-box input{width: 330px;}
#frmPost .longinput-box input,textarea{width: 610px;}
#frmPost .longinput-box textarea{height: 226px;border-radius: 5px;}
#frmPost .moreinfo-box textarea {width: 500px;height: 230px;resize: vertical;padding: 16px 0 0 16px;font-size: 16px;color: #333;border: 1px solid #e6e6e6;}
#frmPost .moreinfo-box span {margin-top: -150px;}
.profile-box{display: flex;flex-direction: column;align-items: flex-start !important;}
.msg{font-size: 16px;color: #3e3a39;margin-top: 5px;}
.photo-box{display: flex;flex-direction: column;align-items: flex-start !important;margin:25px 0 37px 0;}
.photo-box input{height:25px!important;padding-left: 0px!important;border: none!important;border-radius: 0px!important;margin-bottom: 15px;}
.photo-box .img-box div{width:115px;height:115px;border-radius: 5px;background: #EDEEF0;display: flex;justify-content: center;}
.photo-box .img-box div i{font-size: 35px;}
.photo-box .img-box text{margin-left:5px;font-size: 16px;cursor:pointer}
.textarea{padding: 10px 10px;}.textarea::-webkit-input-placeholder {font-size: 16px;color: #ababab;}
.privacy-policy{display: flex;justify-content: center;margin-left: -40px;}
.privacy-policy text,.privacy-policy text a{font-size: 16px;color: #1f1f1f;}
.layui-form-checkbox{height: 20px;line-height: 20px;margin-right: 5px;}
.layui-form-checkbox i{border-left: 1px solid #d2d2d2;width: 20px;height: 18px;}
#frmPost .btn-box{display: flex;justify-content: center;margin:40px 0 10px -170px;}
#frmPost .btn-box button{width:75px;height: 35px;cursor: pointer;border-radius: 4px;background: #ed0000;font-size: 16px;color: #fff;border: 0;}
#frmPost .btnPost {margin-left: 80px;}
.imgPreview{width: 100%;height: 100%;}
.layui-input-block{margin-left: 0px;}
.layui-form-checkbox i{height: 20px;}
.layui-btn{width: 77px;height: 22px;line-height: 20px;border-radius: 5px;background: #fff;color: #000;border: 1px solid #ababab;padding: 0px;margin-bottom: 15px;}
.upload-tip{margin: -20px 0 16px 100px;width: 500px;justify-content: start;font-size: 14px;color: #636363;}
.layui-form-radio *{font-size: 15px;color: #3e3a39;}
.upload:hover{color: #000;}
.tip{margin-left: 430px;}
.tip i{padding-right: 5px;color: #ed0000;}
</style>

</head><body>
<!-- 	<style>
		.nav a:hover,.nav a:active{color:#fff;} 
	</style> -->
<div class="header">
  <div class="header-box">
  	<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['ftitle'] == 'wlogo' && $v['cateid'] == 11): ?>
    <div class="logo-box"><img width="277" src="/static/images/logo.svg" alt="<?php echo htmlentities(app('config')->get('sys_name')); ?>"></div>
    <?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="nav">
  <ul>
    <?php $k = 1;if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($k<4): ?>
    <li><a href="/<?php echo htmlentities($vo['ftitle']); ?>"><?php echo htmlentities($vo['title']); ?></a></li>
    <?php endif; $k++;?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
	<li><a target="_blank" href="http://www.sdgcup-id.com/enroll">省长杯申报</a></li>
	
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

<div class="post-content">
  <div class="page-tip-bar"><span></span></div>
  <form id="frmPost" class="layui-form" lay-filter="frmPost" onsubmit="return false">
    <h1>基本情况</h1><hr>
    <input type="hidden" name="id">
    <input type="hidden" name="uid" value="<?php echo htmlentities(app('cookie')->get('uid')); ?>">
    <input type="hidden" name="workcode">
    <div class="shortinput-box layui-form-item" style="margin-top:15px;">
      <span><p>所属地区</p><p>*</p><p>:</p></span>
      <select name="city" id="city" lay-reqText="请选择地区">
        <option value="">请选择地区</option>
        <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
    <!-- <div class="longinput-box layui-form-item"> -->
      <div class="longinput-box">
      <span><p>产品（作品）名称</p><p>*</p><p>:</p></span>
      <!-- <a href="">lay-verify="required" lay-reqText="请填写作品名称"</a> -->
      <input type="text" name="title" id="works_title" autocomplete="off"  placeholder="" maxlength="100">
    </div>
    <div class="longinput-box">
      <span><p>推荐单位</p><p></p><p>:</p></span>
      <input type="text" name="commend_company" autocomplete="off" id="commend_company" maxlength="50" placeholder="请企事业单位、院校、设计机构、社会团体填写，个人不填">
    </div>
    <div class="layui-form-item">
      <span style="margin-top: -10px;"><p>参赛对象</p><p>*</p><p>:</p></span>
      <div class="layui-input-block" style="width: 500px;display: flex;flex-wrap: wrap;">
        <?php $k = 1;if(is_array($duix) || $duix instanceof \think\Collection || $duix instanceof \think\Paginator): $i = 0; $__LIST__ = $duix;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="ischeck" style="width: 195px;"><input type="radio" name="contestants" value="<?php echo htmlentities($vo['id']); ?>" <?php if($k == 1): ?>checked<?php endif; ?> lay-verify="otherReq" title="<?php echo htmlentities($vo['title']); ?>"></div>
        <input type="hidden" name="contestants1" value="<?php echo htmlentities($vo['id']); ?>">
        <?php $k++;?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
    <div class="layui-form-item">
      <span><p>大赛组别</p><p>*</p><p>:</p></span>
      <?php $k = 1;if(is_array($zubie) || $zubie instanceof \think\Collection || $zubie instanceof \think\Paginator): $i = 0; $__LIST__ = $zubie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
      <div style="width: 105px;"><input type="radio" name="declaration_group" value="<?php echo htmlentities($v['id']); ?>" <?php if($k == 1): ?>checked<?php endif; ?> lay-verify="otherReq" title="<?php echo htmlentities($v['title']); ?>"></div>
      <input type="hidden" name="contestants1" value="<?php echo htmlentities($vo['id']); ?>">
      <?php $k++;?>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="layui-form-item">
      <span style="margin-top: -75px;"><p>行业领域</p><p>*</p><p>:</p></span>
      <div class="layui-input-block" style="width: 640px;display: flex;flex-wrap: wrap;" id="works_category">
        <?php $k = 1;if(is_array($shenb) || $shenb instanceof \think\Collection || $shenb instanceof \think\Paginator): $i = 0; $__LIST__ = $shenb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <div style="<?php if($v['id']==54): ?>width: 320px;<?php else: ?>width: 215px;<?php endif; ?>"><input type="radio" name="works_category" value="<?php echo htmlentities($v['id']); ?>" <?php if($k == 1): ?>checked<?php endif; ?> lay-verify="otherReq" title="<?php echo htmlentities($v['title']); ?>"></div>
        <?php $k++;?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        
      </div>
    </div>
	<div class="middleinput-box d-show">
      <span><p>单位社会信用代码</p><p></p><p>:</p></span>
      <input type="text" name="credit_code" id="credit_code" autocomplete="off"  placeholder="个人无需填写此项" maxlength="50">
    </div>
    <div class="middleinput-box">
      <span><p>申报单位/个人</p><p>*</p><p>:</p></span>
      <input type="text" name="name" id="name" autocomplete="off" lay-reqText="请填写申报单位名称、院校名称或个人姓名" placeholder="请填写申报单位名称、院校名称或个人姓名" maxlength="50">
    </div>
	

    <div class="longinput-box">
      <span><p>地址</p><p>*</p><p>:</p></span>
      <input type="text" name="address" id="address" autocomplete="off" lay-reqText="请填写地址" placeholder="请填写地址" maxlength="30">
    </div>
    <div class="shortinput-box">
      <span><p>邮编</p><p>*</p><p>:</p></span>
      <input type="text" name="zipcode" id="zipcode" autocomplete="off" lay-reqText="请填写邮编" placeholder="请填写邮编" maxlength="6">
    </div>
    <div class="middleinput-box">
      <span><p>主创设计者姓名</p><p>*</p><p>:</p></span>
      <input type="text" name="creator_designer" id="creator_designer" autocomplete="off" lay-reqText="请填写主创设计者姓名" placeholder="请填写主创设计者姓名" maxlength="20">
    </div>
      <div class="middleinput-box">
      <span><p>主创身份证号</p><p>*</p><p>:</p></span>
      <input type="text" name="creator_idcard" id="creator_idcard" lay-verify="required|identity" autocomplete="off" lay-reqText="请填写主创身份证号" placeholder="请填写主创身份证号" maxlength="18">
    </div>
     <div class="middleinput-box">
      <span><p>主创护照</p><p></p><p>:</p></span>
      <input type="text" name="creator_hz" id="creator_hz" autocomplete="off" placeholder="请填写主创护照" maxlength="18">
    </div>
    <div class="middleinput-box">
      <span><p>主创电话/手机</p><p>*</p><p>:</p></span>
      <input type="text" name="creator_tel" id="creator_tel" autocomplete="off" lay-reqText="请填写主创电话/手机" placeholder="请填写主创电话/手机" maxlength="30">
    </div>
    <div class="middleinput-box">
      <span><p>主创邮箱</p><p>*</p><p>:</p></span>
      <input type="text" name="creator_email" id="creator_email" autocomplete="off" lay-reqText="请填写主创邮箱" placeholder="请填写主创邮箱" maxlength="50">
    </div>
    <!-- <div class="longinput-box"> -->
      <div class="longinput-box">
      <span><p>团队成员</p><p></p><p>:</p></span> 
      
      <input type="text" name="team_member" id="team_member" autocomplete="off" placeholder="请填写团队成员">
      <!-- <input type="text" name="team_member" id="team_member" autocomplete="off" lay-reqText="请填写团队成员" placeholder="请填写团队成员"> -->
    </div>
    <div class="middleinput-box">
      <span><p>联系人姓名</p><p>*</p><p>:</p></span>
      <input type="text" name="contact_person" id="contact_person" autocomplete="off" lay-reqText="请填写联系人姓名" placeholder="请填写联系人姓名">
    </div>
    <div class="middleinput-box">
      <span><p>联系人电话/手机</p><p>*</p><p>:</p></span>
      <input type="text" name="contact_tel" id="contact_tel" autocomplete="off" lay-reqText="请填写联系人电话/手机" placeholder="请填写联系人电话/手机">
    </div>
    <div class="middleinput-box">
      <span><p>联系人邮箱</p><p>*</p><p>:</p></span>
      <input type="text" name="contact_email" id="contact_email" autocomplete="off" lay-reqText="请填写联系人邮箱" placeholder="请填写联系人邮箱">
    </div>
    <h1>单位/个人简介</h1><hr>
    <div class="longinput-box" style="margin-top: 25px;">
      <span style="margin-top: -195px;"><p>单位或主创人简介</p><p>*</p><p>:</p></span>
      <div class="profile-box">
        <div><textarea name="works_profile" id="works_profile" minlength="100" maxlength="300" onchange="this.value=this.value.substring(0, 300)" onkeydown="this.value=this.value.substring(0, 300)" onkeyup="this.value=this.value.substring(0, 300)" class="textarea" autocomplete="off" lay-reqText="请填写单位/个人简介"></textarea></div>
        <div class="msg">（字数限制在100-300字）</div>
      </div>
    </div>
    <h1>验证材料</h1>
    <hr>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;">
        <p>营业执照</p>
        <p></p>
        <p>:</p>
      </span>
    
	 
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload" id="btnValidationA">选取文件</button>
        <input type="hidden" name="validation_a" accept="image/*" data-name="validation_a">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（企事业单位、院校、设计机构、社会团体必填,建议上传jpg/png图片格式，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>身份证</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnValidationB">选取文件</button>
        <input type="hidden" name="validation_b" accept="image/*" lay-reqText="请上传身份证照片" data-name="validation_b">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（请上传身份证正反面信息，建议上传jpg/png图片格式，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>教师工作证、学生证</p><p></p><p>:</p></span>
      

      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnValidationC">选取文件</button>
        <input type="hidden" name="validation_c" accept="image/*" data-name="validation_c">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（教师、学生必填,建议上传jpg/png图片格式，大小在5MB以内）</div>
      </div>
    </div>
    <h1>产品（作品）情况</h1>
    <hr>
    <div class="middleinput-box">
      <span><p>上市或完成日期</p><p>*</p><p>:</p></span>
      <input type="text" name="completion_date" id="completion_date" autocomplete="off" class="layui-input" value="2020-01-01" lay-reqText="请填写作品完成日期" readonly>
    </div>
    <div class="layui-form-item">
      <span><p>版权登记</p><p>*</p><p>:</p></span>
      <div style="width: 65px;"><input type="radio" name="copyright" value="0" checked lay-verify="otherReq" title="是"></div>
      <div style="width: 65px;"><input type="radio" name="copyright" value="1" lay-verify="otherReq" title="否"></div>
    </div>
	
	<div class="layui-form-item">
      <span><p>所有权</p><p>*</p><p>:</p></span>
      <div style="width: 80px;"><input type="radio" name="suoyouquan" value="0" checked lay-verify="otherReq" title="单位"></div>
      <div style="width: 80px;"><input type="radio" name="suoyouquan" value="1" lay-verify="otherReq" title="个人"></div>
    </div>
    <style>
			
		.dx_{
			
		}
		.dx_:after{
			content:'';
			clear:both;
			display:block;
		}
		.dx_>div{
			float:left;
			width:100px;
			margin-right:100px!important;
			justify-content:flex-start!important;
		}
		.dx_>div span{
			margin:0!important;
		}
		.layui-form-checked[lay-skin=primary] i {
    border-color: #ed0000!important;
    background-color: #ed0000;
    color: #fff;
}
	</style>
    <div class="layui-form-item" id="dw">
      <span><p>申请专利</p><p>*</p><p>:</p></span>
	  <div class="dx_">
		<input type="checkbox" name="patent0" value="0" lay-skin="primary" title="发明">
		<input type="checkbox" name="patent1" value="1"  lay-skin="primary" title="实用新型" >
		<input type="checkbox" name="patent2" value="2" lay-skin="primary" title="外观设计">
		<input type="checkbox" name="patent3" value="3"  lay-skin="primary" title="无">
		
	  </div>
      <!--<div style="width: 80px;"><input type="radio" name="patent[]" value="0" checked lay-verify="otherReq" title="发明"></div>
      <div style="width: 120px;"><input type="radio" name="patent" value="1" lay-verify="otherReq" title="实用新型"></div>
      <div style="width: 120px;"><input type="radio" name="patent" value="2" lay-verify="otherReq" title="外观设计"></div>
      <div style="width: 65px;"><input type="radio" name="patent" value="3" lay-verify="otherReq" title="无"></div>-->
    </div>
  
	<div class="middleinput-box">
      <span><p>尺寸</p><p>*</p><p>:</p></span>
      <input type="text" name="gsize" id="gsize" autocomplete="off" class="layui-input" lay-reqText="请填写作品尺寸">
	  <div class="msg">（长mm * 宽mm * 高mm,如：300*500*600）</div>
    </div>
    <!-- <div class="layui-form-item">
      <span><p>所有权</p><p>*</p><p>:</p></span>
      <div style="width: 80px;"><input type="radio" name="proprietary_rights" checked value="0" lay-verify="otherReq" title="单位"></div>
      <div style="width: 80px;"><input type="radio" name="proprietary_rights" value="1" lay-verify="otherReq" title="个人"></div>
    </div> -->
    <div class="longinput-box" style="margin-top: 25px;">
      <span style="margin-top: -195px;"><p>产品（作品）说明</p><p>*</p><p>:</p></span>
      <div class="profile-box">
        <div><textarea name="works_description" id="works_description" maxlength="400" onchange="this.value=this.value.substring(0, 400)" onkeydown="this.value=this.value.substring(0, 400)" onkeyup="this.value=this.value.substring(0, 400)" placeholder="请从产品（作品）先导性、创新性、实用性、美学效果、体验感、品质、环保性、经济性等方面说明。" class="textarea"></textarea></div>
        <div class="msg">（字数限制在200~400字以内，包含标点符号）</div>
      </div>
    </div>
    <br>
    <div class="enrollImg-box">
      <span style="margin-top: -20px;"><p>相关资料</p><p>*</p><p>:</p></span>
      <div class="photo-box" style="margin: 0px;">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnrelevantData">选取文件</button>
        <input type="hidden" type="file" name="relevant_data" accept="application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" lay-reqText="请上传作品相关资料" data-name="relevant_data">
        <div class="msg">（上传一份PPT或PDF文件，20MB以内，可包含专利/获奖证明/作品介绍）</div>
      </div>
    </div>
    <h1>产品(作品)图片</h1>
    <hr>
<div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>整体效果图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic1">选取文件</button>
        <input type="hidden" name="work_pic1" accept="image/*" data-name="work_pic1" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>主视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic2">选取文件</button>
        <input type="hidden" name="work_pic2" accept="image/*" data-name="work_pic2" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>左视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic3">选取文件</button>
        <input type="hidden" name="work_pic3" accept="image/*" data-name="work_pic3" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>俯视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic4">选取文件</button>
        <input type="hidden" name="work_pic4" accept="image/*" data-name="work_pic4" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>后视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic5">选取文件</button>
        <input type="hidden" name="work_pic5" accept="image/*" data-name="work_pic5" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>右视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic6">选取文件</button>
        <input type="hidden" name="work_pic6" accept="image/*" data-name="work_pic6" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>仰视图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnWorkPic7">选取文件</button>
        <input type="hidden" name="work_pic7" accept="image/*" data-name="work_pic7" lay-reqText="请上传作品实物图或效果图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（建议上传jpg/png图片格式，分辨率300dpi以上、尺寸为152*102mm，大小在5MB以内）</div>
      </div>
    </div>

    
   <!-- <h1>作品展板比例</h1>
    <hr>
    <div class="enrollImg-box">
      <span style="margin-top: -150px;"><p>展板图</p><p>*</p><p>:</p></span>
      <div class="photo-box">
        <button type="button" class="layui-btn layui-btn-normal upload"  id="btnlayoutPic">选取文件</button>
        <input type="hidden" name="layout_pic" accept="image/*" data-name="layout_pic" lay-reqText="请上传作品展板图*">
        <div class="img-box"><div><i class="layui-icon layui-icon-picture"></i></div><text>删除</text></div>
        <div class="msg">（尺寸为A4竖版，建议上传jpg/png图片格式，供后期宣传使用，大小在20MB以内）</div>
      </div>
    </div> -->
    <div class="privacy-policy">
      <input type="checkbox" name="cbxAgree" value="1">
      <div><text>我已阅读并接受承诺书内容</text>「<a href="/enroll_agreement" style="font-size: 17px;" target="_blank">点击查看承诺书</a>」</div>
    </div>
    <div class="btn-box" id="sub_work">
      <button lay-submit lay-filter="btnTempSave">暂存</button>
      <button lay-submit lay-filter="btnPost" class="btnPost">提交</button>
    </div>
    <span class="tip"><i class="layui-icon layui-icon-tips"></i>暂存只是临时存放提交的内容，不会生成申报书无法进入初评，提交后可自动生成电子申报书!</span>
  </form>
</div>

</div>
<?php if(is_array($listcate) || $listcate instanceof \think\Collection || $listcate instanceof \think\Paginator): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['ftitle'] == 'dbxx' && $vo['cateid'] == '10'): ?>
    <!-- <?php echo $vo['content']; ?>
     -->
     <div class="footer">
  <div class="mfoot_l">
    <div class="mfoot_logo"><img src="/static/images/footlogo.svg" alt="" width="179"></div>
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
        <div class="right">
          <strong>支持单位：</strong>
          <span><?php echo htmlentities($webset['support']); ?></span>
        </div>
        <div class="clear"></div>
      </div>
      <div class="mfoot_m_cont m_two">
        <div class="left">
          <strong>承办单位：</strong>
          <div class="mfoot_list">
		  <?php if(is_array($webset['undertake']) || $webset['undertake'] instanceof \think\Collection || $webset['undertake'] instanceof \think\Paginator): if( count($webset['undertake'])==0 ) : echo "" ;else: foreach($webset['undertake'] as $key=>$vo): if($key%2==0): ?>
          <span style="display:block;"><?php echo htmlentities($vo); ?></span>
		  <?php endif; ?>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
          
          </div>
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
        <div class="left">
          <strong>协办单位：</strong>
		   <?php if(is_array($webset['xieban']) || $webset['xieban'] instanceof \think\Collection || $webset['xieban'] instanceof \think\Paginator): if( count($webset['xieban'])==0 ) : echo "" ;else: foreach($webset['xieban'] as $key=>$vo): if($key==0): ?>
          <span>各市工业和信息化局</span>
		  <?php endif; ?>
		    <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="right">
		 <?php if(is_array($webset['xieban']) || $webset['xieban'] instanceof \think\Collection || $webset['xieban'] instanceof \think\Paginator): if( count($webset['xieban'])==0 ) : echo "" ;else: foreach($webset['xieban'] as $key=>$vo): if($key>0): ?>
          <span>山东省工业设计协会</span>
		  <?php endif; ?>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="clear"></div>
      </div>
  </div>
  <div class="mfoot_r">
    <strong><?php echo htmlentities($webset['zuwei']); ?></strong>
    <div class="height170">
    <p><span>联&nbsp;&nbsp;系&nbsp;&nbsp;人：</span><?php echo htmlentities($webset['contacts']); ?></p>
	<p><span>&nbsp;</span>王  晨     韩  啸</p>
	<?php if(is_array($webset['tel']) || $webset['tel'] instanceof \think\Collection || $webset['tel'] instanceof \think\Paginator): if( count($webset['tel'])==0 ) : echo "" ;else: foreach($webset['tel'] as $key=>$vo): if($key==0): ?>
    <p><span>电 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</span><?php echo htmlentities($vo); ?></p>  
	<?php else: ?>
	<p><span>&nbsp;</span><?php echo htmlentities($vo); ?></p>
	<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
    
   <!-- <p><span>微&nbsp;&nbsp;信&nbsp;&nbsp;号：</span><?php echo htmlentities($webset['weixin']); ?></p>-->
    <p><span>邮 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</span><?php echo htmlentities($webset['email']); ?></p>
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
laydate.render({elem: '#completion_date',min:'2020-01-01',max: 0});
//laydate.render({elem: '#completion_date',max: 0});

function commonUpload(elem,field,size) {
  var thumbWidth = 400,thumbHeight=400;
  if(field==='file_layout_pic') {
    thumbWidth = 1000,thumbHeight=1000;
  }
  upload.render({
    elem: elem,
    url:'/home/enroll/uploadImg',
    field:field,
    accept:'images',
    acceptMime: 'image/*',
    size: size?size:5120,
    data:{createThumb:true,thumbWidth:thumbWidth,thumbHeight:thumbHeight},
    choose: function(obj){
      var elPreview = $(this.item).parent().find('.img-box div');
      obj.preview(function(index, file, result){
        $(elem).children('div').remove();
        $(elem).append('<div class="upload-tip">'+ file.name+'</div>')
        var choosedImg = $('<img class="layui-upload-img imgPreview" src="'+ result +'"/>');
        elPreview.empty().append(choosedImg)
      }
      );
    },
    done: function (res) {
      if (res.code==0) {
        $('input[name="'+ field.substr(5) +'"]').val(res.data)
      } else {
        return layer.msg('上传失败');
      }
    },
  });
}
commonUpload('#btnValidationA','file_validation_a','');
commonUpload('#btnValidationB','file_validation_b','');
commonUpload('#btnValidationC','file_validation_c','');
commonUpload('#btnWorkPic1','file_work_pic1','');
commonUpload('#btnWorkPic2','file_work_pic2','');
commonUpload('#btnWorkPic3','file_work_pic3','');
commonUpload('#btnWorkPic4','file_work_pic4','');
commonUpload('#btnWorkPic5','file_work_pic5','');
commonUpload('#btnWorkPic6','file_work_pic6','');
commonUpload('#btnWorkPic7','file_work_pic7','');
commonUpload('#btnlayoutPic','file_layout_pic',20480);

function uploadPdf(elem,field) {
  upload.render({
    elem: elem,
    url:'/home/enroll/uploadImg',
    field:field,
    exts: 'ppt|pdf|pptx',
    accept:'file',
    acceptMime: 'application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
    size: 20480,
    data:{createThumb:false},
    choose: function(obj){
      var elPreview = $(this.item).parent().find('.img-box div');
      obj.preview(function(index, file, result){
        $(elem).children('div').remove();
        $(elem).append('<div class="upload-tip">'+ file.name+'</div>')
        var choosedImg = $('<img class="layui-upload-img imgPreview" src="'+ result +'"/>');
        elPreview.empty().append(choosedImg)
      }
      );
    },
    done: function (res) {
      if (res.code==0) {
        $('input[name="'+ field.substr(5) +'"]').val(res.data)
      } else {
        return layer.msg('上传失败');
      }
    },
  });
}
uploadPdf('#btnrelevantData','file_relevant_data');

//点击删除时
$('.enrollImg-box .photo-box .img-box text').click(function () {
  var eleFilepath = $(this).parents('.photo-box').find('input[type="hidden"]');
  if(eleFilepath.val()==='') return;
  //不存在id时删除系统图片
  var data = {
    url:eleFilepath.val(),
    id:getUrlParam('id'),
    name:eleFilepath.data('name')
  }
  $.get('/home/enroll/delImg',{data: data},function(res) {});
  $(this).parent().find('div').empty().append('<i class="layui-icon layui-icon-picture"></i>');
  $(this).parents('.photo-box').find('button div').remove();
  eleFilepath.val('');
});

$("#creator_hz").blur(function(){
	if($(this).val()==''){
		$('input[name=creator_idcard]').attr('lay-verify',"required|identity");
	}else{
		$('input[name=creator_idcard]').removeAttr('lay-verify');
	}
});

//提交时先增加lay-verify验证
$('.btn-box button:eq(1)').click(function () {

  $('input[type=text]:not(input[name=creator_tel]):not(input[name=contact_tel]):not(input[name=commend_company]):not(input[name=creator_hz])').attr('lay-verify','required');
  $('input[name=contact_tel],input[name=creator_tel]').attr('lay-verify',"required|phone");
  //$('input[name=creator_idcard]').attr('lay-verify',"required|identity");
  $('input[name=zipcode]').attr('lay-verify',"required|zipcode");
  //$('input[name=title]').attr('lay-verify',"required|zf20_40");
  $('input[type=hidden]:not(input[name=validation_a]):not(input[name=validation_c]):not(input[name=work_pic4]):not(input[name=work_pic5]):not(input[name=work_pic6]):not(input[name=id]):not(input[name=uid]):not(input[name=workcode]),input[type=radio]').attr('lay-verify','required');
  //两个textarea增加验证
  $("#works_profile").attr('lay-verify','zishu');
  $("#works_description").attr('lay-verify','required|zf200_400');
  var contestants =  $('input[name="contestants"]:checked').val();
  $('input[name="credit_code"]').removeAttr('lay-verify');
  $('input[name="team_member"]').removeAttr('lay-verify');
  //alert(works_category);
 //  if(contestants==13||contestants == 47){
	//  $('input[name=credit_code]').attr('lay-verify',"required");
 //  }else{
	// $('input[name="credit_code"]').removeAttr('lay-verify');
 //  }
 if($("#creator_hz").val()==''){
		$('input[name=creator_idcard]').attr('lay-verify',"required|identity");
	}else{
		$('input[name=creator_idcard]').removeAttr('lay-verify');
  }
});

//提交设计申报
form.on('submit(btnPost)', function(data){
  var checkboxObj = $('.privacy-policy').find('input[type=checkbox]:checked');
  if (checkboxObj.size() == 0) {
    showErrorAlert('请仔细阅读并选择同意承诺书');
    return false;
  }
  // var creator_idcard_val = $('#creator_idcard').val();
  // if(creator_idcard_val.length!==18 && creator_idcard_val.length!==9 ){
  //   showErrorAlert('请正确填写主创身份证号/护照号码');
  //   $('#creator_idcard').focus();
  //   return false;
  // }
  //按钮不可点击
  $('.btn-box button').attr('disabled','disabled');
data.field.works_description = data.field.works_description.replace("\n",""); 
data.field.works_profile = data.field.works_profile.replace("\n","");

	var arr = new Array();
	
	$("#dw input:checkbox:checked").each(function(i){
		arr[i] = $(this).val();
	});
	
   data.field.patent = arr.join(",");
   
  layer.load(2, {time: 2000});
  $.post('/home/enroll/save',{data:data.field,submitto:1},function(res) {
   
    $.ajax({
      url: '/home/enroll/generateDeclaration',
      timeout : 100000,
      data: {id:res.data.id},
      success: function (res) {}
    });

    if (res.code === 1) {
      layer.msg('恭喜您，提交成功！',{icon: 1,shade: [0.3,'#000']});
      setTimeout(function() {top.location.href = '/ucenter'}, 2000);
    } else {
      layer.closeAll('loading');
      layer.alert('Sorry~~您提交的作品保存失败，请尝试重新提交或联系系统管理员');
      $('.btn-box button').removeAttr('disabled');
    }
  });
  return false;
});

$(document).ready(function () {
  var enrollId = getUrlParam('id');
  //有id时显示修改提报记录
  if (!isNaN(enrollId) && parseInt(enrollId)>0) {
    $.ajax({
      url: '/home/enroll/detail',
      data: {id:enrollId},
      success: function (res) {
	  console.log(res.data);
        if (res.code === 1) {
          if(res.data.check1_remark){
            $('.page-tip-bar').show();
            $('.page-tip-bar span').html('初审意见：'+res.data.check1_remark+","+res.data.check1_remark2)
          }else{
            $('.post-content').css('padding-top','80px');
          }
		  if(res.data.submitto==1 && res.data.checkstatus1!=-1){
			$("#sub_work").hide();
		  }
          form.val('frmPost',res.data)
          loadData(res.data);
		  set_bdi(res.data);
        } else {
          layer.open({ title: '提示', content: '系统发生错误,请退出重试！', shadeClose: true });
        }
      }
    });
  }
});

//修改img&&file部分执行代码
function loadData(data) {
  $('input[name="validation_a"]').val()?$('input[name="validation_a"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.validation_a +'"/>')):'';
  $('input[name="validation_b"]').val()?$('input[name="validation_b"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.validation_b +'"/>')):'';
  $('input[name="validation_c"]').val()?$('input[name="validation_c"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.validation_c +'"/>')):'';
  $('input[name="work_pic1"]').val()?$('input[name="work_pic1"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic1 +'"/>')):'';
  $('input[name="work_pic2"]').val()?$('input[name="work_pic2"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic2 +'"/>')):'';
  $('input[name="work_pic3"]').val()?$('input[name="work_pic3"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic3 +'"/>')):'';
  $('input[name="work_pic4"]').val()?$('input[name="work_pic4"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic4 +'"/>')):'';
  $('input[name="work_pic5"]').val()?$('input[name="work_pic5"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic5 +'"/>')):'';
  $('input[name="work_pic6"]').val()?$('input[name="work_pic6"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic6 +'"/>')):'';
  $('input[name="work_pic7"]').val()?$('input[name="work_pic7"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.work_pic7 +'"/>')):'';
  $('input[name="layout_pic"]').val()?$('input[name="layout_pic"]').parent().find('.img-box div').empty().append($('<img class="layui-upload-img imgPreview" src="'+ data.layout_pic +'"/>')):'';
  $('input[name="relevant_data"]').val()?$('#btnrelevantData').append('<div class="upload-tip">'+ data.relevant_data+'</div>'):'';
}

//监听暂存设计申报
form.on('submit(btnTempSave)', function(data){
  // var elWorksTitle = $('#works_title');
  // var titleVal = $.trim(elWorksTitle.val());
  // if(titleVal.length<1 || getCnLen(titleVal)>40){
  //   showErrorAlert('作品名称不能为空且不得超过20个汉字或40个英文字符');
  //   return false;
  // }

  //按钮不可点击
  $('.btn-box button').attr('disabled','disabled');
  layer.confirm("暂存只是临时存放提交的内容，不会生成申报书无法进入初评，提交后可自动生成电子申报书!",{btn: ['确认', '取消'],title:'提示',cancel:function(index, layero){$('.btn-box button').removeAttr('disabled')}},function(index) {
    layer.close(index);
    var loading = layer.load(1, { shade: [0.1, "#fff"] });
	var arr = new Array();
	$("#dw input:checkbox:checked").each(function(i){
		arr[i] = $(this).val();
	});
	
	data.field.patent = arr.join(",");
	
    $.post('/home/enroll/save',{data: data.field,submitto:0},function(res) {
      layer.close(loading);
      if(res.code == 1){
        layer.msg('暂存成功',{icon: 1,shade: [0.3,'#000']});
        setTimeout(function() {top.location.href = '/ucenter'}, 1000);
      }else{
        $('.btn-box button').removeAttr('disabled');
      }
    });
  }, function(){
    $('.btn-box button').removeAttr('disabled');
  });
  return false;
});

//暂存时去除lay-verify验证
$('.btn-box button:first').click(function () {
  $('input[type=text]:not(input[name=title])').removeAttr('lay-verify');
  $('input[type=hidden],input[type=radio]').removeAttr('lay-verify');
  //两个textarea移除验证
  $("#works_profile").removeAttr('lay-verify');
  $("#works_description").removeAttr('lay-verify');
});

function getUrlParam(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  var r = window.location.search.substr(1).match(reg);
  if (r != null) return unescape(r[2]);
  return null;
}

//自定义验证规则,验证radio
form.verify({
  otherReq: function(value,item){
    var $ = layui.$;
    var verifyName=$(item).attr('name'),
    verifyType=$(item).attr('type'),
    formElem=$(item).parents('.layui-form'),
    verifyElem=formElem.find('input[name='+verifyName+']'),
    isTrue= verifyElem.is(':checked'),
    focusElem = verifyElem.next().find('i.layui-icon');

    if(!isTrue || !value){
      focusElem.css(verifyType=='radio'?{'color':'#FF5722'}:{'border-color':'#FF5722'});
      focusElem.first().attr('tabIndex','1').css('outline','0').blur(function() {focusElem.css(verifyType=='radio'?{'color':''}:{'border-color':''}); }).focus();
	  if (verifyName!='creator_hz')
      return '必填项不能为空';
    }
  },
   zipcode: function(value) {
     var reg = /^[1-9]\d{5}$/;
     var s = reg.test(value);
     if(s==false){
        return '请输入正确六位邮编';
     }
    },
    zishu:function(value){
      if(value.length<100 || value.length>300){
        return '字数限定在100-300个';
      }
    },
    zf20_40:function(value){
      if(value.length>20 ){
        return '字数限定在20-40个';
      }
    },
    zf200_400:function(value){
      if(value.length<200 || value.length>400 ){
        return '字数限定在200-400个';
      }
    },
	needless1:function(value){
      if(value.length>0){
        return '个人名义申报无需填写推荐单位';
      }
    },
	needless2:function(value){
      if(value.length>0){
        return '个人名义申报无需填写营业执照';
      }
    },
	needless3:function(value){
      if(value.length>0){
        return '个人名义申报无需填写教师工作证/学生证';
      }
    }
	
});
</script>
<script>
$('.ischeck').click(function() {
    console.log(this)
    if ($(this).children('input').attr('value') !=18) {
        $('.d-show').slideDown(200);
		$('input[name=credit_code]').attr('lay-verify',"required")
    } else {
        $('input[name="credit_code"]').removeAttr('lay-verify');
        $('.d-show').slideUp(200);
    }
    if($(this).children('input').attr('title') == '院校'){
      //$('input[name=validation_c]').attr('lay-verify',"required").attr('lay-reqtext',"请上传教师工作证/学生证");
    }else{
      //$('input[name=validation_c]').removeAttr('lay-verify').removeAttr('lay-reqtext');
    }
	
	if ($(this).children('input').attr('value') != 18) {
		$('input[name=validation_c]').removeAttr('lay-verify');
       $('input[name=commend_company]').attr('lay-verify',"required").attr('lay-reqtext',"请填写推荐单位");
       $('input[name=validation_a]').attr('lay-verify',"required").attr('lay-reqtext',"请上传营业执照");
    }else{
		  $('input[name=commend_company]').removeAttr('lay-verify').removeAttr('lay-reqtext').attr('lay-verify',"needless1");
		  $('input[name=validation_a]').removeAttr('lay-verify').removeAttr('lay-reqtext').attr('lay-verify',"needless2");
		  $('input[name=validation_c]').removeAttr('lay-verify').attr('lay-verify',"needless3");
	}
})

console.log($('input[name=contestants]').val());



function set_bdi(b){

	if (b.contestants !=18) {
		console.log(22);
		$('.d-show').slideDown(200);
		$('input[name=credit_code]').attr('lay-verify',"required")
	} else {
		console.log(33);
		$('input[name="credit_code"]').removeAttr('lay-verify');
		$('.d-show').slideUp(200);
	}

	if(b.contestants==14){
		//$('input[name=validation_c]').attr('lay-verify',"required").attr('lay-reqtext',"请上传教师工作证/学生证");
	}else{
		//$('input[name=validation_c]').removeAttr('lay-verify').removeAttr('lay-reqtext');
	}

	if (b.contestants != 18) {
		$('input[name=validation_c]').removeAttr('lay-verify');
	   $('input[name=commend_company]').attr('lay-verify',"required").attr('lay-reqtext',"请填写推荐单位");
	   $('input[name=validation_a]').attr('lay-verify',"required").attr('lay-reqtext',"请上传营业执照");
	}else{
		  $('input[name=commend_company]').removeAttr('lay-verify').removeAttr('lay-reqtext').attr('lay-verify',"needless1");
		  $('input[name=validation_a]').removeAttr('lay-verify').removeAttr('lay-reqtext').attr('lay-verify',"needless2");
		  $('input[name=validation_c]').removeAttr('lay-verify').attr('lay-verify',"needless3");
	}

}



</script>

</body>
</html>

