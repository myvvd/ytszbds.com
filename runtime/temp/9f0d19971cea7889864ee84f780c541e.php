<?php /*a:3:{s:73:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/index/main.html";i:1649741300;s:67:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/base.html";i:1649741300;s:74:"/Users/xingyoulin/www/ytszbds.com/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
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
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-card">
          <div class="layui-card-header">数据统计</div>
          <div class="layui-card-body">
            <div class="layui-carousel layadmin-carousel layadmin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%;height: 286px;">
              <ul class="layui-row layui-col-space10 layui-this">
                <li class="layui-col-md4">
                  <a data-href="/sysman/works" class="layadmin-backlog-body" title="参赛作品管理">
                    <h3>作品总数</h3>
                    <p><cite><?php echo htmlentities($stat['totalWorksCount']); ?></cite></p>
                  </a>
                </li>
                <li class="layui-col-md4">
                  <a data-href="/sysman/works/index?createtime_startdate=today" class="layadmin-backlog-body" title="今日登记作品数">
                    <h3>今日作品数</h3>
                    <p><cite><?php echo htmlentities($stat['todayWorksCount']); ?></cite></p>
                  </a>
                </li>
                <li class="layui-col-md4">
                  <a data-href="/sysman/works/index?state=waitzhongshen" class="layadmin-backlog-body" title="待初审作品数">
                    <h3>待初审作品数</h3>
                    <p><cite><?php echo htmlentities($stat['waitChushenCount']); ?></cite></p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="layui-col-md4">
        <div class="table-responsive">
        </div>
      </div>
    </div>

  </div>
</div>

</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<script>
layui.use(['jquery'],function () {
  var $ = layui.jquery;
  $('a.layadmin-backlog-body').click(function () {
    var el = $(this)
    var newTab = el.data()
    $.extend(newTab,{icon:el.children('i').attr('class'),title:el.attr('title')})
    parent.tab.tabAdd(newTab);
  })
})
</script>

</body>
</html>

