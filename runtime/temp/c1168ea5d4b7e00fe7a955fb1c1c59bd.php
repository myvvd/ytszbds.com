<?php /*a:3:{s:66:"/Users/xingyoulin/www/szb/application/sysman/view/works/index.html";i:1649741300;s:59:"/Users/xingyoulin/www/szb/application/sysman/view/base.html";i:1649741300;s:66:"/Users/xingyoulin/www/szb/application/sysman/view/common/foot.html";i:1649741300;}*/ ?>
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

<style type="text/css">
  .oper-zone .layui-btn{
    float:left;
  }
</style>
<script charset="utf-8" src="/static/plugins/nkeditor/libs/jquery.min.js"></script>
<script type="text/javascript" src="http://static.runoob.com/assets/qrcode/qrcode.min.js"></script>
<script src="https://cdn.bootcss.com/jszip/3.2.0/jszip.min.js"></script>
<!-- <script src="https://cdn.bootcss.com/FileSaver.js/2014-11-29/FileSaver.min.js"></script> -->
<div class="admin-main layui-anim layui-anim-upbit">
  <div class="layui-tab layui-tab-brief" lay-filter="tab-box">
    <ul class="layui-tab-title">
      <li class="layui-this">作品列表</li>
      <?php if(( app('cookie')->get('rolecode') =='admin')): ?><li>类型占比</li><?php endif; if(( app('cookie')->get('rolecode') =='admin')): ?><li>概念占比</li><?php endif; if(( app('cookie')->get('rolecode') =='admin')): ?><li>地区占比</li><?php endif; if(( app('cookie')->get('rolecode') =='admin')): ?><li>规模占比</li><?php endif; if(( app('cookie')->get('rolecode') =='admin')): ?><li>年龄占比</li><?php endif; ?>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show" id="cnt-list">
        <!-- 申报搜索 -->
        <div class="form-box">
          <form class="layui-form layui-form-pane" id="filter-form" onsubmit="return false">
            <div class="layui-form-item">
              <div class="layui-inline">
                <?php if(( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='province')): ?>
                <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0;">作品状态</label>
                <div class="layui-input-inline input-panel" style="width:210px;">
                  <input type="checkbox" name="submitto[]" value="1" title="已提交" checked>
                  <input type="checkbox" name="submitto[]" value="0" title="仅暂存" checked>
                </div>
                <?php endif; ?>
			 </div>
			  <div class="layui-inline">
                <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0">申报编号</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <input type="text" placeholder="请输入编号"  name="workcode" autocomplete="off" class="layui-input">
                </div>
				</div>
			  <div class="layui-inline">
                <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0">作品名称</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <input type="text" placeholder="请输入名称"  name="title" autocomplete="off" class="layui-input">
                </div>
			 </div>
			  <div class="layui-inline">
                <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0">申报单位</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <input type="text" placeholder="请输入单位"  name="name" autocomplete="off" class="layui-input">
                </div>
			</div>
			 <div class="layui-inline">
                <label class="layui-form-label" style="width: 60px;padding-left: 0;padding-right: 0">参赛对象</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <select name="contestants">
                    <option value=""></option>
                    <?php if(is_array($contestantsrr) || $contestantsrr instanceof \think\Collection || $contestantsrr instanceof \think\Paginator): $i = 0; $__LIST__ = $contestantsrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
			</div>
			  <div class="layui-inline">
                <?php if(( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='province')): ?>
                <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0">作品类别</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <select name="works_category" id="works_category">
                    <option value=""></option>
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <?php endif; ?>
			   </div>


              </div>
            <?php if(( app('cookie')->get('rolecode') !='cityadmin')): ?>
			   <div class="layui-inline">
                <label class="layui-form-label" style="width: 60px;padding-left: 0;padding-right: 0">城市</label>
                <div class="layui-input-inline" style="width: 100px;">
                  <select name="city">
                    <option value=""></option>
                    <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
			  </div>
            <?php endif; ?>
			 <div class="layui-inline">
              <label class="layui-form-label" style="width: 70px;padding-left: 0;padding-right: 0">申报日期</label>
              <div class="layui-input-inline" style="width: 90px;">
                <input type="text" value="" name="createtime_startdate" id="createtime_startdate" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input">
              </div>
              </div>
			  <div class="layui-inline">
              <div class="layui-form-mid">-</div>
			  </div>
              <div class="layui-input-inline" style="width: 90px;">
                <input type="text" value="" name="createtime_enddate" id="createtime_enddate" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-inline">
                <div class="layui-input-inline">
                  <button class="layui-btn layui-btn-normal" lay-submit type="submit" lay-filter="smtDetail" id="smtDetail">查询</button>
                </div>
              </div>


          </form>
        </div>
        <hr>
        <div class="oper-zone">
          <button type="button" class="layui-btn" id="refresh">刷新</button>
          <?php if((app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='province')): if($isShowBtnPromoted == '1'): ?>
          <button type="button" class="layui-btn" id="bePromoted">晋级</button>
          <?php endif; if($isShowBtnPromotedGx == '1'): ?>
          <button type="button" class="layui-btn" id="bePromotedGx">高校晋级</button>
          <?php endif; if($isShowBtnBohui == '1'): ?>
          <button type="button" class="layui-btn" id="demote">驳回</button>
          <?php endif; if($isShowBtnBohuiGx == '1'): ?>
          <button type="button" class="layui-btn" id="demoteGx">高校驳回</button>
          <?php endif; ?>
          <button type="button" class="layui-btn layui-btn-danger" id="delAll">批量删除</button>
		  <?php if($is_pdf == '1'): ?>
          <button type="button" class="layui-btn layui-btn-normal" id="batchCreatePdf">批量更新申报书</button>
		  <?php endif; ?>
		   <button type="button" class="layui-btn layui-btn-normal" id="btnExportGrade">申报情况及分数汇总</button>
          <!--<button type="button" class="layui-btn layui-btn-normal" id="btnExportGrade">申报作品分数汇总</button>
          <button type="button" class="layui-btn layui-btn-normal" id="btnCreateReport">申报情况</button>-->
          <button type="button" class="layui-btn layui-btn-normal" id="btnExportCollegeGrade">院校分数排序</button>

          <button type="button" class="layui-btn layui-btn-normal" id="btnqrcode" onclick="cratecnm()" style="display: none" >二维码生成</button>
          <button type="button" class="layui-btn layui-btn-normal" id="btnqrcodedown"  onclick="downloadQrcode()" style="display: none">二维码打包下载</button>

          <?php else: ?>
          <button type="button" class="layui-btn layui-btn-normal" id="batchGradeExcel">申报情况</button>
          <?php endif; ?>
        </div>
        <table class="layui-table" id="list" lay-filter="list"></table>
      </div>
      <div class="layui-tab-item wy-item-width">
        <!-- 作品占比饼状图部分1 -->
        <div style="text-align: center;color:#000;font-size: 20px;" id="tb1">图表生成中......</div>
        <div class="chart-box" id="charts1" style="width: 1200px;height: 600px;"></div>
        <div class="chart-box" id="chart1" style="height: 600px;width: 1200px;" ></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
       
       
      </div>
      <div class="layui-tab-item wy-item-width">
        <!-- 作品占比饼状图部分1 -->
        <div style="text-align: center;color:#000;font-size: 20px;" id="tb2">图表生成中......</div>
        <div class="chart-box" id="charts2" style="width: 1200px;height: 600px;"></div>
        <div class="chart-box" id="chart2" style="height: 600px;width: 1200px;" ></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
       
       
      </div>
      <div class="layui-tab-item wy-item-width">
        <!-- 作品占比饼状图部分1 -->
        <div style="text-align: center;color:#000;font-size: 20px;" id="tb3">图表生成中......</div>
        <div class="chart-box" id="charts3" style="width: 1200px;height: 600px;"></div>
        <div class="chart-box" id="chart3" style="height: 600px;width: 1200px;" ></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
       
       
      </div>
      <div class="layui-tab-item wy-item-width">
        <!-- 作品占比饼状图部分1 -->
        <div style="text-align: center;color:#000;font-size: 20px;" id="tb4">图表生成中......</div>
        <div class="chart-box" id="charts4" style="width: 1200px;height: 600px;"></div>
        <div class="chart-box" id="chart4" style="height: 600px;width: 1200px;" ></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
       
       
      </div>
	  <div class="layui-tab-item wy-item-width">
        <!-- 作品占比饼状图部分1 -->
        <div style="text-align: center;color:#000;font-size: 20px;" id="tb5">图表生成中......</div>
        <div class="chart-box" id="charts5" style="width: 1200px;height: 600px;"></div>
        <div class="chart-box" id="chart5" style="height: 600px;width: 1200px;" ></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
       
       
      </div>
  </div>
</div>
<script type="text/html" id="action">
  <?php if(( app('cookie')->get('rolecode') =='admin')): ?>
  <a class="layui-btn layui-btn-normal   layui-btn-sm" lay-event="pdf">生成申报书</a>
  <?php if($is_pdf == '1'): ?>
  <a href="{{d.pdf_upload_url?d.pdf_upload_url:'javascript:void(0);'}}" class="layui-btn{{d.pdf_upload_url?'':' layui-btn-disabled'}} layui-btn-sm" target="{{d.pdf_upload_url?'_blank':''}}">申报书</a>
  <?php endif; ?>
  <?php endif; if(( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') !='cityadmin')): ?>
  <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-sm">编辑</a>
  <?php endif; if(( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') =='cityadmin')): ?>
  <a href="<?php echo url('view'); ?>?id={{d.id}}" class="layui-btn layui-btn-sm " >作品详情</a>
  <?php endif; if(( app('cookie')->get('rolecode') =='admin') OR ( app('cookie')->get('rolecode') !='cityadmin')): ?>
  <a href="<?php echo url('pingfendetail'); ?>?wid={{d.id}}" class="layui-btn  layui-btn-normal layui-btn-sm" lay-event="grade">查看评分</a>
  <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
  <a href="<?php echo url('mpingfen'); ?>?wid={{d.id}}" class="layui-btn layui-btn-sm layui-btn-normal codes" style="display: none">专家评分</a>
  <input type="hidden" name="codetitle" class="codetitle" id="codetitle" value="{{d.title}}">
  <input type="hidden" name="works_category" class="works_category" id="works_category" value="{{d.works_category}}">
  <input type="hidden" name="workcode" id="workcode" class="workcode"  value="{{d.workcode}}">
  <?php endif; if(( app('cookie')->get('rolecode') =='specialist')): ?>
    <a href="<?php echo url('pingfen'); ?>?wid={{d.id}}&gid={{d.gid}}" class="layui-btn layui-btn-sm layui-btn-normal codes" >专家评分</a>
  <?php endif; ?>
</script>
<div id="qrcode"  style="width:100px; height:100px; margin-top:15px;display: none;"></div>
<script type="text/javascript">
function cratecnm(){
   
  var a=document.getElementById("qrcode");

  if(a.innerHTML!= ""){
    alert('二维码已生成,请勿重复生成');
  }else{
    layer.msg("二维码生成中......", { icon: 1 });
      var con = $('.codes').length;
      var s = 1;
      $(".codes").each(function(index){
      if(s<=con/2){
          var href = $(this).attr('href');

        var allhref = 'http://<?php echo htmlentities($_SERVER['HTTP_HOST']); ?>'+href;

        qrcode1 = new QRCode(document.getElementById("qrcode"), {
                text: allhref,
                width: 300, //生成的二维码的宽度
                height: 300, //生成的二维码的高度
                colorDark : "#000000", // 生成的二维码的深色部分
                colorLight : "#ffffff", //生成二维码的浅色部分
                correctLevel : QRCode.CorrectLevel.H
            });
       s++;
       }
      });
  }
}
function downloadQrcode(){
  var a=document.getElementById("qrcode");

  if(a.innerHTML == ""){
    alert('请先生成二维码');
  }else{
      layer.msg("二维码下载中......", { icon: 1 });
      var a=document.getElementById("qrcode");
      function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;

        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, img.width, img.height);
        var dataURL = canvas.toDataURL("image/jpeg");
        return dataURL;
      }

      var imgList = [...document.getElementsByTagName('img')]
      console.log(imgList);
      var buffer = imgList.map(getBase64Image)
      console.log('buffer', buffer);

      function saveAs(blob, name) {
        var a = document.createElement('a')
        var url = window.URL.createObjectURL(blob)
        a.href = url
        a.download = name
        a.click()
      }

      async function main() {
        var zip = new JSZip();
        var i = 0;
        //徐修改 将map循环 buffer中的图片获取打印
        var p = buffer.map(function(){

          var workcode = $(".workcode").eq(i).val();
          var works_category = $(".works_category").eq(i).val();
          var codetitle = $(".codetitle").eq(i).val();
          zip.file(workcode +'_'+works_category+'_'+codetitle+'.jpeg', buffer[i].split(',')[1], {base64: true})    
          i++;
        });

        await Promise.all(p)
        
        zip.generateAsync({type: "blob"}).then(function (content) {
          // see FileSaver.js
          saveAs(content, "code.zip");
        });
      }

      main()
    }
}

</script>


<script type="text/javascript">
  $(window).load(function(){
     var aQuery = window.location.href.split("&");

      if(aQuery.length > 1){

          $('#btnqrcode').css('display','block');
          $('#btnqrcodedown').css('display','block');
      }
  });
</script>

</div>
<script type="text/javascript" src="/static/plugins/layui/layui.all.js"></script>
<script>
var form = layui.form, upload = layui.upload, $ = layui.jquery, laydate = layui.laydate,table = layui.table,element = layui.element;
</script>
<script type="text/javascript" src="/static/js/backend/common.js"></script>

<!-- <script src="https://cdn.bootcss.com/echarts/3.7.1/echarts.min.js"></script> -->
<script src="/static/plugins/layui-plugins/excel.min.js"></script>
<script src="/static/plugins/layui-plugins/tableFilter.js"></script>
<script src="/static/js/backend/works/index.js"></script>

</body>
</html>

