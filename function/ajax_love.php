<?php
error_reporting(0);
include_once '../Model.php';
include_once '../function.base.php';
$tools_list = new Model("tools_list");

$id = getParam('id');
if ($_COOKIE["love_id_".$id]) {
	$arr = array('state'=>2,'msg'=>'已经点过赞了');
	echoJson(json_encode($arr));
}
$loves = $tools_list->incr(array('id'=>$id),'tools_love');

if($loves){
	setcookie('love_id_'.$id,$id,time()+315360000);
	$arr = array('state'=>1,'msg'=>'点赞成功');
	echoJson(json_encode($arr));
}