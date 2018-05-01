<?php
@header('Content-Type: text/html; charset=UTF-8');
require_once  ("../Model.php");
$login = new Model("tools_user");
include "../function.base.php";
$cookie_user = str_replace('YoungxjTools'.md5((int)(time()/86400)),'',base64_decode($_COOKIE["cookie_user"]));
$username = $login->find(array('user'=>$cookie_user),"","user");
if($username){
  exit("<script language='javascript'>window.location.href='index.php';</script>");
}
if (getParam('user')&&getParam('password')) {
  $user= getParam('user');
  $pass= md5(getParam('password').base64_encode('YoungxjTools'));
  $row = $login->find(array('user'=>$user,'password'=>$pass),"","user,password");
  if($row){
    setcookie('cookie_user', base64_encode($user.'YoungxjTools'.md5((int)(time()/86400))),time()+3600*24);
    exit("<script language='javascript'>window.location.href='index.php';</script>");
  }else{
    exit("<script language='javascript'>alert('用户名或密码不正确！');window.location.href='login.php';</script>");
  }
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>用户登录</title>
  <!-- Bootstrap 核心 CSS 文件 -->
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <style>
    body{background:url('//api.yum6.cn/soimg/soimg.php');background-repeat:no-repeat;background-attachment:fixed;}
    /*web background*/
    .container{
      display:table;
      height:100%;
    }

    .row{
      display: table-cell;
      vertical-align: middle;
    }
    /* centered columns styles */
    .row-centered {
      text-align:center;
    }
    .col-centered {
      display:inline-block;
      float:none;
      margin-right:-4px;
    }
    .row-centered{
      z-index: 0;/* 为不影响内容显示必须为最高层 */
      position: relative;
      overflow: hidden;
    }
    .row-centered:after {
      content: "";/* 必须包括 */
      position: absolute;/* 固定模糊层位置 */
      left: -100%;/* 回调模糊层位置 */
      top: -100%;/* 回调模糊层位置 */
      filter: blur(20px);/* 值越大越模糊 */
      z-index: -2;/* 模糊层在最下面 */
    }
    .well{
      background-color: rgba(0, 0, 0, 0.2);/* 为文字更好显示，将背景颜色加深 */
    }
    .well {
      position: relative;
      margin: 0 auto;
      padding: 1em;
      max-width: 30em;
      border-radius: .3em;
      box-shadow: 0 0 0 1px hsla(0,0%,100%,.3) inset,
        0 .5em 1em rgba(0, 0, 0, 0.6);
      text-shadow: 0 1px 1px hsla(0,0%,100%,.3);
      background: hsla(0,0%,100%,.3);
      overflow: hidden;
      /*    -webkit-filter: blur(3px);
      filter: blur(3px);*/
    }
    .well::before {
      content: '';
      position: absolute;
      top: 0; right: 0; bottom: 0; left: 0;
      z-index: -1;
      -webkit-filter: blur(20px);
      filter: blur(20px);
      margin: -30px;
      /*background: rgba(255,0,0,.5);*/
    }
    #sizing-addon1{background:rgba(255, 0, 0, 0);}
  </style>
</head>

<body>
  <div class="container">
    <div class="row row-centered">
      <div class="well col-md-6 col-centered">
        <h2>欢迎登录</h2>
        <form action="login.php" method="post" role="form" >
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
          <input type="text" class="form-control" id="user" name="user" placeholder="请输入用户ID"/>
        </div>
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码"/>
        </div>
        <br/>
        <button type="submit" class="btn btn-success btn-block">登录</button>
      </form>
    </div>
  </div>
</div>


<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
