/**
* @act      群昵称
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

control('请输入内容：');
$("#btn_echo").click(function(){
	if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	var a=$('#withdraw_echo').val();
	var b='("‮("‭';
	var q=(a+b);
	$('#form-control_content').html(q);
	$('.form-controls').show();
});
$("#btn_with").click(function(){
	if ($('#withdraw_front').val() == ""||$('#withdraw_behind').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	$('.form-controls').show();
	var name = $('#withdraw_front').val();
	var suffix = $('#withdraw_behind').val();

	var output = document.querySelector("#form-control_content");
	output.value = String.fromCharCode(65166)+suffix +String.fromCharCode(65166) + name;
	output.setSelectionRange(0, output.value.length);
});