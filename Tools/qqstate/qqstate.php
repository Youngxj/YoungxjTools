/**
* @act      QQ状态查询
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入QQ号：');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/qqstate.php?qq="+$('.form-control').val(),function(result){
		if (result.code == 200) {
			$('.form-controlss').show();
			$.getJSON("https://api.yum6.cn/qq.php?qq="+$('.form-control').val(),function(data){
				if (result.state == 1) {
					$('#content').html('查询结果：<br/><img src="https://api.yum6.cn/qq.php?qq='+$('.form-control').val()+'&type=img"><br/>QQ昵称：'+data.name+'<br/>QQ号'+result.qq+'状态为：<span style="color:red">电脑在线</span><br/><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+result.qq+'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'+result.qq+':41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>');
				}else if(result.state == 0){
					$('#content').html('查询结果：<br/><img src="https://api.yum6.cn/qq.php?qq='+$('.form-control').val()+'&type=img"><br/>QQ昵称：'+data.name+'<br/>QQ号'+result.qq+'状态为：<span style="color:blue">电脑离线</span><br/><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+result.qq+'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'+result.qq+':41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>');
				}else{
					$('#content').html('查询结果：<br/><img src="https://api.yum6.cn/qq.php?qq='+$('.form-control').val()+'&type=img"><br/>QQ昵称：'+data.name+'<br/>QQ号'+result.qq+'状态为：<span style="color:blue">检测失败</span><br/><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+result.qq+'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'+result.qq+':41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>');
				}
			});
		}
	});
});
