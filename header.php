<!--
* @act      Tools
* @version  1.3.0
* @author   youngxj
* @date     2018-06-30
* @url      https://www.youngxj.cn
* 切勿商用,切勿改版权,后果自付
-->
<?php
header("Content-type:text/html;charset=utf-8");
//判断是否已安装
define('APP_PATH',realpath(dirname(__FILE__)));
define('DS',DIRECTORY_SEPARATOR);
if(!is_file(APP_PATH.DS.'install/install.lock')){
  @header("location:install/index.php");
}

/*支持库*/
include_once "function.base.php";

/*数据库类库*/
include_once 'Model.php';

/*获取配置项*/
$CONF = require('function.config.php');


/*全局错误隐藏*/
if($CONF['config']['DEBUG']){error_reporting(0);}


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
  include 'function/security.php';
  if(!isset($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT']==''){
    exit('<!DOCTYPE html><html><head><title>正在跳转，请稍等</title></head><body><p>您当前浏览器不支持或操作系统语言设置非中文,无法访问本站！</p></body></html>');
  }
}

if ($tools_settings['tz']=='1') {
  if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false){
    $a='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
    echo '<!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>请使用浏览器打开</title>
    <script src="https://open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
    <script type="text/javascript"> mqq.ui.openUrl({ target: 2,url: "'.$a.'"}); </script>
    </head>
    <body>'.$tools_settings['tz_msg'].'</body>
    </html>';
    exit;
  }
}
/*QQ*/
define('QQ', $tools_settings['qq']);

/*邮箱*/
define('Emails', $tools_settings['emails']);

/*全局工具地址*/
define('Tools_url',$tools_settings['url']);


/*
 *  全局工具排行
 *  priority desc 权重排行
 *  tools_love desc 热度排行
 *  id desc     添加顺序排行
 *  tools_number desc 使用次数排行
 */
$tools_priority = $tools_settings['tools_priority'];
if($tools_priority=='id desc'){
  $priority = 'id desc';
}elseif ($tools_priority=='priority desc') {
  $priority = 'priority desc';
}elseif ($tools_priority=='tools_love desc') {
  $priority = 'tools_love desc';
}elseif ($tools_priority=='tools_number desc') {
  $priority = 'tools_number desc';
}elseif ($tools_priority=='1') {
  $priority = $_COOKIE['sort_priority']!='' ? htmlClean($_COOKIE['sort_priority']) : 'priority desc';
}elseif ($tools_priority=='rand_priority') {
  $arr = array('id desc','priority desc','tools_love desc','tools_number desc');
  $priority = array_rand($arr,1);
}

define('Desc', $priority);


/*
 *  首页样式设置
 *  1 tool.lu样式
 *  2 流行样式
 */

if ($tools_settings['templates']==0) {
  switch ($_COOKIE['temp']) {
    case '1':
    $temp = '1';
    break;
    case '2':
    $temp = '2';
    break;
    case '3':
    $temp = '3';
    break;
    default:
    setcookie('temp','1');$temp = '1';
    break;
  }
}else{
  $temp = $tools_settings['templates'];
}

define('templates', $temp);



/**
 * 搜索框样式
 * 1 模糊搜索框
 * 2 导航简约搜索框
 */
define('search',$tools_settings['search']);

/*自定义导航*/
$sp->table_name = "tools_links";
$tools_links=$sp->findall(array('state'=>'0','type'=>'1'),"priority desc","*");

/*分类导航*/
$sp->table_name = "tools_list";
$tools_navsort=$sp->query('select distinct tools_type from tools_list ORDER BY `tools_list`.`tools_type` DESC');  //去重统计分类类别

/*全局标题*/
if($id){
  $sp->table_name = "tools_list";
  /*查询工具id相关数据*/
  $as=$sp->find(array("tools_url = '$id'"),"id desc","*");
  $tools_type = $as['tools_type'];
  $navs = $sp->findall(array("tools_type = '$tools_type'"),"id desc","*");
  $title = $as['title'];
  $keywords = $as['keyword'];
  $subtitle = $as['subtitle'];
  $explains = $as['explains'];
  /*记录访问次数*/
  $numbers = $sp->incr(array('tools_url'=>$id),'tools_number');
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
  <link rel="shortcut icon" href="<?php echo Tools_url;?>/favicon.ico">
  <meta name="Author" Content="Youngxj|杨小杰,admin@youngxj.com">
  <meta name="Copyright" Content="本页版权归Youngxj所有.All Rights Reserved">
  <link rel="stylesheet" type="text/css" href="<?php echo Tools_url;?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Tools_url;?>/font-awesome-4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="<?php echo Tools_url;?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo Tools_url;?>/js/clipboard.min.js"></script>
  <script type="text/javascript" src="<?php echo Tools_url;?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo Tools_url;?>/css/layer/layer.js"></script>
  <script type="text/javascript" src="<?php echo Tools_url;?>/js/main.js"></script>
  
  <style type="text/css">
  /*正文样式*/
  body{font-family: "HanHei SC","PingHei","PingFang SC","微软雅黑","Helvetica Neue","Helvetica","Arial",sans-serif;font-size: 13px;line-height: 1.846;color: #666666;background-image: url(/images/background.png)}
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
  @media screen and (max-width: 720px) { 
    #f_list {right:0px;} 
  }
  .centent{min-height:500px;}
  /*logo居中*/
  @media screen and (min-width: 768px) { 
    .navbar-header{position: absolute;top: 50%;transform: translateY(-50%);}
  }
  .search{padding-left:5px;}
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
      <a href="<?php echo Tools_url;?>"><img src="<?php echo Tools_url;?>/images/logo.png" alt="YoungxjTools" class="logo" width="135px"></a>
    </div><!-- /.navbar-header -->
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php foreach($tools_links as $age){?><!--自定义导航目录-->
        <li><a href="<?php echo $age['url'];?>" target="_blank"><?php echo $age['name'];?></a></li>
      <?php }?>
      <br/>
      <?php if (search=='2') {?>
        <!--搜索框-->
        <div style="float: inherit;text-align:center;">
          <form action="<?php echo Tools_url;?>/index.php" method="get" id="search">
            <input name="query" value="搜索" onblur="if(this.value==''){this.value='搜索';}" onfocus="if(this.value=='搜索'){this.value=''}"  class="search" type="text">
            <input value="搜索"  type="submit">
          </form>
        </div>
        <!--搜索框end-->
      <?php }?>
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container -->
</nav>