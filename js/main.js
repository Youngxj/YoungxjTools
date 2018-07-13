/**
 * @act      main
 * @version  1.0
 * @author   youngxj
 * @date     2018-03-27
 * @url      http://www.youngxj.cn
 */

//复制
function oCopy(obj){
	obj.select();
	if (obj=='') {return false;}
  		document.execCommand("Copy"); // 执行浏览器复制命令
  		if (browserRedirect()) {
  			layer.msg('设备类型为手机，有一定几率复制失败！请查看剪切板是否成功复制');
  		}else{
  			layer.msg('已复制到剪切板！');
  		};
  	}

function browserRedirect(){	//设备类型判断
	var sUserAgent = navigator.userAgent.toLowerCase();
	var bIsIpad = sUserAgent.match(/ipad/i) == 'ipad';
	var bIsIphone = sUserAgent.match(/iphone os/i) == 'iphone os';
	var bIsMidp = sUserAgent.match(/midp/i) == 'midp';
	var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == 'rv:1.2.3.4';
	var bIsUc = sUserAgent.match(/ucweb/i) == 'web';
	var bIsCE = sUserAgent.match(/windows ce/i) == 'windows ce';
	var bIsWM = sUserAgent.match(/windows mobile/i) == 'windows mobile';
	var bIsAndroid = sUserAgent.match(/android/i) == 'android';

	if(bIsIpad || bIsIphone || bIsMidp || bIsUc7 || bIsUc || bIsCE || bIsWM || bIsAndroid ){
		return 1;
	};
}
//文本框说明
function control(msg){
	$('.control-msg').html(msg);
}
//tips
var sweetTitles = {
	x: 10,
	y: 20,
	tipElements: "a,span,img,div ",
	noTitle: false,
	init: function() {
		var b = this.noTitle;
		$(this.tipElements).each(function() {
			$(this).mouseover(function(e) {
				if (b) {
					isTitle = true
				} else {
					isTitle = $.trim(this.title) != ''
				}
				if (isTitle) {
					this.myTitle = this.title;
					this.title = "";
					var a = "<div class='tooltip'><div class='tipsy-arrow tipsy-arrow-n'></div><div class='tipsy-inner'>" + this.myTitle + "</div></div>";
					$('body').append(a);
					$('.tooltip').css({
						"top": (e.pageY + 20) + "px",
						"left": (e.pageX - 20) + "px"
					}).show('fast')
				}
			}).mouseout(function() {
				if (this.myTitle != null) {
					this.title = this.myTitle;
					$('.tooltip').remove()
				}
			}).mousemove(function(e) {
				$('.tooltip').css({
					"top": (e.pageY + 20) + "px",
					"left": (e.pageX - 20) + "px"
				})
			})
		})
	}
};
$(function() {
	sweetTitles.init()
});

function ajax_love(id){
	$.getJSON("../function/ajax_love.php?id="+id,function(result){ 
		if (result.state=="1") {
			$('#tools_love_'+id).css("color", "red");
			layer.msg(result.msg);
		}else if(result.state=="2"){
			layer.msg(result.msg);
		}else{
			layer.msg('解析失败！');
		}
	});
}
//读取cookie
function getCookie(c_name)
{
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=")
		if (c_start!=-1)
		{ 
			c_start=c_start + c_name.length+1 
			c_end=document.cookie.indexOf(";",c_start)
			if (c_end==-1) c_end=document.cookie.length
				return unescape(document.cookie.substring(c_start,c_end))
		} 
	}
	return ""
}
//设置cookie
function setCookie(c_name,value,expiredays)
{
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString())+"; path=/";
}

//切换主题
function temp(){if(getCookie('temp')=='1'){setCookie("temp","2","365");layer.msg('跳转中',{icon:16,shade:0.01});window.setTimeout(location.reload(),5000)}else if(getCookie('temp')=='2'){setCookie("temp","3","365");layer.msg('跳转中',{icon:16,shade:0.01});window.setTimeout(location.reload(),5000)}else{setCookie("temp","1","365");layer.msg('跳转中',{icon:16,shade:0.01});window.setTimeout(location.reload(),5000)}}
//切换排序
function priority(){
	if(getCookie('sort_priority')=='priority desc'){
		setCookie("sort_priority","tools_love desc","365");
		layer.msg('跳转中', {icon: 16,shade: 0.01});window.setTimeout(location.reload(),5000); 
		return;
	}else if(getCookie('sort_priority')=='tools_love desc'){
		setCookie("sort_priority","id desc","365");
		layer.msg('跳转中', {icon: 16,shade: 0.01});window.setTimeout(location.reload(),5000); 
		return;
	}else if(getCookie('sort_priority')=='id desc'){
		setCookie("sort_priority","tools_number desc","365");
		layer.msg('跳转中', {icon: 16,shade: 0.01});window.setTimeout(location.reload(),5000); 
		return;
	}else if(getCookie('sort_priority')=='tools_number desc'){
		setCookie("sort_priority","priority desc","365");
		layer.msg('跳转中', {icon: 16,shade: 0.01});window.setTimeout(location.reload(),5000); 
		return;
	}else{
		setCookie("sort_priority","priority desc","365");
		return;
	}
}
//返回顶部
function gotop(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h){
		$('#gotop').show();
	}else{
		$('#gotop').hide();
	}
}
$(document).ready(function(e) {
	
	gotop();
	$('#gotop').click(function(){
		$("html,body").animate({ scrollTop : '0' }, 400);	
	})
	
});
$(window).scroll(function(e){
	gotop();		
})
//返回顶部end



