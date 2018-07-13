<?php
ob_start();
/*获取配置项*/
$CONF = require('../function.config.php');

/*全局错误隐藏*/
if($CONF['config']['DEBUG']){error_reporting(0);}
define(VERSION, $CONF['config']['VERSION']);

include '../function.base.php';
require_once  ("../function/Mcrypt.class.php");
require_once  ("../Model.php");
if(!isset($_COOKIE['cookie_user'])){
  exit("<script language='javascript'>window.location.href='login.php';</script>");
}
$login = new Model("tools_user");
$user_token = $login->find(array('id'=>'1'),"","*");
$miw_token = Mcrypt::decode($_COOKIE['cookie_user'],$user_token['user_token']);

if(!$miw_token){
  exit("<script language='javascript'>window.location.href='login.php';</script>");
}

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>Tools Admin</title>
  <meta charset="UTF-8" />
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <script type="text/javascript" src="layui/layui.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/fullcalendar.css" />
  <link rel="stylesheet" href="css/jquery.jscrollpane.css" /> 
  <link rel="stylesheet" href="css/unicorn.css" />
  <link rel="stylesheet" href="css/jquery-ui.css" />
  <link rel="stylesheet" href="css/icheck/flat/blue.css" />
  <link rel="stylesheet" href="css/select2.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="js/respond.min.js"></script>
<![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44987299-1', 'bootstrap-hunter.com');
  ga('send', 'pageview');

</script></head>  
<body data-color="grey" class="flat">
  <div id="wrapper">
    <div id="header">
      <h1><a href="../index.php">Tools Admin</a></h1> 
      <a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>  
    </div>

    <div id="user-nav">
      <ul class="btn-group">
        <li class="btn" ><a title="" href="admin.php" ><i class="fa fa-user"></i> <span class="text">管理员</span></a></li>
        <li class="btn"><a title="" href="settings.php"><i class="fa fa-cog"></i> <span class="text">设置</span></a></li>
        <li class="btn"><a title="" href="loginout.php"><i class="fa fa-share"></i> <span class="text">退出</span></a></li>
      </ul>
    </div>
    <script>

    </script>
    <div id="switcher">
      <div id="switcher-inner">
        <h3>皮肤设置</h3>
        <h4>颜色</h4>
        <p id="color-style">
          <a data-color="orange" title="Orange" class="button-square orange-switcher" href="#"></a>
          <a data-color="turquoise" title="Turquoise" class="button-square turquoise-switcher" href="#"></a>
          <a data-color="blue" title="Blue" class="button-square blue-switcher" href="#"></a>
          <a data-color="green" title="Green" class="button-square green-switcher" href="#"></a>
          <a data-color="red" title="Red" class="button-square red-switcher" href="#"></a>
          <a data-color="purple" title="Purple" class="button-square purple-switcher" href="#"></a>
          <a href="#" data-color="grey" title="Grey" class="button-square grey-switcher"></a>
        </p>
        <h4>快捷导航</h4>
        <h5>gogogo</h5>
        <p id="pattern-switch">
          <a data-pattern="pattern1" style="background-image:url('assets/img/patterns/pattern1.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern2" style="background-image:url('assets/img/patterns/pattern2.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern3" style="background-image:url('assets/img/patterns/pattern3.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern4" style="background-image:url('assets/img/patterns/pattern4.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern5" style="background-image:url('assets/img/patterns/pattern5.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern6" style="background-image:url('assets/img/patterns/pattern6.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern7" style="background-image:url('assets/img/patterns/pattern7.png');" class="button-square" href="#"></a>
          <a data-pattern="pattern8" style="background-image:url('assets/img/patterns/pattern8.png');" class="button-square" href="#"></a>
        </p>
        <h4 class="visible-lg">布局类型</h4>
        <p id="layout-type">
          <a data-option="flat" class="button" href="#">扁平</a>
          <a data-option="old" class="button" href="#">老板</a>                    
        </p>
      </div>
      <div id="switcher-button">
        <i class="fa fa-cogs"></i>
      </div>
    </div>

    <style>#content{min-height:800px;}</style>
    <div id="sidebar">
      <ul>
        <li <?php if(strpos($_SERVER['PHP_SELF'],'index')){echo 'class="active"';}?>><a href="index.php"><i class="fa fa-home"></i> <span>主页</span></a></li>
        <li class="submenu <?php if(strpos($_SERVER['PHP_SELF'],'tools_list')||strpos($_SERVER['PHP_SELF'],'tools_inc')||strpos($_SERVER['PHP_SELF'],'tools_update')||strpos($_SERVER['PHP_SELF'],'tools_down')){echo 'open';}?>">
          <a href="#"><i class="fa fa-th-list"></i> <span>工具管理</span> <i class="arrow fa fa-chevron-right"></i></a>
          <ul>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'tools_list')){echo 'class="active"';}?>><a href="tools_list.php" >工具列表</a></li>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'tools_inc')){echo 'class="active"';}?>><a href="tools_inc.php" >新增工具</a></li>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'tools_update')){echo 'class="active"';}?>><a href="tools_update.php" >上传工具</a></li>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'tools_down')){echo 'class="active"';}?>><a href="tools_down.php" >应用中心</a></li>
          </ul>
        </li>
        <li class="submenu <?php if(strpos($_SERVER['PHP_SELF'],'links_list')||strpos($_SERVER['PHP_SELF'],'links_inc')){echo 'open';}?>">
          <a href="#"><i class="fa fa-th-list"></i> <span>友情链接管理</span> <i class="arrow fa fa-chevron-right"></i></a>
          <ul>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'links_list')){echo 'class="active"';}?>><a href="links_list.php">友情链接列表</a></li>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'links_inc')){echo 'class="active"';}?>><a href="links_inc.php">新增链接</a></li>
          </ul>
        </li>
        <li class="submenu <?php if(strpos($_SERVER['PHP_SELF'],'log_list')||strpos($_SERVER['PHP_SELF'],'log_inc')){echo 'open';}?>">
          <a href="#"><i class="fa fa-th-list"></i> <span>时间轴管理</span> <i class="arrow fa fa-chevron-right"></i></a>
          <ul>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'log_list')){echo 'class="active"';}?>><a href="log_list.php">时间轴列表</a></li>
            <li <?php if(strpos($_SERVER['PHP_SELF'],'log_inc')){echo 'class="active"';}?>><a href="log_inc.php">新增时间轴</a></li>
          </ul>
        </li>
        <li <?php if(strpos($_SERVER['PHP_SELF'],'talk_list')){echo 'class="active"';}?>>
          <a href="talk_list.php"><i class="fa fa-cog"></i> <span>留言管理</span></a>
        </li>
        <li <?php if(strpos($_SERVER['PHP_SELF'],'tools_temp')){echo 'class="active"';}?>>
          <a href="tools_temp.php"><i class="fa fa-cog"></i> <span>主题设置</span></a>
        </li>
        <li <?php if(strpos($_SERVER['PHP_SELF'],'settings')){echo 'class="active"';}?>>
          <a href="settings.php"><i class="fa fa-cog"></i> <span>网站基本信息配置</span></a>
        </li>
      </ul>

    </div>