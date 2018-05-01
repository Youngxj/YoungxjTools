/**
* @act      新浪图床上传
* @version  1.0
* @author   youngxj
* @date     <?php echo date("Y-m-d");?>
* @url      http://www.youngxj.cn
*/

$(document).ready(function() {
	$("input[type='file']").change(function(e) {
		images_upload(this.files)
	});
	var obj = $('body');
	obj.on('dragenter', function(e) {
		e.stopPropagation();
		e.preventDefault()
	});
	obj.on('dragover', function(e) {
		e.stopPropagation();
		e.preventDefault()
	});
	obj.on('drop', function(e) {
		e.preventDefault();
		images_upload(e.originalEvent.dataTransfer.files)
	})
});
var url_upload = function() {
	var urls = $("#urls").val();
	var url_arr = urls.split("\n");
	if (urls == "" || url_arr.length == 0) {
		layer.alert("请贴入需要上传的网络图片地址.");
		return;
	}
	$('#url_upload_model').modal('hide');
	$('.mselector > button')[1].innerHTML = '上传中';
	for (var i = 0; i < url_arr.length; i++) {
		$.ajax({
			url: 'https://api.yum6.cn/sinaimg.php',
			type: 'GET',
			data: {
				img: url_arr[i]
			},
			cache: false,
			dataType: 'json',
			success: function(data) {
				layer.msg('上传中');
				if (typeof data.pid != 'undefined') {
					$('#url-res-txt').append('https://ws3.sinaimg.cn/large/'+data.pid + '.jpg\n');
					$('.mselector > button')[1].innerHTML = '成功 ' + (i + 1) + '/' + url_arr.length;
					var apc = "<img src='" + data.url + "' alt='" + data.url + "'><p><a  id='copy' data-clipboard-target='#copy' href='#' title='点击复制链接'>https://ws3.sinaimg.cn/large/" + data.pid + ".jpg</a></p><br>";
					$('.preview').css('display', 'block');
					$(".preview>hr").after(apc)
				} else {
					$('.mselector > button')[1].innerHTML = '第' + (i + 1) + '张上传失败'
				} if (typeof data.pid != 'undefined') {
					$('.mselector > button')[1].innerHTML = '上传成功'
				} else {
					$('.mselector > button')[1].innerHTML = '上传失败';
					$('#url-res-txt').append(data.code + '\n');
					layer.alert(data.code)
				}
			},
			error: function(XMLResponse) {
				layer.alert("error:" + XMLResponse.responseText)
			}
		})
	}
};
var images_upload = function(files) {
	var flag = 0;
	$('textarea').empty();
	$(files).each(function(key, value) {
		$('.mselector > button')[0].innerHTML = '上传中';
		image_form = new FormData();
		image_form.append('file', value);
		$.ajax({
			url: 'https://api.yum6.cn/sinaimg.php?type=multipart',
			type: 'POST',
			data: image_form,
			mimeType: 'multipart/form-data',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			success: function(data) {
				flag++;
				if (typeof data.url != 'undefined') {
					$('#url-res-txt').append('https://ws3.sinaimg.cn/large/'+data.pid + '.jpg\n');
					$('.mselector > button')[0].innerHTML = '成功 ' + flag + '/' + files.length;
					var apc = "<img src='" + data.url + "' alt='" + data.url + "'><p><a  id='copy"+ flag +"' data-clipboard-target='#copy"+ flag +"' href='#' title='点击复制链接' >https://ws3.sinaimg.cn/large/" + data.pid + ".jpg</a></p><br>";
					$('.preview').css('display', 'block');
					$(".preview>hr").after(apc)
				} else {
					$('.mselector > button')[0].innerHTML = '第' + flag + '张上传失败'
				} if (flag == $("input[type='file']")[0].files.length) {
					if (typeof data.url != 'undefined') {
						$('.mselector > button')[0].innerHTML = '上传成功'
					} else {
						$('.mselector > button')[0].innerHTML = '上传失败';
						$('#url-res-txt').append(data.code + '\n');
						layer.alert(data.code)
					}
				}
			},
			error: function(XMLResponse) {
				layer.alert("error:" + XMLResponse.responseText)
			}
		})
	})
};
document.onpaste = function(e) {
	var data = e.clipboardData;
	for (var i = 0; i < data.items.length; i++) {
		var item = data.items[i];
		if (item.kind == 'file' && item.type.match(/^image\//i)) {
			var blob = item.getAsFile();
			images_upload(blob)
		}
	}
}



var clipboard = new ClipboardJS('a');
clipboard.on('success',function(e){
 e.clearSelection();
 layer.msg('复制成功！');
 });
clipboard.on('error',function(e){
 e.clearSelection();
 layer.msg('复制失败！');
 });
