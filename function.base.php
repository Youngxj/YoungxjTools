<?php
error_reporting(0);

define(VERSION, '1.2');

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

<?php
/**
 * 页面跳转
 */
function Jump($directUrl) {
  header("Location: $directUrl");
  exit;
}
?>


<?php
//相关工具
function mores($name,$type,$url){?>
  <style>
  .more ul{list-style:none;margin:0;padding-right:40px;}
  .more li{display:inline;padding: 0px 2px 0px 2px;}
</style>
<div class="table text-center more">
  <ul>
    <li>更多相关工具:</li>
    <?php foreach($type as $ag){
      if($name!=$ag['tools_url']){echo '<li><a href="'.$url.'/'.$ag['tools_url'].'" id="more" >'.$ag['title'].'</a></li>';}
    }?>
  </ul>
</div>
<?php }?>

<?php
function generate_password( $length = 8 ) { 
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
  $password = ""; 
  for ( $i = 0; $i < $length; $i++ ) 
  { 
    $password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
  } 
  return $password; 
}
?>

<?php
function curl_request($url,$post='',$cookie='', $returnCookie=0,$ua='Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',$referer='http://baidu.com/'){
  //curl模拟请求
  //参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies，参数5：自定义UA，参数6：自定义来路
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, $ua);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
  curl_setopt($curl, CURLOPT_REFERER, $referer);
  if($post) {
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
  }
  if($cookie) {
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
  }
  curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($curl);
  if (curl_errno($curl)) {
    return curl_error($curl);
  }
  curl_close($curl);
  if($returnCookie){
    list($header, $body) = explode("\r\n\r\n", $data, 2);
    preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
    $info['cookie']  = substr($matches[1][0], 1);
    $info['content'] = $body;
    return $info;
  }else{
    return $data;
  }
}
?>

<?php
//Unescape解码
function utf8_urldecode($str) 
{
  $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
  return html_entity_decode($str,null,'UTF-8');;
}
?>
