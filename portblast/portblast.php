/**
* @act      端口扫描
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_ip');
$('#form-control').val(cache);
control('请输入IP地址：');
var dist = ["21", "22", "23", "25", "79", "80", "110", "135", "137", "138", "139", "143", "443", "445", "888", "1433", "3306", "3311", "3312", "3389", "8888"];
$("#btn_state").click(function() {
	setCookie('cache_ip',$('.form-control').val(),365);
	if ($('#user_port').val()) {
		var strs = new Array();
		var str = $("#user_port").val();
		console.log(str);
		strs = str.split(".");
		console.log(strs);
		dist = dist.concat(strs);
		console.log(dist);
	}
	query(0, dist);
});
$(".form-control").keydown(function(e) {
	13 == e.keyCode && $("button").click();
})
function query(index, array) {
	var domain = $('.form-control').val();
	if(domain == ""){
		return layer.msg('请填写IP');
	}
	if (index < array.length) {
		$('.form-controlss').show();
		var value = array[index];
		layer.msg('玩命加载中');
		$.ajax({
			type: "get",
			url: "https://api.yum6.cn/dk.php?ip="+domain+"&dk="+value,
			async: true,
			dataType: "json",
			success: function(res) {
				$("#content").html(res.ip);
				if (res.state == 1) {
					$("#msg").append("端口开启｛IP：" + res.ip + "端口：" + res.dk + "｝<br/>")
				}
				if (index < array.length) {
					query(index + 1, array);
					layer.msg('玩命加载中');
				}
			},
			error: function(res) {
				$("#msg").append("连接错误，请重试");
				layer.msg('连接错误，请重试');
			}
		});
	}else{
		$("#msg").append("扫描完毕<br/>");
		layer.msg('扫描完毕');
	}
}

