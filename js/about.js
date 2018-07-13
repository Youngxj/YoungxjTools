/**
* @act      关于界面js
* @version  1.0
* @author   youngxj
* @date     2018-05-05
* @url      http://www.youngxj.cn
*/

$(function () {
  /*$("#name").focus();获取焦点*/
  $("#name").keydown(function (event) {
    if (event.which == "13") {
      $("#email").focus();
    }
  });
  $("#email").keydown(function (event) {
    if (event.which == "13") {
      $("#content").focus();
    }
  });
  $("#content").keydown(function (event) {
    if (event.which == "13") {
      $("#up").trigger("click");
    }
  });
  $("#up").click(function () {
    if ($('#name').val()=='') {layer.msg('昵称为空',{icon:3});return false;}
    if ($('#email').val()=='') {layer.msg('邮箱为空',{icon:3});return false;}
    if ($('#content').val()=='') {layer.msg('内容为空',{icon:3});return false;}
    var checks=$('input:checkbox[name="check"]:checked').val();
    if (checks == null) {layer.msg('勾勾都不勾吗？',{icon:3});return false;}
    var name = $("#name").val();
    var email = $("#email").val();
    var content = $("#content").val();
    var check = $('#check').val();
    $.ajax
    ({
      url: "talk_up.php",
      type: "POST",
      dataType: "jsonp",
      data: { name: name, email: email,content:content,check:check},
      success: function (ret) {
        if (ret.state == 'ok') {
         setCookie('user_name',name,365*365);
         setCookie('user_email',email,365*365);
         layer.msg(ret.msg, {
          icon: 1,
          time: 5000
          ,btn: ['刷新页面', '确认']
          ,yes: function(index){
            layer.close(index);
            history.go(0);
          }
        });
         $('#name').val()=='';
         $('#email').val()=='';
         $('#content').val()=='';
       }else {
        layer.msg(ret.msg, {
          icon: 2,
          time: 5000
          ,btn: ['确认']
        });
      }
    }
  });
  });
});
function qqget(){
  var qq_num=document.getElementById("qqinfo").value;
  if(qq_num){
    if(!isNaN(qq_num)){
      $.ajax({
        url:"https://api.yum6.cn/qq.php",
        type:"get",
        data:{qq:qq_num},
        dataType:"json",
        success:function(data){
          document.getElementById("email").value=(qq_num+'@qq.com');
          $('#content').focus();
          if(data.name==null){
            document.getElementById("name").value=('QQ游客');
          }else{
            document.getElementById("name").value=(data['name']==""?'QQ游客':data['name']);
          }
        },
        error:function(err){
          document.getElementById("name").value=('QQ游客');
          document.getElementById("email").value=(qq_num+'@qq.com');
          $('#content').focus();
        }
      });
    }else{
      alert('你输入的好像不是QQ号码');
      $('#qqinfo').focus();
    }
  }else{
  }
}

