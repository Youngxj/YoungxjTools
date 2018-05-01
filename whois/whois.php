/**
* @act      whois查询
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_url');
$('#form-control').val(cache);
control('单IP 3s/次');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yya.gs/whois_query?domain="+$('.form-control').val(),function(result){
		if (result.code=='1') {
			setCookie('cache_url',$('.form-control').val(),365);
			$('.form-controlss').show();
			$('#content').html('<table class="table table-bordered text-capitalize"><tbody><tr><th scope="row">域名</th><td>'+$('.form-control').val()+'</td></tr><tr><th scope="row">注册状态</th><td>'+result.msg+'</td></tr><tr><th scope="row">whois服务器</th><td>'+result['Whois-Server']+'</td></tr><tr><th scope="row">注册人</th><td>'+result['Registrant-Name']+'</td></tr><tr><th scope="row">注册商</th><td>'+result['Registrar']+'</td></tr><tr><th scope="row">注册人联系人电话</th><td>'+result['Registrant-Phone']+'</td></tr><tr><th scope="row">注册人联系人邮件</th><td>'+result['Registrant-Email']+'</td></tr><tr><th scope="row">域名服务器</th><td>'+result['Server']+'</td></tr><tr><th scope="row">注册时间</th><td>'+result['Creation-Date']+'</td></tr><tr><th scope="row">过期时间</th><td>'+result['Registry-Expiry-Date']+'</td></tr><tr><th scope="row">数据更新时间</th><td>'+result['Data-Update-Time']+'</td></tr><tr><th scope="row">详细信息</th><td><a href="#" id="more">点击查看</a></td></tr></tbody></table>');
			$("#more").click(function(){
				width = $(window).width(), 600 > width ? width = "350px" : width > 600 ? width = "580px" : width > 1e3 && (width = "700px"), layer.open({
					title: $('.form-control').val() + "的Whois详细信息",
					type: 1,
					btnAlign: "c",
					shade: [.8, "#393D49"],
					area: [width],
					btn: ["确定"],
					content: '<pre class="pre-scrollable">' + result['info'] + "</pre>"
				})
			});
		}else if(result.code=="-1"){
			layer.alert(result.msg);
		}else{
			layer.alert('获取失败，请重试！');
		}
	});
});

