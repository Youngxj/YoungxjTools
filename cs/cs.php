/**
* @act      猜数
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var s=parseInt(Math.random()*100);
var x=0;
function fun(){
	if($('#sz').val()==''){
		layer.alert('你是不是忘记填内容了？');
	}else{
		var user=document.getElementById("sz").value;
		x=x+1;
		document.getElementById("test").value = x;
		if(user>s){
			document.getElementById("jg").value = "你猜大了！";
		}
		else if(user<s){
			document.getElementById("jg").value = "你猜小了！";
		}
		else if(user==s){
			document.getElementById("jg").value = "你猜对了！";
			if(x<2){alert("你运气不错，答对了！");}
			else if (x<5) {
				layer.alert("你真聪明用了,只用了"+x+"次就答出来了！");
			}else if(x<10){
				layer.alert("智力中等偏上,只用了"+x+"次就答出来了！");
			}else if(x<15){
				layer.alert("你的智商有待充值,用了"+x+"次才答出来！");
			}

		}
	}
}
function cx(){
	history.go(0);
}