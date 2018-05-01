/**
* @act      code
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入内容：');
function urlencode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?urlencode="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function urldecode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?urldecode="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function base64_encode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?base64_encode="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function base64_decode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?base64_decode="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function md5(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?md5="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function addslashes(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?addslashes="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function stripslashes(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?stripslashes="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			$("#form-control").text(data.value);
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}


function base64_image_mult() {
	$('#form1').show();
}

function base64_image_url() {
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/code/code.php?base64_image&img="+$('.form-control').val(),function(data){ 
		if (data.code=="200") {
			var base64_url_img = "<img src='"+data.base64_image+"' width='"+data.width+"' height='"+data.height+"'>";
			$(".form-controls").show();
			$(".form-controls").html('<img src="'+data.base64_image+'" width="100%"><br/><label class="control-label" for="inputContent">data url:</label><textarea class="form-control" rows="5" onclick="oCopy(this)" id="form-control">'+data.base64_image+'</textarea><label class="control-label" for="inputContent">css:</label><textarea class="form-control" rows="5" onclick="oCopy(this)" id="form-control">'+base64_url_img+'</textarea>');
			$('#stat').html('上传完毕！');
		}else{
			layer.msg('失败，请重试！');
		}
	});
}

function onprogress(evt){
	  var loaded = evt.loaded;     //已经上传大小情况 
	  var tot = evt.total;      //附件总大小 
	  var per = Math.floor(100*loaded/tot);  //已经上传的百分比 
	  layer.msg(per+'%', {
	  	icon: 16
	  	,shade: 0.01
	  });
	}

	function sc(){
var animateimg = $("#file").val(); //获取上传的图片名 带//  
var imgarr=animateimg.split('\\'); //分割  
var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名  
var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置  
var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀  
var file = $('#file').get(0).files[0]; //获取上传的文件  
var fileSize = file.size;           //获取上传的文件大小  
var maxSize = 10485760;              //最大10MB(字节)  
if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){  
	layer.msg('文件类型错误,请上传图片类型');  
	return false;  
}else if(parseInt(fileSize) >= parseInt(maxSize)){  
	layer.msg('上传的文件不能超过10MB');  
	return false;  
}else{
	$('#stat').html('正在上传');
	var data = new FormData($('#form1')[0]);   
	$.ajax({
		url: "https://api.yum6.cn/code/code.php?base64_image&type=multipart",   
		type: 'POST',    
		data: data,    
		dataType: 'JSON', 
		processData: false,    
		contentType: false,
		xhr: function(){
			var xhr = $.ajaxSettings.xhr();
			if(onprogress && xhr.upload) {
				xhr.upload.addEventListener("progress" , onprogress, false);
				return xhr;
			}
		}
	}).done(function(ret){
		if(ret['code']=='200'){
			var base64_url_img = "<img src='"+ret.base64_image+"' width='"+ret.width+"' height='"+ret.height+"'>";
			$(".form-controls").show();
			$(".form-controls").html('<img src="'+ret.base64_image+'" width="100%"><br/><label class="control-label" for="inputContent">data url:</label><textarea class="form-control" rows="5" onclick="oCopy(this)" id="form-control">'+ret.base64_image+'</textarea><label class="control-label" for="inputContent">css:</label><textarea class="form-control" rows="5" onclick="oCopy(this)" id="form-control">'+base64_url_img+'</textarea>');
			$('#stat').html('上传完毕！');
			layer.msg('上传完毕！');
		}else{
			layer.msg('上传失败');  
		}    
	});
	return false;  
};    
}