<?php /*a:3:{s:70:"/Users/xingyoulin/www/szb/application/sysman/view/adminuser/index.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/sysman/view/base.html";i:1649741300;s:66:"/Users/xingyoulin/www/szb/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
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

</head>
<body class="skin-<?php if(!empty($_COOKIE['skin'])){echo $_COOKIE['skin'];}else{echo '0';setcookie('skin','0');}?>">

<div class="layui-layout">

<div class="admin-main layui-anim layui-anim-upbit">
  <div class="layui-col-md12">
    <a data-href="/sysman/adminuser/add" data-title="新增管理员" data-icon="layui-icon layui-icon-user" class="addtab layui-btn layui-btn-normal" id="btnAdd">新增</a>
    <button type="button" class="layui-btn layui-btn-warm" onclick="location.reload()">刷新</button>
  </div>
  <table class="layui-table" id="tblList" lay-filter="tblList"></table>
</div>
<script type="text/html" id="action">
  <a data-href="<?php echo url('edit'); ?>?id={{d.id}}" data-title="编辑管理员" data-icon="layui-icon layui-icon-user" class="addtab layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<script>
var tableIn = table.render({
  id: 'tblList',
  elem: '#tblList',
  url: '/sysman/adminuser/index',
  method: 'get',
  page: false,
  cols: [
    [
      { checkbox: true},
      { field: 'username', title: '昵称',width:120},
      { field: 'rolecode', title: '角色',width:120},
      { title: '专家所属组',width:120,templet:function (d) {
        return d.expert_group_name?d.expert_group_name:'暂未分组';
      }},
      { field: 'create_time', title: '注册时间',width:150},
      { field: 'last_login_time', title: '最后登录时间',width:150},
      { field: 'last_login_ip', title: '最后登录IP',width:120 },
      { title:'操作', align:'center', toolbar: '#action',width:120}
    ]
  ],
});

table.on("tool(tblList)", function(obj) {
  var data = obj.data;
  if (obj.event === 'del') {
    layer.confirm("您确定要删除该帐号吗？", function(index) {
      var loading = layer.load(1, { shade: [0.1, "#fff"] });
      $.post("<?php echo url('del'); ?>", { id: data.id }, function(res) {
        layer.close(loading);
        if (res.code === 1) {
          layer.msg('删除成功', { time: 1000, icon: 1 });
          tableIn.reload();
        } else {
          layer.msg('删除失败！', { time: 1000, icon: 2 });
        }
      });
      layer.close(index);
    });
  } else if (obj.event==='edit'){
    var el = $(this);
    var newTab = el.data();
    parent.tab.tabAdd(newTab);
  }
});


$("body").on("click", "#delAll", function() {
  layer.confirm("确认要删除选中信息吗？", { icon: 3 }, function(index) {
    layer.close(index);
    var checkStatus = table.checkStatus("user"); //test即为参数id设定的值
    var ids = [];
    $(checkStatus.data).each(function(i, o) {
      ids.push(o.id);
    });
    var loading = layer.load(1, { shade: [0.1, "#fff"] });
    $.post("<?php echo url('delall'); ?>", { ids: ids }, function(data) {
      layer.close(loading);
      if (data.code === 1) {
        layer.msg(data.msg, { time: 1000, icon: 1 });
        tableIn.reload();
      } else {
        layer.msg(data.msg, { time: 1000, icon: 2 });
      }
    });
  });
});
</script>

</body>
</html>

