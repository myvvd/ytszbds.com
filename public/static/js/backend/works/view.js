//审核通过
$('#btnPassedAudit').click(function () {
  var el = $(this);
  layer.confirm( "确认要审核通过该作品？",{icon:1},function(index) {
    layer.close(index);
    var id = el.data('id');
    var check1_remark = $('#check1_remark').val();
    var loading = layer.load(1, { shade: [0.1, "#fff"] });
	var check1_remark2 = [];
	$('input[name="check1_remark2[]"]:checked').each(function(){
		check1_remark2.push($(this).val());
	});
    $.post("/sysman/works/updateCheckstatus", {id:id,checkstatus1:1,check1_remark:check1_remark,check1_remark2:check1_remark2}, function(res) {
      layer.close(loading);
      if (res.code === 1) {
        setTimeout(function() {self.location.href = '/sysman/works?state=waitzhongshen'}, 1000);
      } else {
        layer.msg('审核通过失败', { time: 1000, icon: 2 });
      }
    });
  });
});

//审核驳回
$('#btnReject').click(function () {
  var el = $(this);
  layer.confirm( "确认要审核驳回该作品？",{icon:2},function(index) {
    layer.close(index);
    var id = el.data('id');
    var check1_remark = $('#check1_remark').val();
	var check1_remark2 = [];
	$('input[name="check1_remark2[]"]:checked').each(function(){
		check1_remark2.push($(this).val());
	});
    var loading = layer.load(1, { shade: [0.1, "#fff"] });
    $.post("/sysman/works/updateCheckstatus", {id:id,checkstatus1:-1,check1_remark:check1_remark,check1_remark2:check1_remark2}, function(res) {
      layer.close(loading);
      if (res.code === 1) {
        layer.msg('该作品已被审核驳回', { time: 1500, icon: 1 });
        setTimeout(function() {window.location.href = '/sysman/works?state=waitzhongshen';}, 1500);
        // if(res.data){
        //   layer.confirm('审核驳回成功，是否要继续审核下一个作品？', {icon: 1, title:'提示'}, function(i){
        //     window.location.href = '/sysman/works/view?id='+res.data;
        //   });
        // }else{
        //   layer.msg('审核驳回成功，所有作品已全部审核完成', { time: 2000, icon: 1 });
        //   setTimeout(function() {window.location.href = '/sysman/works?state=waitzhongshen'}, 1000);
        // }
      } else {
        layer.msg('审核驳回失败', { time: 1000, icon: 2 });
      }
    });
  });
})

//删除作品
$('#btnRemove').click(function name() {
  var el = $(this);
  layer.confirm( "确认要删除该作品？",{icon:3},function(index) {
    layer.close(index);
    var id = el.data('id');
    var loading = layer.load(1, { shade: [0.1, "#fff"] });
    $.post("/sysman/works/del", {id:id}, function(res) {
      layer.close(loading);
      if (res.code === 1) {
        layer.msg('删除成功', {time: 1000, icon: 1});
      } else {
        layer.msg('操作失败！', { time: 1000, icon: 2 });
      }
    });
  });
})

//存在审核意见时赋值
if($('#check1_remark').data('check1_remark')!= ''){
  $('#check1_remark').val($('#check1_remark').data('check1_remark'))
}
