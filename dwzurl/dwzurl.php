/**
* @act      dwzurl
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var cache=getCookie('cache_url');
$('#form-control').val(cache);
control('请输入网址：');
function dwzurl(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/url.php?url="+$('.form-control').val(),function(data){ 
		if (data.code=="1") {
			setCookie('cache_url',$('.form-control').val(),365);
			$(".form-controls").html('<textarea class="form-control" rows="3" onclick="oCopy(this)" id="form-control_dwz">'+data.ae_url+'</textarea>');
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function dwzqrcode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/url.php?url="+$('.form-control').val(),function(data){ 
		if (data.code=="1") {
			setCookie('cache_url',$('.form-control').val(),365);
			$(".form-controls").html('<img src="https://api.yum6.cn/url.php?url='+data.ae_url+'&type=qrcode">');
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function sinadwz(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/sinadwz/?longUrl="+$('.form-control').val(),function(data){ 
		if (data.urls[0].url_short) {
			setCookie('cache_url',$('.form-control').val(),365);
			$(".form-controls").html('<textarea class="form-control" rows="3" onclick="oCopy(this)" id="form-control_dwz">'+data.urls[0].url_short+'</textarea>');
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function sinalong(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/sinadwz/?shortUrl="+$('.form-control').val(),function(data){ 
		if (data[0].url_long) {
			setCookie('cache_url',$('.form-control').val(),365);
			layer.msg('ok');
			$(".form-controls").html('<textarea class="form-control" rows="3" onclick="oCopy(this)" id="form-control_dwz">'+data[0].url_long+'</textarea>');
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function sinaqrcode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/sinadwz/?longUrl="+$('.form-control').val(),function(data){ 
		if (data.urls[0].url_short) {
			setCookie('cache_url',$('.form-control').val(),365);
			var v = data.urls[0].url_short;
			$(".form-controls").html('<img src="https://api.yum6.cn/url.php?url='+v+'&type=qrcode">');
			$(".form-controls").show();
		}else{
			layer.msg('失败，请重试！');
		}
	});
}
function eps_gs(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.ajax({ 
            url: 'https://eps.gs/api/make.php?url='+$('.form-control').val(),  
            type: "GET",
            dataType: "json", //使用JSON方法进行AJAX
            success: function (data) {
			setCookie('cache_url',$('.form-control').val(),365);
				console.log(data);
                $(".form-controls").html('<textarea class="form-control" rows="3" onclick="oCopy(this)" id="form-control_dwz">'+data.url_short+'</textarea>');
				$(".form-controls").show();
            },
			error: function (data) {
				layer.msg('失败，请重试！');
            }
        })
}
function eps_gs_un(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.ajax({ 
            url: 'https://eps.gs/api/un.php?url='+$('.form-control').val(),  
            type: "GET",
            dataType: "json", //使用JSON方法进行AJAX
            success: function (data) {
			setCookie('cache_url',$('.form-control').val(),365);
				console.log(data);
                $(".form-controls").html('<textarea class="form-control" rows="3" onclick="oCopy(this)" id="form-control_dwz">'+data.url_long+'</textarea>');
				$(".form-controls").show();
            },
			error: function (data) {
				layer.msg('失败，请重试！');
            }
        })
}

