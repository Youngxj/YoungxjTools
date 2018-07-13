<?php
/*获取配置项*/
$CONF = require('function.config.php');

/*全局错误隐藏*/
if($CONF['config']['DEBUG']){error_reporting(0);}
include 'function.base.php';
/*ua+cc开启*/
session_start();
define('CC_Defender', 1);
include 'function/security.php';
if(!isset($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT']==''){
  exit('<!DOCTYPE html><html><head><title>正在跳转，请稍等</title></head><body><p>您当前浏览器不支持或操作系统语言设置非中文,无法访问本站！</p></body></html>');
}
/*redis 开始*/
// $redis = new Redis(); //初始化
// $redis->connect('127.0.0.1', 6379);    //连接Redis
// $key = real_ip(); //将用户访问ip设置为key
/*redis 结束*/
$key_md5  = md5(real_ip());
if (isset($_COOKIE[$key_md5])&&isset($_COOKIE[$key_md5.'_timeout'])){
  $time_out = $_COOKIE[$key_md5.'_timeout']-time();
  $arr = array ('state'=>'error','msg'=>$time_out.'秒后重试');
  echoJson(json_encode($arr));
}

function error(){
  //输出为error
  $arr = array ('state'=>'error','msg'=>'失败');
  echoJson(json_encode($arr));
}

function ok(){
  //输出为ok
  $key_md5  = md5(real_ip());
  setcookie($key_md5, $key_md5, time()+60);
  setcookie($key_md5.'_timeout', time()+60, time()+60);
  $arr = array ('state'=>'ok','msg'=>'提交成功');
  echoJson(json_encode($arr));
}
if(!isEmail(getParam('email'))){
  $arr = array ('state'=>'error','msg'=>'邮箱地址不正确');
  echoJson(json_encode($arr));
}
if (getParam('name')&&getParam('email')&&getParam('content')&&getParam('check')) 
{
  $name = htmlClean(getParam('name'));
  $email = htmlClean(getParam('email'));
  $content = htmlClean(getParam('content'));
  $date = date("Y-m-d H:i:s");
  $ip = real_ip();
  include 'Model.php';
  $up = new Model("tools_talk");
  $qu = $up->find(array("content = '".$content."'"),"","*");
  if($qu)
  {
    $arr = array ('state'=>'false','msg'=>'该评论已存在');
    echoJson(json_encode($arr));
  }

  $newrow = array(
    'name' => $name,
    'content' => $content,
    'emails' => $email,
    'times' => $date,
    'ip' =>$ip,
  );
  $smtp = new Model("tools_smtp");
  $smtp_value = $smtp->find(array(),"","*");
  if ($smtp_value['host']!=''&&$smtp_value['port']!=''&&$smtp_value['fromname']!=''&&$smtp_value['username']!=''&&$smtp_value['password']!=''&&$smtp_value['add_email']!=''&&$smtp_value['sub']!='')
  {
    $smtp_state = '1';
  }
  $up_talk=$up->create($newrow);

  if ($up_talk&&$smtp_state == '1') 
  {
    include 'email.php';
    $sett = new Model("tools_settings");
    $setting = $sett->find(array(),"","*");
    $mail->addAddress($emails_val['add_email'],'');
    $mail->Subject = 'YoungxjTools收到一条来自'.$name.'的评论';
    $mail->Body = '<div id="mailContentContainer" style="font-size: 14px; padding: 0px; height: auto; min-height: auto; font-family: &quot;lucida Grande&quot;, Verdana; position: relative; zoom: 1; margin-right: 170px;">                <style type="text/css"> .qmbox{margin:0;padding:0;font-family:微软雅黑;background-color:#fff}
    .qmbox a{text-decoration:none;}
    .qmbox .box{position:relative;max-width:100%;padding:0;margin:0 auto;border:1px solid #ccc;font-size:13px;color:#333;}
    .qmbox .header{width:100%;padding-top:50px;background:url("http://www.youngxj.cn/content/plugins/kl_sendmail/bian.jpg") repeat-x;}
    .qmbox .logo{float:right;padding-right:50px;}
    .qmbox .clear{clear:both;}
    .qmbox .content{max-width:100%;padding:0 20px;}
    .qmbox .admin{padding:10px 10px 10px 0;word-break:keep-all;line-height:30px;}
    .qmbox .admin a{width: auto;height: auto;border: 2px #eee solid;color: #FFF;background: #87A7D6;padding: 4px 10px;cursor: pointer;border-radius: 5px;text-decoration:none !important;}
    .qmbox .content p{line-height:40px;word-break:break-all;}
    .qmbox .content ul{padding-left:40px;}
    .qmbox .xiugai{height:50px;line-height:30px;font-size:16px;}
    .qmbox .xiugai a{color:#0099ff;}
    .qmbox .fuzhi{word-break:break-all;color:#b0b0b0;}
    .qmbox .table{border:1px solid #ccc;border-left:0;border-top:0;border-collapse:collapse;}
    .qmbox .table td{border:1px solid #ccc;border-right:0;border-bottom:0;padding:6px;min-width:160px;}
    .qmbox .gray{background:#f5f5f5;}
    .qmbox .no_indent{font-weight:bold;line-height:40px;color:#737171}
    .qmbox .no_indent a{text-decoration:none !important;color:#737171}
    .qmbox .no_indent span{padding-right:20px;}
    .qmbox .no_after{height:40px;line-height:40px; text-align:right;font-weight:bold}
    .qmbox .btnn{padding:50px 0 0 0;font-weight:bold}
    .qmbox .btnn a{padding-right:20px;text-decoration:none !important;color:#000;}
    .qmbox .need{background:#fa9d00;}
    .qmbox .noneed{background:#3784e0;}
    .qmbox .footer{width:100%;height:10px;padding-top:20px;background:url("http://www.youngxj.cn/content/plugins/kl_sendmail/bian.jpg") repeat-x left bottom;}
    </style><div class="qmbox"><div class="box"><div class="header"></div><div class="content"><p class="no_indent" style="color:#383838">YoungxjTools收到一条来自'.$name.'的评论</p><br><p style="line-height:25px;padding:10px;background:#5C96BE;border-radius:4px;color:#fff;">'.$content.'</p><p class="no_indent"><span>评论作者：'.$name.'</span><span>邮件地址：'.$email.'</span><span>评论者ip：'.real_ip().'</span></p><table cellspacing="0" class="table">	</table><div class="btnn"><a href="'.$setting['url'].'/tools_admin/talk_list.php" target="_blank">审核回复</a><a href="'.$setting['url'].'" target="_blank">查看YoungxjTools</a><a href="http://www.youngxj.cn" target="_blank">杨小杰博客</a></div></div><div class="footer clear"></div></div></div>  <!--<![endif]--><style></style>  </div>';
    $status = $mail->send();
    if($status){
      ok();
    }else{
      $arr = array ('state'=>'error','msg'=>'邮件配置错误');
      echoJson(json_encode($arr));
    }
  }elseif ($up_talk) {
    ok();
  }else{
    error();
  }
}else{
  error();
}