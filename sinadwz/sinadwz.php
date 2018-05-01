/**
* @act      新浪短网址
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/
<?php
include '../function/function.php';
encryption();
?>
control('请输入长网址');
 
function urlEncode(String) {
    return encodeURIComponent(String).replace(/'/g,"%27").replace(/"/g,"%22");	
}
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.ajax({
            type: "GET",
            url: "get.php?longUrl="+urlEncode($('.form-control').val()),
            dataType: "jsonp",
			cache: false,
            success: function (data) {
                if (data.urls[0].url_short){
                    if(!(typeof data.urls === undefined || typeof data.urls == "undefined"))   //防止短网址失败
                    {
                        $('#content').html(data.urls[0].url_short);
                    }
                }
            }
        });
});