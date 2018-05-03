<!--
* @act      Tools
* @version  1.0
* @author   youngxj
* @date     2018-04-14
* @url      http://www.youngxj.cn
* 切勿商用,切勿改版权,后果自付
-->
<?php
if ($_SERVER["DOCUMENT_ROOT"] == getcwd()) {
	if(!file_exists('./install/install.lock')){
		exit('你还没有安装！<a href="./install">点击安装<a>');
	}
}else{
	if(!file_exists('../install/install.lock')){
		exit('你还没有安装！<a href="../install">点击安装<a>');
	}
}

/*全局错误隐藏*/
define("DEBUG",true);
if(constant("DEBUG")){error_reporting(0);}


/*支持库*/
include "function.base.php";

/*数据库类库*/
include_once 'Model.php';

//获取后台配置项
$sp = new Model("tools_settings");
//查询一条数据
$tools_settings=$sp->find(array(),"","*");

/*ip黑名单*/
$ip = real_ip();
if(ipadmin($ip,$tools_settings['ip_admin'])){exit($ip);}


if($tools_settings['ua']){
  /*ua+cc开启*/
  session_start();
  define('CC_Defender', 1);
  include 'security.php';
  if(!isset($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT']==''){
    exit('<!DOCTYPE html><html><head><title>正在跳转，请稍等</title></head><body><p>您当前浏览器不支持或操作系统语言设置非中文,无法访问本站！</p></body></html>');
  }
}
/*QQ*/
define('QQ', $tools_settings['qq']);

/*邮箱*/
define('Emails', $tools_settings['emails']);

/*全局工具地址*/
define('Tools_url', '//'.$tools_settings['url'].'/');

/*
 *	全局工具排行
 *	priority desc	权重排行
 *	tools_love desc	热度排行
 *  id desc 		添加顺序排行
 *	tools_number desc	使用次数排行
 */
//$desc = $_COOKIE['desc']!='' ? deepEscape($_COOKIE['desc']) : 'priority';
define('Desc', 'priority desc');


/*
 *	首页样式设置
 *	1	tool.lu样式
 *	2	流行样式
 */

define('templates', deepEscape($_COOKIE['temp']));


/*自定义导航*/
$sp->table_name = "tools_links";
$tools_links=$sp->findall(array('state'=>'0','type'=>'1'),"priority desc","*");

/*分类导航*/
$sp->table_name = "tools_list";
$tools_navsort=$sp->query('select distinct tools_type from tools_list ORDER BY `tools_list`.`tools_type` DESC');//去重统计分类类别

/*全局标题*/
if($id){
  $sp->table_name = "tools_list";
  /*查询工具id相关数据*/
  $as=$sp->find(array("id = '$id'"),"id desc","*");
  $title = $as['title'];
  $keywords = $as['keyword'];
  $subtitle = $as['subtitle'];
  $explains = $as['explains'];
  /*记录访问次数*/
  $numbers = $sp->incr(array('id'=>deepEscape($id)),'tools_number');
  
}else{
  $title = $tools_settings['title'];
  $keywords = $tools_settings['keyword'];
  $temp_state = '1';
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title><?php echo $title;?>-YoungxjTools</title>
  <meta name="keywords" content="<?php echo $keywords;?>" />
  <meta name="description" content="<?php echo $tools_settings['description'];?>" />
  <link rel="shortcut icon" href="/favicon.ico">
  <meta name="Author" Content="Youngxj|杨小杰,admin@youngxj.com">
  <meta name="Copyright" Content="本页版权归Youngxj所有.All Rights Reserved">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/clipboard.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/css/layer/layer.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  
  <style type="text/css">
    /*正文样式*/
    body{font-family: "HanHei SC","PingHei","PingFang SC","微软雅黑","Helvetica Neue","Helvetica","Arial",sans-serif;font-size: 13px;line-height: 1.846;color: #666666;background-color: #ffffff;}
    /*主体头部空*/
    .clearfix{margin-top:40px;}
    /*返回内容设为隐藏*/
    .form-controls{display: none;}
    #form1{text-align: center;display: none;}
    .Explain{padding-top: 10px;}
    /*首行缩进2个字符*/
    .Explain dd{text-indent: 2em;}
    /*主体底部边距*/
    .clearfix{min-height:550px;}
    /*表格文字缩小*/
    .position{font-size: xx-small;}
    /*表格文字自动换行*/
    .table-bordered{word-break:break-all; word-wrap:break-all;}
    .tooltip{font-size:12px;position:absolute;padding:5px;z-index:100000;opacity:.8;font-family:Microsoft Yahei}
    .tipsy-arrow{position:absolute;width:0;height:0;line-height:0;border:6px dashed #000;top:0;left:20%;margin-left:-5px;border-bottom-style:solid;border-top:0;border-left-color:transparent;border-right-color:transparent}
    .tipsy-arrow-n{border-bottom-color:#6F8EC5}
    .tipsy-inner{background-color:#6F8EC5;color:#FFF;max-width:200px;padding:5px 8px 4px 8px;text-align:center;border-radius:3px}
    @media screen and (min-width: 760px){
      .header_nav{display:none;}
    }
    #f_list{position:fixed;right:30px;bottom:60px;transition:bottom ease .3s;z-index:9;font-size:18px;text-align:center;line-height:36px}
	#f_list a.btn{width:36px;height:36px;display:block;text-decoration:none;color:#999;border-radius:5px}
    
    .centent{min-height:500px;}
  </style>
</head>
<body>
<!--[if lt IE 9]>
<div class="notice chromeframe">您的浏览器版本<strong>很旧很旧</strong>，为了正常地访问网站，请升级您的浏览器 <a target="_blank"
href="http://browsehappy.com">立即升级</a>
</div>
<![endif]-->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="../"><img src="/images/logo.png" alt="YoungxjTools" class="logo" width="135px"></a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right"> 
          <?php if(constant("templates")=='1'){?>
          <li class="<?php if(!isset($_GET['sort'])){echo 'active';}?>"><a href="//<?php echo $tools_settings['url'];?>"><?php echo $tools_settings['name'];?></a></li>
          <?php foreach($tools_navsort as $age){?><!--分类导航目录优先-->
          <li <?php if($_GET['sort']==$age['tools_type']){echo 'class="active"';}?>><a href="../?sort=<?php echo $age['tools_type'];?>"><?php echo $age['tools_type'];?></a></li>
          <?php }}?>
          <?php foreach($tools_links as $age){?><!--自定义导航目录-->
          <li><a href="<?php echo $age['url'];?>"><?php echo $age['name'];?></a></li>
          <?php }?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav>