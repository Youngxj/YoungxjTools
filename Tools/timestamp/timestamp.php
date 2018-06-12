/**
* @act      时间戳转换
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

showTime();
    $("#f_datetime").datetimepicker({
      format: 'yyyy-mm-dd hh:ii',
      language: 'en',
      pickDate: true,
      pickTime: true,
      hourStep: 1,
      minuteStep: 15,
      secondStep: 30,
      inputMask: true,
      linkField:"mirror_field",
  });
    function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return Y+M+D+h+m+s;
    }
    function moment(config) {
    	this._d = new Date(config._d != null ? config._d.getTime() : NaN);
    	if (!this.isValid()) {
    		this._d = new Date(NaN);
    	}
    	if (updateInProgress === false) {
    		updateInProgress = true;
    		hooks.updateOffset(this);
    		updateInProgress = false;
    	}
    }
    function format(timestamp) {
    	var time = new Date(timestamp);
    	var year = time.getFullYear();
    	var month = (time.getMonth() + 1) > 9 && (time.getMonth() + 1) || ('0' + (time.getMonth() + 1))
    	var date = time.getDate() > 9 && time.getDate() || ('0' + time.getDate())
    	var hour = time.getHours() > 9 && time.getHours() || ('0' + time.getHours())
    	var minute = time.getMinutes() > 9 && time.getMinutes() || ('0' + time.getMinutes())
    	var second = time.getSeconds() > 9 && time.getSeconds() || ('0' + time.getSeconds())
    	var YmdHis = year + '-' + month + '-' + date
    	+ ' ' + hour + ':' + minute + ':' + second;
    	return YmdHis;
    }
    $('#btn_state_o').on('click', function (e) {
    	if ($('#o_timestamp').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
    	e.preventDefault();
    	var timestamp = $('#o_timestamp').val();
    	timestamp = timestamp.replace(/^\s+|\s+$/, '');
    	if (/^\d{10}$/.test(timestamp)) {
    		timestamp *= 1000;
    	} else if (/^\d{13}$/.test(timestamp)) {
    		timestamp = parseInt(timestamp);
    	} else {
    		layer.alert('时间戳不正确');
    		return;
    	}
    	var YmdHis = format(timestamp);
    	$('#o_datetime').val(YmdHis);
    });

    $('#btn_state_f').on('click', function (e) {
    	if ($('#mirror_field').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
    	e.preventDefault();
    	$('#f_timestamp').val(Date.parse($('#mirror_field').val()));
    });
    //定义函数：构建要显示的时间日期字符串
    function showTime()
    {   //创建Date对象
       var today = new Date();  //分别取出年、月、日、时、分、秒
       var year = today.getFullYear();
       var month = today.getMonth()+1;
       var day = today.getDate();
       var hours = today.getHours();
       var minutes = today.getMinutes();
       var seconds = today.getSeconds();    //如果是单个数，则前面补0
       month  = month<10  ? "0"+month : month;
       day  = day <10  ? "0"+day : day;
       hours  = hours<10  ? "0"+hours : hours;
       minutes = minutes<10 ? "0"+minutes : minutes;
       seconds = seconds<10 ? "0"+seconds : seconds;
       var str = year+"-"+month+"-"+day+" "+hours+":"+minutes+":"+seconds;
       var datetime = document.getElementById("js_datetime");
       var timestamp = document.getElementById("js_timestamp");
       datetime.innerHTML = str;
       timestamp.innerHTML = Date.parse(str);
       window.setTimeout("showTime()",1000);
   }
   function to_datetime(){
    var text = $('#js_datetime').html();
    $('#mirror_field').val(text);
    $('#f_datetime').val(text);
   }
   function to_timestamp(){
    var text = $('#js_timestamp').html();
    $('#o_timestamp').val(text);
   }