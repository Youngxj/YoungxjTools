	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
	<script language="javascript">
		var u,r,t,p;
		function init(){
			var R=new Q(); 
			u=decodeURIComponent(R["url"]);
			r=R["refresh"];
			if(!IsURL(u)){
				alert('不正确的URL');history.go(-1);return ;
			}
			r =  r>0?r:10;
			r=r*1000;
			document.title='杨小杰互刷吧: 每隔'+(r/1000)+'秒刷新 '+u;
			t = window.topFrame;
			var b = t.document.body;
			b.style.margin="0"
			b.innerHTML = '<h1 style="margin:0;padding:0px 10px;height:48px;overflow:hidden;line-height:48px;background:#6faf0a url(style/images/img/i.gif) repeat-x 0 0;border-bottom:1px solid #577c1d"><a href="index.html" style="display:block;float:left;width:52px;height:48px;background:url(style/images/img/i.gif) no-repeat 0 -48px;"><strong style="display:none">杨小杰互刷吧在线刷流量</strong></a><span style="display:block;float:left;font-size:14px;color:#FFF;margin-left:10px;font-family:Tahoma, Arial, Helvetica, sans-serif;">每隔'+(r/1000)+'秒刷新 '+u+'</span><span style="margin-left:8px;cursor:pointer;display:block;float:left;padding:0px 6px;margin-top:12px;line-height:24px;font-size:14px;color:#FFF;font-weight:normal;border:1px solid #577c1d;background:#a6de39;" onclick="parent.pause(this);">暂停</span></h1>';
			refresh();
			p = window. setInterval("refresh()", r);
		}
		function pause(o){if(o.ispase){p=window.setInterval("refresh()", r);o.innerHTML='暂停';}else{window.clearInterval(p);o.innerHTML='继续';}o.ispase=!o.ispase;}
		function refresh(){window.browser.location=u;}
		function Q(){var n,v,i;var s=location.href;var d=s.indexOf('?');s=s.substr(d+1);var t=s.split('&');for(i=0;i<t.length;i++){d=t[i].indexOf('=');if(d>0){n=t[i].substring(0,d);v=t[i].substr(d+1);this[n]=v;}}}
		function IsURL(u){
			var strRegex = "^((https|http)?://)" + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" + "(([0-9]{1,3}\.){3}[0-9]{1,3}" + "|" + "([0-9a-z_!~*'()-]+\.)*" + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." + "[a-z]{2,6})" + "(:[0-9]{1,4})?" + "((/?)|" + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$"; 
			var re=new RegExp(strRegex); 
			return re.test(u) ? true : false;
		}
		window.onload = init;
	</script>

<frameset rows="49,*" frameborder="0" scrolling="no" noresize>
	<frame name="topFrame" scrolling="no" noresize />
	<frame name="browser"/>
</frameset>