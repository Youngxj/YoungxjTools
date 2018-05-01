/**
* @act      全民k歌
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入全民K歌地址：');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/kg/kg.php?url="+$('.form-control').val(),function(result){ 
		if (result.code=="1") {
			$('#content').html('<p><audio autoplay="autoplay" controls="controls"loop="loop" preload="auto"src="'+result.url+'"> 你的浏览器不支持audio标签</audio></p>');
			$('#msg').html('<div class="well">下载地址（右键另存为）：<a class="btn btn-success" role="button" href="'+result.url+'"  target="_blank">下载音乐</a></div>');
		}else if(result.code=="2"){
			$('#content').html('<p><video autoplay="autoplay" controls="controls" loop="loop" preload="video"src="'+result.url+'"> 你的浏览器不支持video标签</video></p>');
			$('#msg').html('<div class="well">下载地址（右键另存为）：<a class="btn btn-success" role="button" href="'+result.url+'"  target="_blank">下载视频</a></div>');
		}else if(result.status=="-1"){
			layer.msg(result.msg);
		}else{
			layer.msg('解析失败！');
		}
	});
});