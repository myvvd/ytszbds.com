function getUrlParam(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  var r = window.location.search.substr(1).match(reg);
  if (r != null) return unescape(r[2]);
  return null;
}

// data-href为实际链接
function addTab(event) {event.preventDefault();
  var el = $(this);
  var newTab = el.data();
  parent.tab.tabAdd(newTab);
}

$('a.addtab').click(addTab);


function getCookie(cookie_name)
{
  var allcookies = document.cookie;
  var cookie_pos = allcookies.indexOf(cookie_name);
  if (cookie_pos != -1)
  {
    cookie_pos += cookie_name.length + 1;
    var cookie_end = allcookies.indexOf(';', cookie_pos);
    if (cookie_end == -1)
    {
      cookie_end = allcookies.length;
    }
     return unescape(allcookies.substring(cookie_pos, cookie_end));
  }
  return '';
}

// 自动设定表格高度
function autoSetTableHeight(extraHeight,speTableClass='') {
  extraHeight = extraHeight||60;
  var title = $('.layui-tab-title').outerHeight();
  var form = $('.form-box').outerHeight();
  var operZoneHeight = $('.oper-zone').outerHeight();
  var toolbarHeight = $('.layui-table-tool').outerHeight();
  var header = $('.layui-table-header').outerHeight();
  var page = $('.layui-table-page').outerHeight();
  var tabelHeight = window.innerHeight-title-form - operZoneHeight - toolbarHeight - header - page - extraHeight;
  $(speTableClass+'.layui-table-main').height(tabelHeight).css({'max-height':tabelHeight+'px'});
  $(speTableClass+'.layui-table-fixed>.layui-table-body').height(tabelHeight-17).css({'max-height':(tabelHeight-17)+'px'});
}
