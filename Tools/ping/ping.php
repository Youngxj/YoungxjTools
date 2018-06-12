/**
* @act      超级ping
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_url');
$('#form-control').val(cache);
var stops = "";
var val;
$("#btn_state").click(function(){
	setCookie('cache_url',$('.form-control').val(),365);
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$('.btn-default').attr('id','btn_stop');
	$('.btn-default').attr('onclick','btn_stop();');
	$('.btn-default').html('重载');
	var stops = setInterval(function(){
		ping();
	},2000);
	val=stops;
});
function btn_stop(){
	window.location.reload();
}
document.onkeydown=function(event){ //ESC结束
	var e = event || window.event || arguments.callee.caller.arguments[0];
  if(e && e.keyCode==27){ 
   btn_stop();
 }
};
function ping(){
 $.getJSON("https://api.yum6.cn/ping.php?host="+$('.form-control').val(),function(result){
  if (result.state == 1000) {
    layer.msg('正在Ping,按重载或者esc退出');
    $("#codes").append('<thead style="font-size:xx-small;"><tr class="success"><th>'+result.host+'</th><th>'+result.ip+'('+result.location+')</th><th>'+result.node+'</th><th>'+result.ping_time_avg+'</th></tr></thead>');
  }else if (result.state == 1002) {
    layer.msg('正在Ping,按重载或者esc退出');
    $("#codes").append('<thead style="font-size:xx-small;"><tr class="warning"><th>'+result.host+'</th><th>'+result.ip+'('+result.location+')</th><th>'+result.node+'</th><th>禁Ping('+result.title+')</th></tr></thead>');
  }else if(result.state == 1003){
   layer.msg('找不到主机，有可能解析未生效！');
 }else{
   layer.msg('失败，请重试！');
   setTimeout(function(){
    btn_stop();
  }, 2000);
 }
});
}
control('请输入域名/IP：');

