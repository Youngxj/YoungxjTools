<?php
function real_ip(){
  //获取用户真实IP
  $ip = $_SERVER['REMOTE_ADDR'];
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
    foreach ($matches[0] AS $xip) {
      if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
        $ip = $xip;
        break;
      }
    }
  } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
  } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
    $ip = $_SERVER['HTTP_X_REAL_IP'];
  }
  return $ip;
}
?>
<?php
//随机小数
function randomFloat($min = 0, $max = 1) {
  return '0.'.rand($min,$max);
}
?>

<?php
//js访问权限加密
function encryption($echo = '0',$string = 'YoungxjTools'){
  if($echo){return $string;}
  if($_GET['rand']!= md5(md5((int)(time()/10)).$string)){
    exit();
  }
  if(!isset($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT']==''){//判断ua为空
    exit();
  }
  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER']==''){//判断来路为空
    exit();
  }
}
?>

<?php
/**
 * 深度转义数据
 * @param array $input  待转义的数组，$_GET,$_POST
 * @return array        处理过的数组
 */
function deepEscape($input){
  foreach ($input as $key => $value) {
    if (is_array($value)) {
      //递归调用
      $input[$key] = deepEscape($value);
    }else{
      //转义
      $input[$key] = addslashes($value);
      // HTML实体
      $input[$key] = htmlClean($value);
    }
  }
  return $input;
}
?>

<?php
/**
 * 时间转化函数
 *
 * @param $datetemp
 * @param $dstr
 * @return string
 */
function smartDate($datetemp, $dstr = 'Y-m-d H:i:s') {
  $op = '';
  $sec = time() - $datetemp;
  $hover = floor($sec / 3600);
  if ($hover == 0) {
    $min = floor($sec / 60);
    if ($min == 0) {
      $op = $sec . ' 秒前';
    } else {
      $op = "$min 分钟前";
    }
  } elseif ($hover < 24) {
    $op = "约 {$hover} 小时前";
  } else {
    $op = date($dstr, $datetemp);
  }
  return $op;
}
?>

<?php
function getParam($m,$n=''){
  //获取get 或者 post请求的值，这里判断了字符串并清除所有特殊字符
  return trim($m&&is_string($m)?isset($_POST[$m])?$_POST[$m]:(isset($_GET[$m])?$_GET[$m]:$n):$n);
}
?>

<?php
function echoJson($o){
  //兼容jsonp请求，最后输出值
  $p=getParam('callback');
  if($p!=''){
    die($p.'('.$o.')');
  }else{
    die($o);
  }
}
?>

<?php
function talk_up(){
  $redis = new Redis();
  $redis->connect('127.0.0.1', 6379);
  $key = real_ip();

  function error(){
  //输出为error
    $arr = array ('state'=>'error','msg'=>'失败');
    echoJson(json_encode($arr));
  }

  if (getParam('name')&&getParam('email')&&getParam('content')&&getParam('check')) {
    $name = getParam('name');
    $email = getParam('email');
    $content = deepEscape(getParam('content'));
    $date = date("Y-m-d H:i:s");
    $ip = real_ip();
    include 'Model.php';
    $up = new Model("tools_talk");
    $qu = $up->find(array("content = '".$content."'"),"","*");
    if($qu){
      $arr = array ('state'=>'false','msg'=>'该评论已存在');
      echoJson(json_encode($arr));
    }

    if($redis->exists($key)){
      $redis->incr($key);
      if($redis->get($key) >= 1){
        $redis->incr($key);
        $redis->expire($key,60);
        $arr = array ('state'=>'error','msg'=>'提交过快');
        echoJson(json_encode($arr));
      }  
    }else{
      $redis->set($key,1);
      $redis->expire($key,60);
    }
    $newrow = array(
      'name' => $name,
      'content' => $content,
      'emails' => $email,
      'times' => $date,
      'ip' =>$ip,
      );
    $up_talk=$up->create($newrow);
    if ($up_talk) {
      include 'email.php';
      $mail->addAddress($email,'');
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
    </style><div class="qmbox"><div class="box"><div class="header"></div><div class="content"><p class="no_indent" style="color:#383838">YoungxjTools收到一条来自'.$name.'的评论</p><br><p style="line-height:25px;padding:10px;background:#5C96BE;border-radius:4px;color:#fff;">'.$content.'</p><p class="no_indent"><span>评论作者：'.$name.'</span><span>邮件地址：'.$email.'</span><span>评论者ip：'.real_ip().'</span></p><table cellspacing="0" class="table"> </table><div class="btnn"><a href="http://tools.yum6.cn/tools_admin/talk_list.php" target="_blank">审核回复</a><a href="http://tools.yum6.cn" target="_blank">查看YoungxjTools</a><a href="http://www.youngxj.cn" target="_blank">杨小杰博客</a></div></div><div class="footer clear"></div></div></div>  <!--<![endif]--><style></style>  </div>';
    $status = $mail->send();
    $arr = array ('state'=>'ok','msg'=>'提交成功');
    echoJson(json_encode($arr));
  }else{
    error();
  }
}else{
  error();
}
}
?>