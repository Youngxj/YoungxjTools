<?php
function domainfuzz($domain)
{
	$ip = gethostbyname($domain);
	preg_match("/\\d+\\.\\d+\\.\\d+\\.\\d+/", $ip, $arr);
	return $arr;
}
if (isset($_GET['q'])) {
	$return = array();
	$domain = trim($_GET["domain"]);
  //前缀字典
	$q = trim($_GET["q"]);
	preg_match("/([\w\.\-]+\w*[\.]?\w*\.\w+)\$/", $domain, $arr);
	$fuzz = $q . '.' . $arr[1];
	$result = domainfuzz($fuzz);
	$return["domain"] = $fuzz;
	if (empty($result)) {
		$return["status"] = 500;
		$return["ip"] = null;
	} else {
		$return["status"] = 200;
		$return["ip"] = $result[0];
	}
	header('Content-type: application/json;charset=utf-8');
	exit(json_encode($return));
}
?>