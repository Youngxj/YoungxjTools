/**
* @act      ip
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_ip');
$('#form-control').val(cache);
control('请输入IP地址：');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/ip.php?ip="+$('.form-control').val(),function(result){
		$.getJSON("https://api.yum6.cn/ip.php?type=tb&ip="+$('.form-control').val(),function(ret){
		if(ret.state){
		var tbk = ret.location;
}else{
		var tbk = '获取失败';
}
		if (result.ip) {
			setCookie('cache_ip',$('.form-control').val(),365);
			layer.msg('ok');
			$('.form-controlss').show();
			$('#content').html('<table class="table table-bordered"><tbody><tr><th scope="row">IP地址</th><td>'+$('.form-control').val()+'</td></tr><tr><th scope="row">IP long</th><td>'+result.longip+'</td></tr><tr><th scope="row">归属地(纯真库)</th><td>'+result.location+'</td></tr><tr><th scope="row">归属地(淘宝库)</th><td>'+tbk+'</td></tr><tr><th scope="row">IPv4地址段</th><td>'+result.ipv4+'</td></tr><tr><th scope="row">网络名称</th><td>'+result.network+'</td></tr><tr><th scope="row">单位描述</th><td>'+result.company+'</td></tr></tbody></table>');
		}
	});
});
});
