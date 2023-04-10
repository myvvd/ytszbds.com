<?php /*a:3:{s:65:"/Users/xingyoulin/www/szb/application/sysman/view/cate/index.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/sysman/view/base.html";i:1649741300;s:66:"/Users/xingyoulin/www/szb/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
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
  <blockquote class="layui-elem-quote">
    <a href="<?php echo url('edit'); ?>" class="layui-btn layui-btn-sm">添加</a>
    <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" id="delAll">批量删除</button>
  </blockquote>
  <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script type="text/html" id="action">
  <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<script>
  layui.use(["table", "form"], function() {
    var table = layui.table,form = layui.form,$ = layui.jquery;
    var tableIn = table.render({
      id: "link",
      elem: "#list",
      url: '<?php echo url("index"); ?>',
      method: "get",
      page: true,
      cols: [
        [
          { checkbox: true },
          { field: "id", title: "ID", width: 80, sort: true },
          { field: "title", title: "标题" ,width: 500},
          { field: "create_time", title: "创建时间", width: 200 },
          { width: 160, align: "center", toolbar: "#action" }
        ]
      ]
    });

    table.on("tool(list)", function(obj) {
      var data = obj.data;
      if (obj.event === "del") {
        layer.confirm("您确定要删除该记录吗？", function(index) {
          var loading = layer.load(1, {
            shade: [0.1, "#fff"]
          });
          $.post(
            "<?php echo url('del'); ?>",
            {
              id: data.id
            },
            function(res) {
              layer.close(loading);
              if (res.code === 1) {
                layer.msg(res.msg, {
                  time: 1000,
                  icon: 1
                });
                obj.del();
              } else {
                layer.msg("操作失败！", {
                  time: 1000,
                  icon: 2
                });
              }
            }
          );
          layer.close(index);
        });
      }
    });

    $("#delAll").click(function() {
      layer.confirm("确认要删除选中信息吗？", {icon: 3},
        function(index) {
          layer.close(index);
          var checkStatus = table.checkStatus("link"); //test即为参数id设定的值
          var ids = [];
          $(checkStatus.data).each(function(i, o) {
            ids.push(o.id);
          });
          var loading = layer.load(1, {
            shade: [0.1, "#fff"]
          });
          $.post(
            "<?php echo url('delall'); ?>",
            {
              id: ids
            },
            function(data) {
              layer.close(loading);
              if (data.code === 1) {
                layer.msg(data.msg, {time:1000, icon: 1});
                table.reload("link");
              } else {
                layer.msg(data.msg, {
                  time: 1000,
                  icon: 2
                });
              }
            }
          );
        }
      );
    });

    form.on('switch()', function (obj) {
    var field = obj.elem.dataset.filter;
    loading = layer.load(1, {
      shade: [0.1, '#fff']
    });
    var id = this.value;
    var val = obj.elem.checked === true ? 1 : 0;
    $.post('<?php echo url("updateState"); ?>', {
      'id': id,
      'field':field,
      'val':val
    }, function (res) {
      layer.close(loading);
      if (res.code == 1) {
        layer.msg(res.msg,{ time: 1000, icon: 1 });
      } else {
        layer.msg(res.msg, {
          time: 10000,
          icon: 2
        });
        return false;
      }
    })

  });
  });
</script>

</body>
</html>

