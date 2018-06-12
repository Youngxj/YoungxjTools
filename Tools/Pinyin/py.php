/**
* @act      中文转拼音
* @version  1.0
* @author   youngxj
* @date     2018-04-18
* @url      http://www.youngxj.cn
*/

function getPinyin(){
		var value = document.getElementById('textareaCode_zw').value;
		var type = document.querySelector('[name="pinyin_type"]:checked').value;
		var polyphone = document.querySelector('[name="polyphone"]').checked;
		var result = '';
		if(value)
		{
			switch(type)
			{
				case '0': result = pinyinUtil.getPinyin(value, ' ', true, polyphone); break;
				case '1': result = pinyinUtil.getPinyin(value, ' ', false, polyphone); break;
				case '2': result = pinyinUtil.getFirstLetter(value, polyphone); break;
				default: break;
			}
		}
		var html = result;
		if(result instanceof Array)
		{
			html = '';
			result.forEach(function(val)
			{
				html += ''+val+'\r\n';
			});
			html += '';
		}
		document.getElementById('textareaCode_py').innerHTML = html;
	}
	document.getElementById('textareaCode_zw').addEventListener('input', getPinyin);
	document.getElementsByName('polyphone')[0].addEventListener('change', function(e)
	{
		getPinyin();
	});
	document.addEventListener('change', function(e)
	{
		if(e.target.name === 'pinyin_type')
		{
			getPinyin();
		}
	});
	getPinyin();
function copyUrl2(){
    var urlresult=document.getElementById("textareaCode_py");
    urlresult.select(); // 选择对象
    document.execCommand("Copy"); // 执行浏览器复制命令
    layer.msg('手机有一定几率复制失败！');
}

$("#read").click(function() {
    var voiceSrc = "https://tts.baidu.com/text2audio?lan=zh&pid=101&ie=UTF-8&text=" + urlEncode($("#textareaCode_zw").val()) + "&spd=4";
    $("#voice").attr("src", voiceSrc);
    $("#voice")[0].play();
});

// url编码
function urlEncode(str) {
    return (encodeURIComponent(str).replace(/'/g, "%27").replace(/"/g, "%22"));
}