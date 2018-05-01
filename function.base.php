<?php
error_reporting(0);
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
 * 转换HTML代码函数
 *
 * @param unknown_type $content
 * @param unknown_type $wrap 是否换行
 */
function htmlClean($content, $nl2br = true) {
  $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
  if ($nl2br) {
    $content = nl2br($content);
  }
  $content = str_replace('  ', '&nbsp;&nbsp;', $content);
  $content = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $content);
  return $content;
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
//ip黑名单
function ipadmin($ip,$ip_admin){
	$ipblack = explode(",",$ip_admin);
	if (in_array($ip, $ipblack)){
		return true;
	}else{
		return false;
	}
}
?>