/**
* @act      StatusCode
* @version  1.0
* @author   youngxj
* @date     2018-04-20
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_url');
$('#form-control').val(cache);
control('请输入域名地址：');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/StatusCode.php?url="+$('.form-control').val()+"&format=StatusCode",function(result){
		if (result.code=='1') {
			setCookie('cache_url',$('.form-control').val(),365);
			document.cookie="cache_url="+$('.form-control').val();  
			layer.msg('ok', {icon: 1});
			$('.form-controlss').show();
			$('#content').html('<table class="table table-bordered"><tbody><tr><th scope="row">域名</th><td>'+$('.form-control').val()+'</td></tr><tr><th scope="row">状态码</th><td>'+result.state+'</td></tr></tbody></table>');
		}else if(result.code=='0'){
		layer.msg(result.state);
}else{
		layer.msg('失败');
}
	});
});

