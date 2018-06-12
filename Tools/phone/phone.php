/**
* @act      手机号查询
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入手机号');
$("#btn_state").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$.ajax({
            type: "GET",
            url: "http://139.showji.com/Locating/showji.com20180331.aspx",
            data: "m=" + $('.form-control').val() + "&output=json",
            dataType: "jsonp",
            success: function(result) {
                if (result.QueryResult == "True") {
                    $('.form-controlss').show();
					$('#content').html('<table class="table table-bordered text-capitalize"><tbody><tr><th scope="row">手机号</th><td>'+result.Mobile+'</td></tr><tr><th scope="row">状态</th><td>'+result.QueryResult+'</td></tr><tr><th scope="row">运营商</th><td>'+result.Corp +'</td></tr><tr><th scope="row">地区</th><td>'+result.Province+'</td></tr><tr><th scope="row">城市</th><td>'+result.City+'</td></tr><tr><th scope="row">区号</th><td>'+result.AreaCode+'</td></tr><tr><th scope="row">邮政编码</th><td>'+result.PostCode+'</td></tr></tbody></table>');
                } else {
                    layer.alert('获取失败，请重试！');
                }
            }
        });
});