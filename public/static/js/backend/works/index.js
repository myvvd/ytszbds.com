var state = getUrlParam('state');
var where = null;
var mapData;//获取申报条件
var excel = layui.excel;

if(state) {where = {state:state};}
//申报日期
laydate.render({elem: '#createtime_startdate',max:0});
laydate.render({elem: '#createtime_enddate', max:0});
var chartindex = 1;
//tab切换时
element.on('tab(tab-box)', function(obj){
  var curTabIndex = obj.index;
  chartindex = curTabIndex;
  if (0===curTabIndex) {
    renderTable(where);
  }else if(1===curTabIndex){

    $.get('/sysman/works/index?state='+state+'&chart='+curTabIndex+'',function(res) {
      
      showEcharts(res.data.count)});
  }else if(2===curTabIndex){

    $.get('/sysman/works/index?state='+state+'&chart='+curTabIndex+'',function(res) {

      showEcharts(res.data.count)});  
  }else if(3===curTabIndex){

    $.get('/sysman/works/index?state='+state+'&chart='+curTabIndex+'',function(res) {

      showEcharts(res.data.count)});
  }else if(4===curTabIndex){

    $.get('/sysman/works/index?state='+state+'&chart='+curTabIndex+'',function(res) {
      console.log(res);
      showEcharts(res.data.count)});
  }else{
	  $.get('/sysman/works/index?state='+state+'&chart='+curTabIndex+'',function(res) {
      console.log(res);
      showEcharts(res.data.count)});
  }

});

//审核状态数据
var optionDataCheckstatus1 = [
  { key: '-1', value: '被驳回'},
  { key: '0', value: '待审'},
  { key: '1', value: '已通过'},
]

//参赛对象数据
var optionDatacontestants = [
  { key: '1', value: '企业工业设计中心'},
  { key: '2', value: '高等院校'},
  { key: '3', value: '企事业单位'},
  { key: '4', value: '设计机构'},
  { key: '5', value: '社会团体'},
  { key: '6', value: '个人'},
]

//申报组别数据
var optionDataDeclarationGroup = [
  { key: 'C', value: '产品组'},
  { key: 'G', value: '概念组'},
]

var tableOptions = {
  elem: '#list',
  url: '/sysman/works/index',
  page: true,
  limit: 150,
  limits: [10,20,50,100,150],
  parseData: function(res){
    return {
      'code':res.code,
      'msg': '',
      'count': res.data.total,
      'data': res.data.list,
      'mapData': res.data.mapData
    };
  },
  cols: [[
      { checkbox: true },
      { field: 'workcode', title: "申报编号", width: 85,align: 'center'},
      { field: 'create_time', title: "申报日期", width:125,align: 'center'},
      { field: 'title', title: "作品名称",minWidth:110,style:'overflow:hidden'},
      { field: 'declaration_group', title: "申报组别", width:70,align: 'center'},
      { field: 'works_category', title: "作品类别", width: 120,align: 'center'},
      { field: 'city', title: "城市", width:60,align: 'center'},
      { field: 'name', title: "申报单位/个人",width:110,style:'overflow:hidden'},
      { field: 'completion_date', title: "完成日期", width: 85},
      { field: 'contestants', title: "参赛对象", width: 90},
      { field: 'checkstatus1',hide :g_AdminRoleCode==='cityadmin'? true:false,  title: "审核状态", width: 70},
      { field: 'totalscore',hide :g_AdminRoleCode==='cityadmin'? true:false, title: "总分",align:'center', width:70,templet:function (d) {return d.totalscore != null?d.totalscore:'暂无评分'; }},
      { field: 'avgscore',hide :g_AdminRoleCode==='cityadmin'? true:false, title: "平均分",align:'center', width:70,templet:function (d) {return d.avgscore? Math.round(d.avgscore*100)/100:'暂无评分'; }},
      { field: 'set_score', title: "暂未设定",align:'center', edit: 'text', width:70,templet:function (d) {return d.set_score?d.set_score:'暂未设定'; }},
      { title: "操作", fixed:'right',width:(g_AdminRoleCode==='specialist' || g_AdminRoleCode==='cityadmin')?140:395,align:'center', templet: '#action' },
  ]],
  done: function (res) {
    $(window).resize(function () {
      autoSetTableHeight(75);
    }).resize();
    //仅在参赛作品管理页面挂载搜索
    if(state == null){tableFilterIns.reload()}
    mapData = res.mapData;
  }
};

//挂载搜索部分
var tableFilter = layui.tableFilter;
tableFilterIns = tableFilter.render({
  'elem' : '#list',
  'mode' : 'api',
  'url':'/sysman/works/index',
  'filters' : [
    {field: 'contestants', type:'radio',data:optionDatacontestants},
    {field: 'checkstatus1', type:'radio',data:optionDataCheckstatus1},
    {field: 'declaration_group', type:'radio',data:optionDataDeclarationGroup},
  ],
  'parent':'#cnt-list',
  'done': function(filters){}
});

//判断如果是专家显示得分
if(g_AdminRoleCode === 'specialist'){
  tableOptions.cols[0].forEach(function (i){
    if(i.title==='总分'){i.title='评分';}
    if(i.title==='审核状态' || i.title==='平均分'){i.hide = true;}
  });
}

//判断如果是testa登录显示暂未设定
if(g_AdminUsername != 'testa'){
  tableOptions.cols[0].forEach(function (i){
    if(i.title==='暂未设定'){i.hide = true;}
  });
}

table.on("tool(list)", function(obj) {
  var data = obj.data;
  var event = obj.event;
  if (event === 'del') {
    layer.confirm("您确定要删除该记录吗？", function(index) {
      var loading = layer.load(1, {shade: [0.1, "#fff"]});
      $.post('/sysman/works/del',{id: data.id},function(res) {
        layer.close(loading);
        if (res.code ==1) {
          layer.msg('删除成功');
          obj.del();
        } else {
          layer.msg('删除失败');
        }
      });
      layer.close(index);
    });
  } else if(event === 'pdf') {
    $.post('/sysman/works/createpdf',{id:data.id},function (res) {
      if(res.code===1) {layer.msg('生成PDF成功');}
    });
  }
});

//编辑修改调节分
table.on('edit(list)', function (obj) {
  var field = obj.field;
  var data = {id: obj.data.id};
  data[field] = obj.value;
  var loading = layer.load(1, {shade: [0.1, "#fff"]});
  $.post('/sysman/works/updateSetScore', {data:data}, function (res) {
    layer.close(loading);
    if (res.code == 1) {
      layer.msg('修改成功');
    }
  });
});

// 批量删除
$('#delAll').click(function() {
  var checkStatus = table.checkStatus('list').data;
  if(checkStatus.length<1){layer.msg('请至少选择一行数据');return;}
  layer.confirm('确认要删除选中的参赛作品吗？', { icon: 3 },function(index) {
      layer.close(index);
      var ids = [];
      $(checkStatus).each(function(i, o) {
        ids.push(o.id);
      });
      var loading = layer.load(1, { shade: [0.1, "#fff"] });
      $.post('/sysman/works/delall', {id:ids}, function(data) {
        layer.close(loading);
        if (data.code === 1) {
          layer.msg('删除成功', { time: 1000, icon: 1 });
          table.reload('list');
        } else {
          layer.msg('删除失败', { time: 1000, icon: 2 });
        }
      });
    }
  );
});

//批量生成PDF
$('#batchCreatePdf').click(function() {
  var sltedIds = table.checkStatus('list').data;
  if(sltedIds.length<1){layer.msg('请至少选择一行数据');return;}
  var ids = [];
  $(sltedIds).each(function(i, o) {
    if(o.submitto==1) ids.push(o.id);
  });

  var loading = layer.load(1, { shade: [0.1, "#fff"] });
  $.post('/sysman/works/pdfall', {id:ids}, function(data) {
    layer.close(loading);
    if (data.code === 1) {
      layer.msg('申报书生成成功', { time: 1000, icon: 1 });
    } else {
      layer.msg('申报书生成失败', { time: 1000, icon: 2 });
    }
  });
});

//批量生成PDF
$('#batchCreatePdfCityadmin').click(function() {
  var sltedIds = table.checkStatus('list').data;
  if(sltedIds.length<1){layer.msg('请至少选择一行数据');return;}
  var ids = [];
  $(sltedIds).each(function(i, o) {
    if(o.submitto==1) ids.push(o.id);
  });

  var loading = layer.load(1, { shade: [0.1, "#fff"] });
  $.post('/sysman/works/pdfall', {id:ids}, function(data) {
    layer.close(loading);
    if (data.code === 1) {
      layer.msg('申报书生成成功', { time: 1000, icon: 1 });
    } else {
      layer.msg('申报书生成失败', { time: 1000, icon: 2 });
    }
  });
});


//管理员操作申报作品晋级
if(state == 'waitchuping' || state == 'waitfuping' || state == 'waitzhongping'){
  $('#bePromoted').click(function() {
    var text = '确认要选中的作品晋级？';
    switch (state) {
      case 'waitchuping':
        text = '确认要选中的作品通过初评？';
        break;
      case 'waitfuping':
        text = '确认要选中的作品通过复评？';
        break;
      case 'waitzhongping':
        text = '确认要选中的作品通过终评？';
        break;
    }
    var checkStatus = table.checkStatus('list').data;
    if(checkStatus.length<1){layer.msg('请至少选择一行数据');return;}
    $(checkStatus).each(function(ix, item) {
      layer.confirm(text,{icon:3},function(index) {
        layer.close(index);
        var ids = [];
        $(checkStatus).each(function(i, o) {
          ids.push(o.id);
        });
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post('/sysman/works/bePromoted', {id:ids,state:state}, function(data) {
          layer.close(loading);
          if (data.code === 1) {
            layer.msg('晋级成功', {time:1000,icon:1});
            table.reload('list');
          } else {
            layer.msg('晋级失败', {time:1000,icon:2});
          }
        });
      });
    });
  });
}

//管理员操作申报作品驳回
if(state == 'passedchuping' || state == 'passedfuping' || state == 'passedzhongping'){
  $('#demote').click(function() {
    var text = '确认要将选中的作品驳回？';
    switch (state) {
      case 'passedchuping':
        text = '确认要将选中的作品驳回待初评？';
        break;
      case 'passedfuping':
        text = '确认要将选中的作品驳回待复评？';
        break;
      case 'passedzhongping':
        text = '确认要将选中的作品驳回待终评？';
        break;
    }
    var checkStatus = table.checkStatus('list').data;
    if(checkStatus.length<1){layer.msg('请至少选择一行数据');return;}
    layer.confirm(text,{icon:3},function(index) {
        layer.close(index);
        var ids = [];
        $(checkStatus).each(function(i, o) {ids.push(o.id);});
        var loading = layer.load(1, { shade: [0.1, '#fff'] });
        $.post('/sysman/works/demote', {id:ids,state:state}, function(data) {
          layer.close(loading);
          if (data.code === 1) {
            layer.msg('驳回成功', {time:1000,icon:1});
            table.reload('list');
          } else {
            layer.msg('驳回失败', {time:1000,icon:2});
          }
        });
      }
    );
  });
}else{
  $('#demote').hide();
}

//待初评作品(高等院校)晋级到高校得分排名
$('#bePromotedGx').click(function() {
  var checkStatus = table.checkStatus('list').data;
  if(checkStatus.length<1){layer.msg('请至少选择一行数据');return;}
  $(checkStatus).each(function(ix, item) {
    layer.confirm('确认要将选中的作品晋级到高校得分排名页面？',{icon:3},function(index) {
      layer.close(index);
      var ids = [];
      $(checkStatus).each(function(i, o) {
        ids.push(o.id);
      });
      var loading = layer.load(1, { shade: [0.1, '#fff'] });
      $.post('/sysman/works/bePromotedGx', {id:ids}, function(data) {
        layer.close(loading);
        if (data.code === 1) {
          layer.msg('晋级成功', {time:1000,icon:1});
          table.reload('list');
        } else {
          layer.msg('晋级失败', {time:1000,icon:2});
        }
      });
    });
  });
});

//高校作品驳回到待初评作品
$('#demoteGx').click(function() {
  var checkStatus = table.checkStatus('list').data;
  if(checkStatus.length<1){layer.msg('请至少选择一行数据');return;}
  layer.confirm('确认要将选中的作品驳回到待初评作品页面？',{icon:3},function(index) {
      layer.close(index);
      var ids = [];
      $(checkStatus).each(function(i, o) {ids.push(o.id);});
      var loading = layer.load(1, { shade: [0.1, '#fff'] });
      $.post('/sysman/works/demoteGx', {id:ids}, function(data) {
        layer.close(loading);
        if (data.code === 1) {
          layer.msg('驳回成功', {time:1000,icon:1});
          table.reload('list');
        } else {
          layer.msg('驳回失败', {time:1000,icon:2});
        }
      });
    }
  );
});

//刷新页面
$('#refresh').click(function() {
  renderTable(where);
});

$(document).ready(function () {
  renderTable(where);
});

function renderTable(where) {
  var options = {where:where};
  var ext = $.extend([], tableOptions, options);
  tableIns = table.render(ext);
}

//查询提交
form.on('submit(smtDetail)', function (data) {
  var stateData = {state:state};
  var newData = $.extend({}, data.field, stateData);
  renderTable(newData);
  return false;
});

//生成作品分数表(表一)
$('#btnExportGrade').click(function (e) {
  var exportFields = ['workcode', 'title', 'declaration_group', 'works_category', 'city','name', 'completion_date', 'contestants', 'creator_designer','creator_idcard','age','creator_tel','creator_email','contact_person','contact_tel','contact_email','grade_chusai_avg'];
  var rowHeader = {
    workcode:'申报编号',
    title:'作品名称',
    declaration_group:'申报组别',
    works_category:'作品类别',
    city:'城市',
    name:'申报单位/个人',
    completion_date:'完成日期',
    contestants:'参赛对象',	
	creator_designer:'主创',
    creator_tel:'主创电话',
    creator_email:'主创邮箱',
    contact_person:'联系人',
    contact_tel:'联系人电话',
    contact_email:'联系人邮箱',	
    // expert1:'专家评分1',
    // expert2:'专家评分2',
    // expert3:'专家评分3',
    // expert4:'专家评分4',
    // expert5:'专家评分5',
    // expert6:'专家评分6',
    // expert7:'专家评分7',
    grade_chusai_avg:'平均分'
  };
  //第一行，字段名与中文标题对应
  var colConf = excel.makeColConfig({
    'A': 120,
    'B': 300,
    'C': 120,
    'D': 120,
    'E': 60,
    'F': 180,
    'G': 120,
    'H': 150,
	'I': 80,
    'J': 120,
    'K': 60,
    'L': 120,
    'M': 120,
    'N': 150,	
    'O': 120,
    'P': 120,
    'Q': 120,
    // 'R': 120,
    // 'S': 120,
    // 'T': 120,
    // 'U': 120,
    // 'V': 120,
	// 'W': 120,
	// 'X': 120
  });
  var index = layer.load();
  $.get('/sysman/works/exportGrade',{state:state},function(res) {
    var exceldata = res.data;
    exceldata.unshift(rowHeader);

    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(exceldata,exportFields);
    excel.exportExcel({
      sheet1: data
    }, '纺织服装分赛申报情况及分数汇总.xlsx', 'xlsx',{
      extend: {'!cols': colConf}
    });
    layer.close(index);
  });
});

//生成报表(表二)
$('#btnCreateReport').click(function () {
  var index = layer.load();
  var checkStatus = table.checkStatus('list').data;
  var city = $('.layui-anim .layui-anim-upbit').find('.layui-this').text();
  //定义导出的字段及字段宽度等
  var exportFields = ['workcode', 'title', 'declaration_group', 'works_category', 'city','name', 'completion_date', 'contestants', 'creator_designer','creator_tel','creator_email','contact_person','contact_tel','contact_email'];
  var rowHeader = {
    workcode:'申报编号',
    title:'作品名称',
    declaration_group:'申报组别',
    works_category:'作品类别',
    city:'城市',
    name:'申报单位/个人',
    completion_date:'完成日期',
    contestants:'参赛对象',
    creator_designer:'主创',
    creator_tel:'主创电话',
    creator_email:'主创邮箱',
    contact_person:'联系人',
    contact_tel:'联系人电话',
    contact_email:'联系人邮箱'
  };
  //第一行，字段名与中文标题对应
  var colConf = excel.makeColConfig({
    'A': 120,
    'B': 300,
    'C': 120,
    'D': 120,
    'E': 60,
    'F': 180,
    'G': 120,
    'H': 150,
    'I': 120,
    'J': 120,
    'K': 150,
    'L': 120,
    'M': 120,
    'N': 150
  });

  //只导出选中的记录
  if(checkStatus.length>0){
    checkStatus.unshift(rowHeader);
    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(checkStatus,exportFields);
    excel.exportExcel({sheet1: data}, '生成报表.xlsx', 'xlsx',{
      extend: {'!cols': colConf}
    });
    layer.close(index);
    return;
  }
  var exportMapData = {export:JSON.stringify(mapData),state:state};
  $.get('/sysman/works/index',exportMapData,function(res) {
    var exceldata = res.data.list;
    exceldata.unshift(rowHeader);
    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(exceldata,exportFields);
    excel.exportExcel({
      sheet1: data
    }, '第三届“省长杯”工业设计大赛'+city+'作品申报情况.xlsx', 'xlsx',{
      extend: {
        '!cols': colConf
      }
    });
    layer.close(index);
  });
});

//生成高校得分排序(表三)
$('#btnExportCollegeGrade').click(function (e) {
  var exportFields = ['workcode', 'title', 'declaration_group', 'works_category', 'city','name', 'completion_date', 'contestants','address','expert1','expert2','expert3','expert4','expert5','expert6','expert7','grade_chusai_avg'];
  var rowHeader = {
    workcode:'申报编号',
    title:'作品名称',
    declaration_group:'申报组别',
    works_category:'作品类别',
    city:'城市',
    name:'申报单位/个人',
    completion_date:'完成日期',
    contestants:'参赛对象',
    address:'地址',
    expert1:'专家评分1',
    expert2:'专家评分2',
    expert3:'专家评分3',
    expert4:'专家评分4',
    expert5:'专家评分5',
    expert6:'专家评分6',
    expert7:'专家评分7',
    grade_chusai_avg:'平均分'
  };
  //第一行，字段名与中文标题对应
  var colConf = excel.makeColConfig({
    'A': 120,
    'B': 300,
    'C': 120,
    'D': 120,
    'E': 60,
    'F': 180,
    'G': 120,
    'H': 150,
    'I': 300,
    'J': 120,
    'K': 150,
    'L': 150,
    'M': 150,
    'N': 150,
    '0': 150,
    'P': 150,
    'Q': 150
  });
  var index = layer.load();
  $.get('/sysman/works/exportGrade',{unit:'college'},function(res) {
    var exceldata = res.data;
    exceldata.unshift(rowHeader);
    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(exceldata,exportFields);
    excel.exportExcel({
      sheet1: data
    }, '纺织服装分赛院校分数排序.xlsx', 'xlsx',{
      extend: {'!cols': colConf}
    });
    layer.close(index);
  });
});

//专家导出打分表格（用于专家签名）
$('#batchGradeExcel').click(function () {
  var index = layer.load();
  var checkStatus = table.checkStatus('list').data;
  var experttype;
  switch (getCookie("schexperttype")) {
    case 'chusai':
      experttype = '初评';
      break;
    case 'fusai':
      experttype = '复评';
    break;
    case 'final':
      experttype = '终评';
      break;
    default :
      experttype = '';

  }
  //定义导出的字段及字段宽度等
  var exportFields = ['workcode', 'title', 'declaration_group', 'works_category', 'city','name', 'completion_date', 'contestants', 'creator_designer','creator_idcard','age','creator_tel','creator_email','contact_person','contact_tel','contact_email'];
  var rowHeader = {
    workcode:'申报编号',
    title:'作品名称',
    declaration_group:'申报组别',
    works_category:'作品类别',
    city:'城市',
    name:'申报单位/个人',
    completion_date:'完成日期',
    contestants:'参赛对象'
  };
  //第一行，字段名与中文标题对应
  var colConf = excel.makeColConfig({
    'A': 120,
    'B': 300,
    'C': 120,
    'D': 120,
    'E': 60,
    'F': 180,
    'G': 120,
    'H': 150
  });

  //只导出选中的记录
  if(checkStatus.length>0){
    checkStatus.unshift(rowHeader);
    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(checkStatus,exportFields);
    excel.exportExcel({sheet1: data}, experttype+'申报情况.xlsx', 'xlsx',{
      extend: {'!cols': colConf}
    });
    layer.close(index);
    return;
  }

  var exportMapData = {export:JSON.stringify(mapData),state:state};
  $.get('/sysman/works/index',exportMapData,function(res) {
    var exceldata = res.data.list;
    exceldata.unshift(rowHeader);
    //如果需要调整顺序，请执行梳理函数
    var data = excel.filterExportData(exceldata,exportFields);
    excel.exportExcel({
      sheet1: data
    }, experttype+'申报情况.xlsx', 'xlsx',{
      extend: {
        '!cols': colConf
      }
    });
    layer.close(index);
  });
});

//内部专用生成批量申报书
$('#batchAllPdf').click(function() {
  $.get('/sysman/works/batchAllPdf',function(res) {
    if (res.code === 1) {
      layer.msg(res.msg, { time: 1000, icon: 1 });
    } else {
      layer.msg('申报书生成失败', { time: 1000, icon: 2 });
    }
  });
});

//=====================获取作品类别的数量=====================


function getcate_ecport(c,n){
	
	
	layer.confirm('确定要导出《'+n+'》数据吗？', {
		btn: ['确定', '取消']
	}, function () {
		 layer.close(layer.index);
		 var exportFields = ['workcode', 'title', 'declaration_group', 'works_category', 'city','name', 'completion_date', 'contestants', 'creator_designer','creator_tel','creator_email','contact_person','contact_tel','contact_email','expert1','expert2','expert3','expert4','expert5','expert6','expert7','grade_chusai_avg'];
		  var rowHeader = {
			workcode:'申报编号',
			title:'作品名称',
			declaration_group:'申报组别',
			works_category:'作品类别',
			city:'城市',
			name:'申报单位/个人',
			completion_date:'完成日期',
			contestants:'参赛对象',	
			creator_designer:'主创',
			creator_tel:'主创电话',
			creator_email:'主创邮箱',
			contact_person:'联系人',
			contact_tel:'联系人电话',
			contact_email:'联系人邮箱',	
			expert1:'专家评分1',
			expert2:'专家评分2',
			expert3:'专家评分3',
			expert4:'专家评分4',
			expert5:'专家评分5',
			expert6:'专家评分6',
			expert7:'专家评分7',
			grade_chusai_avg:'平均分'
		  };
		  //第一行，字段名与中文标题对应
		  var colConf = excel.makeColConfig({
			'A': 120,
			'B': 300,
			'C': 120,
			'D': 120,
			'E': 60,
			'F': 180,
			'G': 120,
			'H': 150,
			'I': 120,
			'J': 120,
			'K': 150,
			'L': 120,
			'M': 120,
			'N': 150,	
			'O': 120,
			'P': 120,
			'Q': 150,
			'R': 150,
			'S': 150,
			'T': 150,
			'U': 150,
			'V': 150
		  });
		  var index = layer.load();
		  $.get('/sysman/works/exportGrade2',{chart:c,name:n},function(res) {
			var exceldata = res.data;
			exceldata.unshift(rowHeader);

			//如果需要调整顺序，请执行梳理函数
			var data = excel.filterExportData(exceldata,exportFields);
			excel.exportExcel({
			  sheet1: data
			}, n+'-申报情况及分数汇总.xlsx', 'xlsx',{
			  extend: {'!cols': colConf}
			});
			layer.close(index);
		  });
	}, function () {
		layer.close(layer.index);
	});

	
}


// 显示统计图表

function showEcharts(data) {
  
  if(data.length>0){
    var name = new Array();
    var num = new Array();
    var chart_ = "";
    $.each(data, function (index, item) {
      var ceil_count = Math.ceil(item.name.length/2);
      let res = "";
      for (var i = 0; i < ceil_count; i++) {
        res += item.name.substr(i*2,2)+"\n";
      }
      name.push(res);
      num.push(item.value);
      chart_ = item.shuzi;
    });

    var myCharts = echarts.init(document.getElementById('charts'+chart_));
	var ttitle = '作品展示';
	if(chartindex==1){
		 ttitle = '类型占比';
	}else if(chartindex==2){
		 ttitle = '概念占比';
	}else if(chartindex==3){
		ttitle = '地区占比';
	}else if(chartindex==4){
		ttitle = '规模占比';
	}else if(chartindex==5){
		ttitle = '年龄占比';
	}

    myCharts.setOption({
       title: {
          text: ttitle+'-饼图',
          left: 'center'
      },
      tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
      },
      toolbox: {
        show: true,
        feature: {
            mark: {show: true},
            dataView: {show: true, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
      legend: {
        orient: 'vertical',
        left: 'left',
      },
      series : [
        {
          name: name,
          type: 'pie',
          radius: '55%',
          data:data,
          itemStyle:{
          normal:{
            label:{ show: true, formatter: '{b} : {c} ({d}%)' },
            labelLine :{show:true}
            }
          }
        }
      ]
    })
	myCharts.off('legendselectchanged') //解决重复触发
   /* myCharts.on('legendselectchanged', (e) => {
		
	  alert('点击了'); // 如果不加off事件，就会叠加触发
	  console.log(e);
	})*/
	myCharts.on('legendselectchanged', function (params) {
		myCharts.setOption({
			legend:{selected:{[params.name]: true}}
		})
		
		console.log('点击了', params.name);
		// do something
		getcate_ecport(chartindex,params.name);
	});

    var zzCharts = echarts.init(document.getElementById('chart'+chart_));
    zzCharts.setOption({
		title: {
          text: ttitle+'-柱形图',
          left: 'center'
      },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            crossStyle: {
                color: '#999'
            }
        }
    },
    toolbox: {
        feature: {
            dataView: {show: true, readOnly: false},
            magicType: {show: true, type: ['bar']},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
      xAxis: {
          type: 'category',
          data: name,
          axisPointer: {
                type: 'shadow'
            }
      },
      yAxis: {
          type: 'value'
      },
      series : [
        {
          data: num,
          type: 'bar',
          showBackground: true,
          backgroundStyle: {
              color: 'rgba(180, 180, 180, 0.2)'
          }
        }

      ]
    })
    
  $("#tb"+chart_).css('display','none');
  }else{
    alert('暂无作品')
    // $(".html").html("暂无作品");
  }
 
}
