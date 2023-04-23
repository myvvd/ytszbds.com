<?php /*a:3:{s:73:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/change/add.html";i:1649741300;s:67:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/base.html";i:1649741300;s:74:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
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
.img-box {height: 100px;width: 100px; margin: 0 8px;display: inline-block;position: relative;cursor: pointer;}
.img-box img{width: 100%;height: 100%;}
.img-box i{height: 12px;line-height: 12px;font-size: 12px;position: absolute;right: 4px;top:4px;}
.layui-input-block.title-input,.layui-input-block.content-input{width: 100%;}

.w-e-text-container{min-height:500px !important;}
</style>

</head>
<body class="skin-<?php if(!empty($_COOKIE['skin'])){echo $_COOKIE['skin'];}else{echo '0';setcookie('skin','0');}?>">

<div class="layui-layout">

<script charset="utf-8" src="/static/plugins/nkeditor/libs/jquery.min.js"></script>
<script src="/static/plugins/image/ajaxfileupload.js"></script>
<fieldset class="layui-elem-field layui-field-title">
  <legend>栏目新增/编辑</legend>
</fieldset>
<form class="layui-form layui-form-pane">
  <input type="hidden" name="id" value="<?php echo htmlentities($record['id']); ?>">
  <div class="layui-form-item">
    <label class="layui-form-label"><span class="required">*</span>标题:</label>
    <div class="layui-input-block title-input">
      <input type="text" name="title" lay-verify="required" value="<?php echo htmlentities($record['title']); ?>" placeholder="请输入标题" class="layui-input">
    </div>
  </div>
   <div class="layui-form-item">
    <label class="layui-form-label"><span class="required"></span>英文名:</label>
    <div class="layui-input-block title-input">
      <input type="text" name="eng"  value="<?php echo htmlentities($record['eng']); ?>" placeholder="请输入英文名" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label"><span class="required"></span>别名:</label>
    <div class="layui-input-block title-input">
      <input type="text" name="ftitle"  value="<?php echo htmlentities($record['ftitle']); ?>" placeholder="请输入别名" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label"><span class="required">*</span>选择栏目:</label>
    <div class="layui-input-inline"  style="width: 40%;">
          <select name="cateid" lay-verify="required" id="works_category">
            <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo htmlentities($vo['id']); ?>"<?php if($vo['id'] == $record['cateid']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['title']); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>

        </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label image-label"><span class="required"></span>图片:</label>
   
    <div class="new_portrait" id="Photo">
          
           <input type="text" name="pic"  value="<?php echo htmlentities($record['pic']); ?>" placeholder="请输入图片" id="imageurl" class="layui-input" style="width: 500px;">

          <span style="display: none;" id="headPic_error" class="error"></span>
      </div>
                <input type="file" style="display: none;" value="" title="支持jpg、jpeg、gif、png格式，文件小于5M" name="Image" accept="image/gif,image/jpeg,image/jpg,image/png" id="Image" class="myfiles">
          <!-- <input type="hidden" id="headPicHidden" /> -->
          <input id="btnUploadImg" style="cursor:pointer;width: 120px;height: 40px;background-color:#1aa094;color:#ffffff;text-align: center;" readonly value="图片上传">
          <?php if(empty($record['pic'])): ?>
              <img width="80" height="80" id="PhotoNumber" src="/uploads/zwtp/zwtp.png">
          <?php else: ?>
              <img width="80" height="80" id="PhotoNumber" src="<?php echo htmlentities($record['pic']); ?>">
          <?php endif; ?>
 
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label content-label"><span class="required">*</span>内容:</label>
    <div class="layui-input-block content-input">
      <div id="content"> <textarea name="content" id="text-content" style="width:98%;height:500px"><?php echo $record['content']; ?></textarea></div>
    </div>
      <script type="text/javascript" src="/static/plugins/ckeditor/ckeditor.js"></script>
   <script type="text/javascript">
      var editor = CKEDITOR.replace('text-content');

    </script>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label"><span class="required">*</span>排序:</label>
    <div class="layui-input-block title-input">
      <input type="text" name="sort" lay-verify="required" value="<?php echo htmlentities($record['sort']); ?>" placeholder="请输入排序" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label"><span class="required">*</span>状态:</label>
    <div class="layui-input-block title-input">
      <input type="radio" name="status" <?php if($record['status'] == '1'): ?>checked<?php endif; ?> value="1">隐藏
      <input type="radio" name="status" <?php if($record['status'] == null || $record['status'] == 0): ?>checked<?php endif; ?>  value="0">显示
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block smt-btns-box">
      <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">提交</button>
      <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary">返回</a>
    </div>
  </div>
</form>


</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<script charset="utf-8" src="/static/plugins/nkeditor/NKeditor-all-min.js"></script>

<script charset="utf-8" src="/static/plugins/nkeditor/libs/JDialog/JDialog.min.js"></script>
<script src="/static/plugins/nkeditor/libs/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript">
  $('#btnUploadImg').click(function(){
    $('#Image').click();
  });
</script>
<script type="text/javascript">
    $("#Image").on('change', function() {
            //获取文件路径
              var filePath = $("#Image").val();
            // 获取“.”位置
            var extStart = filePath.lastIndexOf(".");
            // 获取文件格式后缀，并全部大写
            var ext = filePath.substring(extStart, filePath.length).toUpperCase();

            // 判断文件格式
            if (ext != ".BMP" && ext != ".PNG" && ext != ".JPG" && ext != ".JPEG") {
                 alert("图片仅限于.gif .png .jpg .jpeg文件。");
                 return false;
            }else {
              // 使用ajaxfileupload上传文件
              $.ajaxFileUpload({
                 url: '/sysman/Change/uploadimg', //用于文件上传的服务器端请求地址
                 type:'post',
                 secureuri: false, //一般设置为false
                 fileElementId: 'Image', //文件上传控间的id属性  <input type="file" id="Image" name="Image" />
                 dataType: 'JSON', //返回值类型 一般设置为json
                 success: function (data, status)  //服务器成功响应处理函数
                 {  
                    // console.log(data);return;
                     $("#PhotoNumber").attr("src",data);
                     $("#imageurl").val(data);
                 },
                 error: function (data, status, e)//服务器响应失败处理函数
                 {
                     alert('上传图片失败');
                 }
             });
          }
        });
</script>

<script>
// var editor;
// KindEditor.ready(function(K) {
//   editor = K.create('textarea[name="content"]', {
//     uploadJson : '/sysman/upfiles/editimg',
//     dialogOffset : 0, //对话框距离页面顶部的位置，默认为0居中，
//     allowImageUpload : true,
//     items : ['source','formatblock', 'fontname', 'fontsize','forecolor','justifyleft', 'justifycenter', 'justifyright',
//       'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'bold', 'italic', 'underline',
//       'lineheight', 'removeformat','plainpaste','image', 'table', 'insertfile', 'hr', 'pagebreak','link', 'unlink',
//       'preview'
//     ],
//     afterChange : function() {
//       this.sync();
//     },
//     themeType : "default", //主题
//     errorMsgHandler : function(message, type) {
//       try {
//         JDialog.msg({type:type, content:message, timer:2000});
//       } catch (Error) {
//         alert(message);
//       }
//     }
//   });
// });

laydate.render({ elem: '#starttime', type: 'datetime', format: 'yyyy-MM-dd HH:mm:ss' });
laydate.render({ elem: '#endtime', type: 'datetime', format: 'yyyy-MM-dd HH:mm:ss' });

form.on('submit(submit)', function (data) {
  
  data.field.content = editor.document.getBody().getHtml();

  var loading = layer.load(1, { shade: [0.1, '#fff'] });
  $.post("<?php echo url('save'); ?>", data.field, function (res) {
    layer.close(loading);
    if (res.code > 0) {
      layer.msg(res.msg, { time: 1800, icon: 1 }, function () { location.href = 'index'; });
    } else {
      layer.msg(res.msg, { time: 1800, icon: 2 });
    }
  });
});
</script>

</body>
</html>

