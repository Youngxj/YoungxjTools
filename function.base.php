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
<?php
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
//php防注入和XSS攻击通用过滤. 
//by qq:831937
function SafeFilter (&$arr) 
{

 $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');

 if (is_array($arr))
 {
   foreach ($arr as $key => $value) 
   {
    if (!is_array($value))
    {
           //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
      if (!get_magic_quotes_gpc())            
      {
            //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
       $value  = addslashes($value);           
     }
           //删除非打印字符，粗暴式过滤xss可疑字符串
     $value       = preg_replace($ra,'',$value);  
          //去除 HTML 和 PHP 标记并转换为 HTML 实体   
     $arr[$key]     = htmlentities(strip_tags($value)); 
   }
   else
   {
    SafeFilter($arr[$key]);
  }
}
}
}
?>
<?php 
/**
 * 判断是否为邮箱
 * @param  string  $email 邮箱地址
 * @return boolean        返回真假
 */
function isEmail($email){
  $mode = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
  if(preg_match($mode,$email)){
    return true;
  }
  else{
    return false;
  }
}
?>
<?php
/**
 * 获取网络附件
 * @param  string  $url      网络地址
 * @param  string  $save_dir 保存目录
 * @param  string  $filename 保存名称
 * @param  integer $type     下载类型1为curl下载
 * @return array             返回数组保存目录及名称
 */
function getFile($url, $save_dir = '', $filename = '', $type = 0) {
    if (trim($url) == '') {
        return false;
    }
    if (trim($save_dir) == '') {
        $save_dir = './';
    }
    if (0 !== strrpos($save_dir, '/')) {
        $save_dir.= '/';
    }
    //创建保存目录
    if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
        return false;
    }
    //获取远程文件所采用的方法
    if ($type) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $content = curl_exec($ch);
        curl_close($ch);
    } else {
        ob_start();
        readfile($url);
        $content = ob_get_contents();
        ob_end_clean();
    }
    $size = strlen($content);
    //文件大小
    $fp2 = @fopen($save_dir . $filename, 'a');
    fwrite($fp2, $content);
    fclose($fp2);
    unset($content, $url);
    return array(
        'file_name' => $filename,
        'save_path' => $save_dir . $filename
    );
}
?>
