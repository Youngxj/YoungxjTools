<?php 
header("Content-Type: text/html; charset=utf-8");
setcookie('cookie_user','1');
echo '<script type="text/javascript">alert("注销成功");window.location.href="login.php";</script>'; 
?>