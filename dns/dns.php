/**
* @act      dns
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_url');
$('#form-control').val(cache);
control('单IP 3s/次');
function dns(type){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yya.gs/ns_query?q="+$('.form-control').val()+"&t="+type,function(result){
		if (result.status=='1') {
			setCookie('cache_url',$('.form-control').val(),365);
			layer.msg("完成……");
			$('.form-controls').show();
			$('#content').append('<h3 style="color: red;">'+result.data[0]['host']+"<small class='text-capitalize'>-"+result.data[0]['type']+"</small></h3><br/>");
			var x;
			for (x in result.data){
				$('#content').append('Class：'+result.data[x]['class']+"<br/>");
				$('#content').append('TTL(存活时间)：'+result.data[x]['ttl']+"<br/>");
				if (type == 'a') {
					$('#content').append('IP地址：'+result.data[x]['ip']);
				}else if (type == 'txt') {
					$('#content').append('TXT：'+result.data[x]['txt']);
				}else if (type == 'soa') {
					$('#content').append('mname：'+result.data[x]['mname']+"<br/>");
					$('#content').append('rname：'+result.data[x]['rname']+"<br/>");
					$('#content').append('serial：'+result.data[x]['serial']+"<br/>");
					$('#content').append('refresh：'+result.data[x]['refresh']+"<br/>");
					$('#content').append('retry：'+result.data[x]['retry']+"<br/>");
					$('#content').append('expire：'+result.data[x]['expire']+"<br/>");
					$('#content').append('minimum-ttl：'+result.data[x]['minimum-ttl']);
				}else if (type == 'txt') {
					$('#content').append('TXT：'+result.data[x]['txt']);
				}else if (type == 'mx') {
					$('#content').append('Pri：'+result.data[x]['pri']);
				}else if (type == 'ns' || type == 'mx' || type == 'cname') {
					$('#content').append('Target：'+result.data[x]['target']);
				}
				$('#content').append("<hr/>");
			}
		}else if(result.msg=="失败"){
			layer.alert('失败');
		}else if(result.msg){
			layer.alert('请求过快，三秒超过一次');
		}else{
			layer.alert('获取失败，请重试！');
		}
	});
};
$("#clear").click(function(){
	$('.form-controls').hide();
	$('#content').html('');
});
