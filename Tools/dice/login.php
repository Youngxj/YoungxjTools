<?php
header('Content-type: application/json');

$username = strFilter($_POST['username']) ? strFilter($_POST['username']) : '';
$password = strFilter($_POST['password']) ? strFilter($_POST['password']) : '';
if($username&&$password){
	$param=array('username'=>$username,'password'=>$password);
	$url = request_post('http://api.yum6.cn/dice_game/index.php/user/user/login',$param);
	$json = json_decode($url,1);
	if($json['code']=="200"){
        ob_start();
        setcookie("username",$json['user_token'], time()+3600*24,'/');
		//$_COOKIE['username'] = $json['user_token'];
		echo $url;
	}else{
		echo $url;
	}
}

function strFilter($str){
  //特殊字符替换
	$str = str_replace('`', '', $str);
	$str = str_replace('·', '', $str);
	$str = str_replace('~', '', $str);
	$str = str_replace('!', '', $str);
	$str = str_replace('！', '', $str);
	$str = str_replace('@', '', $str);
	$str = str_replace('#', '', $str);
	$str = str_replace('$', '', $str);
	$str = str_replace('￥', '', $str);
	$str = str_replace('%', '', $str);
	$str = str_replace('^', '', $str);
	$str = str_replace('……', '', $str);
	$str = str_replace('&', '', $str);
	$str = str_replace('*', '', $str);
	$str = str_replace('(', '', $str);
	$str = str_replace(')', '', $str);
	$str = str_replace('（', '', $str);
	$str = str_replace('）', '', $str);
	$str = str_replace('-', '', $str);
	$str = str_replace('_', '', $str);
	$str = str_replace('——', '', $str);
	$str = str_replace('+', '', $str);
	$str = str_replace('=', '', $str);
	$str = str_replace('|', '', $str);
	$str = str_replace('\\', '', $str);
	$str = str_replace('[', '', $str);
	$str = str_replace(']', '', $str);
	$str = str_replace('【', '', $str);
	$str = str_replace('】', '', $str);
	$str = str_replace('{', '', $str);
	$str = str_replace('}', '', $str);
	$str = str_replace(';', '', $str);
	$str = str_replace('；', '', $str);
	$str = str_replace(':', '', $str);
	$str = str_replace('：', '', $str);
	$str = str_replace('\'', '', $str);
	$str = str_replace('"', '', $str);
	$str = str_replace('“', '', $str);
	$str = str_replace('”', '', $str);
	$str = str_replace(',', '', $str);
	$str = str_replace('，', '', $str);
	$str = str_replace('<', '', $str);
	$str = str_replace('>', '', $str);
	$str = str_replace('《', '', $str);
	$str = str_replace('》', '', $str);
	$str = str_replace('.', '', $str);
	$str = str_replace('。', '', $str);
	$str = str_replace('/', '', $str);
	$str = str_replace('、', '', $str);
	$str = str_replace('?', '', $str);
	$str = str_replace('？', '', $str);
	return trim($str);
}


function request_post($url = '', $param = '') {
	if (empty($url) || empty($param)) {
		return false;
	}

	$postUrl = $url;
	$curlPost = $param;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$postUrl);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}