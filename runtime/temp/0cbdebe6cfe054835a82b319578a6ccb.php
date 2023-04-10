<?php /*a:3:{s:65:"/Users/xingyoulin/www/szb/application/sysman/view/works/view.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/sysman/view/base.html";i:1649741300;s:66:"/Users/xingyoulin/www/szb/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo config('sys_name'); ?>Manage System</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/static/plugins/layui/css/layui.css" media="all" />
<link rel="stylesheet" href="/static/plugins/fontawesome4.7.0/css/font-awesome.min.css" media="all" />
<link rel="stylesheet" href="/static/css/backend/global.css" media="all">

<script>
var g_AdminRoleCode = '<?php echo htmlentities($rolecode); ?>';
var g_AdminUsername = '<?php echo htmlentities($username); ?>';
</script>

<style>
.main {margin: 20px;background: #FFF;padding: 20px;min-height: 600px;}
h4 {font-size: 18px;color: inherit;font-family: inherit;font-weight: 500;line-height: 1.2;}
a.o-btn-blue:link, a.o-btn-blue:visited {color: #ffffff;}
.o-fr {float: right !important;}
.o-btn-size-small {font-size: 12px;padding: 5px 10px;}
.o-btn-blue {background-color: #00a7e7;border-color: #00a7e7;}
.o-mt-20 {margin-top: 20px;}
.o-form {padding: 10px;}
.o-form-group {margin-top: 10px;margin-bottom: 10px;overflow: hidden;}
.o-form-horizontal .o-form-label {padding-right: 10px;text-align: right;}
.o-grid-4 {width: 33.33333333%;}
.o-input-right-p {height: 40px;line-height: 40px;font-size: 14px;}
[class*="o-grid-"] {float: left;padding-left: 0;padding-right: 0;box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;position: relative;}
.o-ml {margin-left: 10px;}
.o-fl {float: left !important;}
.application_list_one_more {border-top: 1px solid #92BEE7;border-bottom: 1px solid #92BEE7;width: 100%;padding: 20px;overflow: hidden;list-style: none;margin: 0px;border: 0;font-size: 14px;font: inherit;vertical-align: baseline}
.application_list_one_more li {float: left;width: 50%;height: 40px;line-height: 40px;border-bottom: 1px solid #F2F2F2;}
.application_list_one_more li .application_list_title {float: left;width: 38%;text-align: right;font-weight: 600;color: #666;}
.application_list_one_more li .application_list_title span {padding-right: 10px;}
.application_list_one_more li .application_list_val {float: left;width: 60%;text-align: left;}
.btn{padding-left: 30.33333333%;text-align: left;}
.textarea{width: 350px;height: 150px;border-radius: 5px;color: #333;border: 1px solid #e6e6e6;padding:15px;}
</style>

</head>
<body class="skin-<?php if(!empty($_COOKIE['skin'])){echo $_COOKIE['skin'];}else{echo '0';setcookie('skin','0');}?>">

<div class="layui-layout">

<div class="main">
  <h4>查看详情 <a href="javascript:history.go(-1)" class="o-fr o-btn o-radius o-btn-blue o-btn-size-small o-back">返回</a></h4>
  <div class="form-content o-mt-20">
    <form action="" method="post" class="o-form o-form-horizontal ajax-post" id="o-form-ajax-post" data-url="ajax-post">
      <div class="o-form-group">
        <label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">作品名称</label>
        <div class="o-grid-4 o-form-field">
          <p class="o-fl o-ml o-input-right-p"><span style=" font-size:14px; font-weight:600; "><?php echo htmlentities($record['title']); ?></span></p>
          <a href="javascript:;" id="list_btn_more" style=" margin-top:10px; float:left; width:45px; height:20px; display:block"><span style=" float:left; padding-left:15px; padding-right:5px; "><img src="/static/images/more_btn_info_1.png"></span></a>
        </div>
        <div style=" text-align:center; padding-bottom:10px; border-bottom:1px solid #F4F8F9; margin-bottom:10px; font-size:16px; overflow:hidden; ">
          <span style="float:left;">申报编号：</span>
          <span style="float:left;font-weight:600; "><?php echo htmlentities($record['workcode']); ?>（<?php echo htmlentities($record['city']); ?>）</span>
        </div>
        <?php if(( app('cookie')->get('rolecode') =='admin')): if(!(empty($record['check1_remark']) || (($record['check1_remark'] instanceof \think\Collection || $record['check1_remark'] instanceof \think\Paginator ) && $record['check1_remark']->isEmpty()))): ?>
          <p style=" padding-bottom:10px; border-bottom:1px solid #F4F8F9; margin-bottom:10px; ">初审意见：
		  
		  <?php echo htmlentities($record['check1_remark']); ?></p>
        <?php endif; if(!(empty($record['check1_remark2']) || (($record['check1_remark2'] instanceof \think\Collection || $record['check1_remark2'] instanceof \think\Paginator ) && $record['check1_remark2']->isEmpty()))): if(is_array($record['check1_remark2']) || $record['check1_remark2'] instanceof \think\Collection || $record['check1_remark2'] instanceof \think\Paginator): if( count($record['check1_remark2'])==0 ) : echo "" ;else: foreach($record['check1_remark2'] as $key=>$vo): ?>
			   <p><?php echo htmlentities($vo); ?></p>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		<?php endif; ?>
        <?php endif; ?>
        <ul class="application_list_one_more" style="display:none; ">
          <li>
            <div class="application_list_title"><span>申报作品名称</span></div>
            <div class="application_list_val">
              <?php if(empty($record['title']) || (($record['title'] instanceof \think\Collection || $record['title'] instanceof \think\Paginator ) && $record['title']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['title']); ?></span>
              <?php endif; ?>
            </div>
          </li>
		   <li>
            <div class="application_list_title"><span>推荐单位</span></div>
            <div class="application_list_val">
              <?php if(empty($record['commend_company']) || (($record['commend_company'] instanceof \think\Collection || $record['commend_company'] instanceof \think\Paginator ) && $record['commend_company']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['commend_company']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>参赛对象</span></div>
            <div class="application_list_val">
              <?php if(empty($record['contestants']) || (($record['contestants'] instanceof \think\Collection || $record['contestants'] instanceof \think\Paginator ) && $record['contestants']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span>
                  <span style=" padding-right:10px; "><?php echo htmlentities($record['contestants']); ?></span>
                  <!-- <?php if($record['contestants'] == '1'): ?>
                    <span style=" padding-right:10px; ">企业工业设计中心</span>
                  <?php endif; if($record['contestants'] == '2'): ?>
                    <span style=" padding-right:10px; ">高等院校</span>
                  <?php endif; if($record['contestants'] == '3'): ?>
                    <span style=" padding-right:10px; ">企事业单位</span>
                  <?php endif; if($record['contestants'] == '4'): ?>
                  <span style=" padding-right:10px; ">设计机构</span>
                  <?php endif; if($record['contestants'] == '5'): ?>
                    <span style=" padding-right:10px; ">社会团体</span>
                  <?php endif; if($record['contestants'] == '6'): ?>
                    <span style=" padding-right:10px; ">个人</span>
                  <?php endif; ?> -->
                </span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>申报组别</span></div>
            <div class="application_list_val">
              <?php if(empty($record['declaration_group']) || (($record['declaration_group'] instanceof \think\Collection || $record['declaration_group'] instanceof \think\Paginator ) && $record['declaration_group']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span>
                  <span style=" padding-right:10px; "><?php echo htmlentities($record['declaration_group']); ?></span>
                 <!--  <?php if($record['declaration_group'] == 'C'): ?>
                    <span style=" padding-right:10px; ">产品组</span>
                  <?php endif; if($record['declaration_group'] == 'G'): ?>
                    <span style=" padding-right:10px; ">概念组</span>
                  <?php endif; ?> -->
                </span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>作品类别</span></div>
            <div class="application_list_val">
              <?php if(empty($record['works_category']) || (($record['works_category'] instanceof \think\Collection || $record['works_category'] instanceof \think\Paginator ) && $record['works_category']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span>
                   <span style=" padding-right:12px;"><?php echo htmlentities($record['works_category']); ?></span>
                  <!-- <?php if($record['works_category'] == 'A'): ?>
                    <span style=" padding-right:12px;">机械装备</span>
                  <?php endif; if($record['works_category'] == 'L'): ?>
                    <span style=" padding-right:12px;">纺织服饰</span>
                  <?php endif; if($record['works_category'] == 'D'): ?>
                    <span style=" padding-right:12px;">智能机器人</span>
                  <?php endif; if($record['works_category'] == 'P'): ?>
                    <span style=" padding-right:12px;">体育健康旅游文创</span>
                  <?php endif; if($record['works_category'] == 'B'): ?>
                    <span style=" padding-right:12px;">交通工具</span>
                  <?php endif; if($record['works_category'] == 'G'): ?>
                    <span style=" padding-right:12px;">家用电器</span>
                  <?php endif; if($record['works_category'] == 'H'): ?>
                  <span style=" padding-right:12px;">家居与家具</span>
                  <?php endif; if($record['works_category'] == 'T'): ?>
                    <span style=" padding-right:12px;">信息化大数据平台</span>
                  <?php endif; if($record['works_category'] == 'I'): ?>
                    <span style=" padding-right:12px;">办公用品</span>
                  <?php endif; if($record['works_category'] == 'C'): ?>
                    <span style=" padding-right:12px;">五金制品</span>
                  <?php endif; if($record['works_category'] == 'O'): ?>
                    <span style=" padding-right:12px;">城市公共设施</span>
                  <?php endif; if($record['works_category'] == 'F'): ?>
                    <span style=" padding-right:12px;">电子信息及通讯产品</span>
                  <?php endif; if($record['works_category'] == 'E'): ?>
                  <span style=" padding-right:12px;">智能终端</span>
                  <?php endif; if($record['works_category'] == 'S'): ?>
                    <span style=" padding-right:12px;">乡村振兴</span>
                  <?php endif; if($record['works_category'] == 'M'): ?>
                    <span style=" padding-right:12px;">新材料及新工艺</span>
                  <?php endif; if($record['works_category'] == 'K'): ?>
                    <span style=" padding-right:12px;">医疗健康和应急防护产品</span>
                  <?php endif; if($record['works_category'] == 'R'): ?>
                    <span style=" padding-right:12px;">食品</span>
                  <?php endif; if($record['works_category'] == 'N'): ?>
                    <span style=" padding-right:12px;">包装</span>
                  <?php endif; if($record['works_category'] == 'Q'): ?>
                    <span style=" padding-right:12px;">农业及海洋产业</span>
                  <?php endif; if($record['works_category'] == 'J'): ?>
                    <span style=" padding-right:12px;">特殊人群和特种领域用品</span>
                  <?php endif; ?> -->
                </span>
              <?php endif; ?>
            </div>
          </li>
          <li style="width: 99%;">
            <div class="application_list_title" style="width: 19%;"><span>团队成员</span></div>
            <div class="application_list_val" style="width: 81%;">
              <?php if(empty($record['team_member']) || (($record['team_member'] instanceof \think\Collection || $record['team_member'] instanceof \think\Paginator ) && $record['team_member']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['team_member']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li style="width: 1%;">
          </li>
		  
		   <li>
            <div class="application_list_title"><span>单位社会信用代码</span></div>
            <div class="application_list_val">
              <?php if(empty($record['credit_code']) || (($record['credit_code'] instanceof \think\Collection || $record['credit_code'] instanceof \think\Paginator ) && $record['credit_code']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['credit_code']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主创身份证号</span></div>
            <div class="application_list_val">
              <?php if(empty($record['creator_idcard']) || (($record['creator_idcard'] instanceof \think\Collection || $record['creator_idcard'] instanceof \think\Paginator ) && $record['creator_idcard']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['creator_idcard']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主创护照</span></div>
            <div class="application_list_val">
              <?php if(empty($record['creator_hz']) || (($record['creator_hz'] instanceof \think\Collection || $record['creator_hz'] instanceof \think\Paginator ) && $record['creator_hz']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['creator_hz']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主创电话/手机</span></div>
            <div class="application_list_val">
              <?php if(empty($record['creator_tel']) || (($record['creator_tel'] instanceof \think\Collection || $record['creator_tel'] instanceof \think\Paginator ) && $record['creator_tel']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['creator_tel']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主创邮箱</span></div>
            <div class="application_list_val">
              <?php if(empty($record['creator_email']) || (($record['creator_email'] instanceof \think\Collection || $record['creator_email'] instanceof \think\Paginator ) && $record['creator_email']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['creator_email']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主创设计者</span></div>
            <div class="application_list_val">
              <?php if(empty($record['creator_designer']) || (($record['creator_designer'] instanceof \think\Collection || $record['creator_designer'] instanceof \think\Paginator ) && $record['creator_designer']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['creator_designer']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>联系人</span></div>
            <div class="application_list_val">
              <?php if(empty($record['contact_person']) || (($record['contact_person'] instanceof \think\Collection || $record['contact_person'] instanceof \think\Paginator ) && $record['contact_person']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['contact_person']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>联系人电话/手机</span></div>
            <div class="application_list_val">
              <?php if(empty($record['contact_tel']) || (($record['contact_tel'] instanceof \think\Collection || $record['contact_tel'] instanceof \think\Paginator ) && $record['contact_tel']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['contact_tel']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>联系人邮箱</span></div>
            <div class="application_list_val">
              <?php if(empty($record['contact_email']) || (($record['contact_email'] instanceof \think\Collection || $record['contact_email'] instanceof \think\Paginator ) && $record['contact_email']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <span><?php echo htmlentities($record['contact_email']); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li style=" width:100%; height:auto; ">
            <div class="application_list_title" style=" width:19%; "><span>单位/个人简介</span></div>
            <div class="application_list_val">
              <?php if(empty($record['works_profile']) || (($record['works_profile'] instanceof \think\Collection || $record['works_profile'] instanceof \think\Paginator ) && $record['works_profile']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <?php echo htmlentities(htmlspecialchars_decode($record['works_profile'])); ?>
              <?php endif; ?>
            </div>
          </li>

          <li>
            <div class="application_list_title" style=" width:38%; "><span>验证材料</span></div>
            <div class="application_list_val">
              <?php if(!(empty($record['validation_a']) || (($record['validation_a'] instanceof \think\Collection || $record['validation_a'] instanceof \think\Paginator ) && $record['validation_a']->isEmpty()))): ?>
                <a href="<?php echo htmlentities($record['validation_a']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['validation_a'])); ?>" height="30"/></a>
              <?php endif; if(!(empty($record['validation_b']) || (($record['validation_b'] instanceof \think\Collection || $record['validation_b'] instanceof \think\Paginator ) && $record['validation_b']->isEmpty()))): ?>
                <a href="<?php echo htmlentities($record['validation_b']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['validation_b'])); ?>" height="30"/></a>
              <?php endif; if(!(empty($record['validation_c']) || (($record['validation_c'] instanceof \think\Collection || $record['validation_c'] instanceof \think\Paginator ) && $record['validation_c']->isEmpty()))): ?>
                <a href="<?php echo htmlentities($record['validation_c']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['validation_c'])); ?>" height="30"/></a>
              <?php endif; if(!(empty($record['relevant_data']) || (($record['relevant_data'] instanceof \think\Collection || $record['relevant_data'] instanceof \think\Paginator ) && $record['relevant_data']->isEmpty()))): ?>
                &nbsp; &nbsp;<a href="<?php echo url('download'); ?>?id=<?php echo htmlentities($record['id']); ?>" target="_blank">点击查看相关材料</a>
              <?php endif; ?>
            </div>
          </li>
          <li></li>
          <li>
            <div class="application_list_title"><span>完成日期</span></div>
            <div class="application_list_val">
              <?php if(empty($record['completion_date']) || (($record['completion_date'] instanceof \think\Collection || $record['completion_date'] instanceof \think\Paginator ) && $record['completion_date']->isEmpty())): ?>
              <span style=" color:#CCC; ">暂无</span>
              <?php else: ?>
              <span><?php echo htmlentities(date('Y-m-d',!is_numeric($record['completion_date'])? strtotime($record['completion_date']) : $record['completion_date'])); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>版权登记</span></div>
            <div class="application_list_val">
              <?php if($record['copyright'] == '0'): ?> <span>是</span> <?php endif; if($record['copyright'] == '1'): ?> <span>否</span> <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>申请专利</span></div>
            <div class="application_list_val">
               <?php if(is_array($record['patent']) || $record['patent'] instanceof \think\Collection || $record['patent'] instanceof \think\Paginator): if( count($record['patent'])==0 ) : echo "" ;else: foreach($record['patent'] as $key=>$vo): if($vo == '0'): ?> <span> 发明 </span> <?php endif; if($vo == '1'): ?> <span> 实用新型 </span> <?php endif; if($vo == '2'): ?> <span> 外观设计 </span> <?php endif; if($vo == '3'): ?> <span> 无 </span> <?php endif; ?>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
          </li>
          <!--<li>
            <div class="application_list_title"><span>所有权</span></div>
            <div class="application_list_val">
              <?php if($record['proprietary_rights'] == '0'): ?>
                <span style=" padding-right:12px; ">单位</span>
              <?php endif; if($record['proprietary_rights'] == '1'): ?>
                <span style=" padding-right:12px; ">个人</span>
              <?php endif; ?>
            </div>
          </li>-->
		  <li>
            <div class="application_list_title"><span>所有权</span></div>
            <div class="application_list_val">
              <?php if($record['suoyouquan'] == '0'): ?>
                <span style=" padding-right:12px; ">单位</span>
              <?php endif; if($record['suoyouquan'] == '1'): ?>
                <span style=" padding-right:12px; ">个人</span>
              <?php endif; ?>
            </div>
          </li>
		  <li>
            <div class="application_list_title"><span>尺寸</span></div>
            <div class="application_list_val">
            
                <span style=" padding-right:12px; "><?php echo htmlentities($record['gsize']); ?></span>
            
            </div>
          </li>
          <li style=" width:100%; height:auto; ">
            <div class="application_list_title" style=" width:19%; "><span>作品说明</span></div>
            <div class="application_list_val">
              <?php if(empty($record['works_description']) || (($record['works_description'] instanceof \think\Collection || $record['works_description'] instanceof \think\Paginator ) && $record['works_description']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <?php echo htmlentities(htmlspecialchars_decode($record['works_description'])); ?>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>整体效果图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic1']) || (($record['work_pic1'] instanceof \think\Collection || $record['work_pic1'] instanceof \think\Paginator ) && $record['work_pic1']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic1']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic1'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>主视图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic2']) || (($record['work_pic2'] instanceof \think\Collection || $record['work_pic2'] instanceof \think\Paginator ) && $record['work_pic2']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic2']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic2'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>左视图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic3']) || (($record['work_pic3'] instanceof \think\Collection || $record['work_pic3'] instanceof \think\Paginator ) && $record['work_pic3']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic3']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic3'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>俯视图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic4']) || (($record['work_pic4'] instanceof \think\Collection || $record['work_pic4'] instanceof \think\Paginator ) && $record['work_pic4']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic4']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic4'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>后视图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic5']) || (($record['work_pic5'] instanceof \think\Collection || $record['work_pic5'] instanceof \think\Paginator ) && $record['work_pic5']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic5']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic5'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>右视图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic6']) || (($record['work_pic6'] instanceof \think\Collection || $record['work_pic6'] instanceof \think\Paginator ) && $record['work_pic6']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic6']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic6'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
		   <!-- <li>
            <div class="application_list_title"><span>实物图或效果图*</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic7']) || (($record['work_pic7'] instanceof \think\Collection || $record['work_pic7'] instanceof \think\Paginator ) && $record['work_pic7']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic7']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic7'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>
          <li>
            <div class="application_list_title"><span>轴测图</span></div>
            <div class="application_list_val">
              <?php if(empty($record['work_pic7']) || (($record['work_pic7'] instanceof \think\Collection || $record['work_pic7'] instanceof \think\Paginator ) && $record['work_pic7']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['work_pic7']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['work_pic7'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li> 

          <li>
            <div class="application_list_title"><span>展版图</span></div>
            <div class="application_list_val">
              <?php if(empty($record['layout_pic']) || (($record['layout_pic'] instanceof \think\Collection || $record['layout_pic'] instanceof \think\Paginator ) && $record['layout_pic']->isEmpty())): ?>
                <span style=" color:#CCC; ">暂无</span>
                <?php else: ?>
                <a href="<?php echo htmlentities($record['layout_pic']); ?>" target="_blank"><img src="<?php echo htmlentities(get_thumb($record['layout_pic'])); ?>" height="30" /></a>
              <?php endif; ?>
            </div>
          </li>-->
        </ul>
      </div>

      <div class="o-form-group">
        <label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">申请单位/个人</label>
        <div class="o-grid-4 o-form-field">
          <p class="o-ml o-input-right-p"><span style=" font-size:14px; font-weight:600; "><?php echo htmlentities($record['name']); ?></span></p>
        </div>
      </div>
      <div class="o-form-group">
        <label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">地址</label>
        <div class="o-grid-4 o-form-field">
          <p class="o-ml o-input-right-p"><span style=" font-size:14px; font-weight:600; "><?php echo htmlentities($record['address']); ?></span></p>
        </div>
      </div>
      <div class="o-form-group">
        <label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">邮编</label>
        <div class="o-grid-4 o-form-field">
          <p class="o-ml o-input-right-p"><span style=" font-size:14px; font-weight:600; "><?php echo htmlentities($record['zipcode']); ?></span></p>
        </div>
      </div>
      <?php if((( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='province') OR ( app('cookie')->get('rolecode') =='cityadmin')) and ($record['checkstatus1'] =='0')): ?>
	  
	   <div class="o-form-group">
		<label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">审核意见</label>
		<div class="o-grid-4 o-form-field">
		   <input type="checkbox" name="check1_remark2[]" title="请正确填写单位名称" value="请正确填写单位名称">请正确填写单位名称<br/>
		  <input type="checkbox" name="check1_remark2[]" title="推荐单位请填写各地级市工信局、一级院校名称" value="推荐单位请填写各地级市工信局、一级院校名称">推荐单位请填写各地级市工信局、一级院校名称<br/>
		  <input type="checkbox" name="check1_remark2[]" title="社会团体及个人无需填写推荐单位" value="社会团体及个人无需填写推荐单位">社会团体及个人无需填写推荐单位<br/>
		  <input type="checkbox" name="check1_remark2[]" title="产品组参赛产品需是近两年（2020年1月1日之后，至申报之日为止）内已上市的产品" value="产品组参赛产品需是近两年（2020年1月1日之后，至申报之日为止）内已上市的产品">产品组参赛产品需是近两年（2020年1月1日之后，至申报之日为止）内已上市的产品<br/>
		  <input type="checkbox" name="check1_remark2[]" title="请正确填写单位社会信用代码" value="请正确填写单位社会信用代码">请正确填写单位社会信用代码<br/>
		  <input type="checkbox" name="check1_remark2[]" title="请正确填写邮箱" value="请正确填写邮箱">请正确填写邮箱<br/>
		  <input type="checkbox" name="check1_remark2[]" title="请上传正反面身份证照片或扫描件" value="请上传正反面身份证照片或扫描件">请上传正反面身份证照片或扫描件
		</div>
	  </div>
      <div class="o-form-group">
        <label class="o-grid-4 o-form-label o-text-default" style=" padding-top:10px; color: #666; ">其他审核意见</label>
				
        <div class="o-grid-4 o-form-field">
          <textarea name="check1_remark" id="check1_remark" placeholder="点击审核前建议您先输入对该作品的审核意见" class="textarea" data-check1_remark="<?php echo htmlentities($record['check1_remark']); ?>"></textarea>
        </div>
      </div>
	  
	 
      <?php endif; ?>
    </form>
  </div>
  <div class="btn" style="width:382px;padding-left: 33.333%;display: flex;justify-content: center;">
    <?php if((( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='cityadmin'))): ?>
    <button type="button" class="layui-btn" data-id="<?php echo htmlentities($record['id']); ?>" id="btnPassedAudit">审核通过</button>
    <button type="button" class="layui-btn layui-btn-warm" data-id="<?php echo htmlentities($record['id']); ?>" id="btnReject">审核驳回</button>
    <?php endif; if(( app('cookie')->get('rolecode') !='cityadmin') OR ( app('cookie')->get('rolecode') =='admin')): ?>
    <button type="button" class="layui-btn layui-btn-danger" data-id="<?php echo htmlentities($record['id']); ?>" id="btnRemove">删除作品</button>
    <?php endif; ?>
  </div>
</div>

</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<script>
$("#list_btn_more").click(function (){
  $(this).parent().parent().find("ul").slideToggle(600, function () {});
});
</script>
<script src="/static/js/backend/works/view.js?051801"></script>

</body>
</html>

