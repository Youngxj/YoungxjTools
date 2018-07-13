<?php 
header("Content-Type: text/html; charset=utf-8");
ob_start();
setcookie('cookie_user','1');
echo "<script type='text/javascript'>alert('已注销');window.location.href='login.php';</script>"; 
?>