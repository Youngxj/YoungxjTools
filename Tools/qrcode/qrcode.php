/**
* @act      二维码生成
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入内容：');
$('#form-control').bind('input propertychange', function () {
	if($('.form-control').val()==''){$('.form-controls').hide();}else{
		$('.form-controls').show();
		$('.form-controls').html('<img src="https://api.yum6.cn/qrcode.php?url='+$('.form-control').val()+'">');
	}
});
function qrcode(){
	if ($('#qrcode_width').val()||$('#qrcode_height').val()||$('#qrcode_pro').val()||$('#qrcode_bg').val()) {
		$('.form-controls').html('');
		var text = $('#form-control').val();
		var width = $('#qrcode_width').val();
		var height = $('#qrcode_height').val();
		var pro = $('#qrcode_pro').val();
		var bg = $('#qrcode_bg').val();
		var qrcode = new QRCode("form-controls", {
			text: $('#form-control').val(),
			width: $('#qrcode_width').val(),
			height: $('#qrcode_height').val(),
			colorDark : $('#qrcode_pro').val(),
			colorLight : $('#qrcode_bg').val(),
			correctLevel : QRCode.CorrectLevel.H
		});
	}else{
		layer.msg('内容没有填写完整！');
	}
}

function qrcode_decode(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.getJSON("https://api.yum6.cn/deqrcode/?url="+$('.form-control').val(),function(result){ 
		if (result.status=="1") {
			layer.msg('完成！');
			$('.form-controls').show();
			$('.form-controls').html('<br/><textarea id="res-txt" class="form-control" rows="5" placeholder="返回的内容">'+result['data']['RawData']+'</textarea>');
		}else{
		layer.msg('失败，请稍后重试');
}
	});
}