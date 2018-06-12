/**
* @act      icp
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
	$.getJSON("https://api.yya.gs/icp_query?domain="+$('.form-control').val()+"&format=json",function(result){
		if (result.isicp) {
			setCookie('cache_url',$('.form-control').val(),365);
			$('.form-controlss').show();
			$('#content').html('<table class="table table-bordered"><tbody><tr><th scope="row">域名</th><td>'+result.query_domain+'</td></tr><tr><th scope="row">主办方</th><td>'+result.name+'</td></tr><tr><th scope="row">备案类型</th><td>'+result.nature+'</td></tr><tr><th scope="row">主体备案号</th><td>'+result.icp+'</td></tr><tr><th scope="row">ICP备案号</th><td>'+result.nowIcp+'</td></tr><tr><th scope="row">备案地址</th><td>'+result.indexUrl+'</td></tr><tr><th scope="row">网站名称</th><td>'+result.sitename+'</td></tr><tr><th scope="row">备案时间</th><td>'+result.checkDate+'</td></tr></tbody></table>');
		}else{
			layer.alert('暂时没有获取到备案信息！');
		}
	});
});
