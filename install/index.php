<?php
error_reporting(E_ALL & ~E_NOTICE);
if(file_exists('install.lock')){
	exit('如果你看到这段话，说明你已经安装过了。<br>请删除install目录下的install.lock文件即可正常安装。');
}
$step=is_numeric($_GET['step'])?$_GET['step']:'1';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>数据库安装界面</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<section id="login-container">

		<div class="row">
			<div class="col-md-3" id="login-wrapper">
				<div class="panel panel-primary animated flipInY">
					<div class="panel-body">
						<?php if($step=='1'){?>
						<form action="?step=2" class="form-horizontal" method="post" role="form">
							<div class="cd-nugget-info">
								<h1>YoungxjTools</h1>
								<h1>1.本PHP代码由Youngxj开发。</h1>
								<h1>2.程序为开源项目</h1>
								<h1>3.YoungxjQQ：1170535111</h1>
								<input type="submit" name="submit" value="开始安装">
							</div>
							<div class="cd-app-screen"></div>
							<div class="cd-cover-layer"></div>
						</form> </div>
					</div>
				</div>
			</div>
			<?php }elseif($step=='2'){?>
			<center>
				<div class="form-signin">
					<div class="login-wrap">
						<section class="container">
							<div class="login">
								<h1>数据库设置安装</h1>
								<form action="?step=3" class="form-sign" method="post">
									数据库地址:<input type="text" name="host" value="localhost" placeholder="数据库地址"><br><br>
									数据库端口:<input type="text" name="dk" value="3306" placeholder="数据库端口"><br><br>
									数据库用户名:<input type="text" name="user" value="root" placeholder="数据库用户名"><br><br>
									数据库密码:<input type="text" name="password" value=""placeholder="数据库密码"><br><br>
									数据库库名:<input type="text" name="database" value="" placeholder="数据库库名"><br><br><br>
									<input type="submit" name="submit" value="开始安装">
								</form>
							</div>
						</section>
					</div>
				</div>
      		</center>
			</form>
		</div>
	</div>
</div>
</div>
<?php }elseif($step=='3'){
	if($_POST['submit']){
		if(!$_POST['host'] || !$_POST['user'] || !$_POST['password'] || !$_POST['database']|| !$_POST['dk']){
			echo'<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			if(!$con=@mysql_connect($_POST[host],$_POST[user],$_POST[password])){
				echo'<script language=\'javascript\'>alert("连接数据库失败，'.mysql_error().'");history.go(-1);</script>';
			}elseif(!mysql_select_db($_POST['database'],$con)){
				echo'<script language=\'javascript\'>alert("没有找到数据库，请查看后在添加！，'.mysql_error().'");history.go(-1);</script>';
			}else{
				mysql_query("set names utf8",$con);
				
				$data = "<?php
				return array(
					'mysql' => array(
						'MYSQL_HOST' => '{$_POST['host']}', // 数据库地址
						'MYSQL_PORT' => '{$_POST['dk']}',      // 数据库端口，一般是3306
						'MYSQL_USER' => '{$_POST['user']}',      // 数据库用户名
						'MYSQL_PASS' => '{$_POST['password']}',          // 数据库密码
						'MYSQL_DB'   => '{$_POST['user']}',      // 数据库库名称
						'MYSQL_CHARSET' => 'utf8',   // 编码，一般utf8即可
					),
				);
				?>";
				if(file_put_contents('../config.php',$data)){
					$sqls=file_get_contents("install.sql");
					$explode = explode(";",$sqls);
					$num = count($explode);
					foreach($explode as $sql){
						if($sql=trim($sql)){
							mysql_query($sql);
						}
					}
					if(mysql_error()){
						echo'<script language=\'javascript\'>alert("导入数据表时错误，'.mysql_error().'");history.go(-1);</script>';
					}else{
						@file_put_contents('install.lock','');
						?>
						<div class="login-wrap">
							<div class="panel-body">
								<div class="cd-nugget-info">
									<h1>YoungxjTools成功安装。</h1>
									<h1>1、网站安装成功.</h1>
									<h1>2、共写入<code><?php echo $num;?></code>条数据</h1>
									<h1>3.YoungxjQQ：1170535111</h1>
									<input type="submit" name="submit" value="网站首页" onclick="javascrtpt:window.location.href='../index.php'">
								</div>
								<div class="cd-app-screen"></div>
								<div class="cd-cover-layer"></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}else{
	echo'<script language=\'javascript\'>alert("保存数据库配置文件失败，请检查网站是否有写入权限！");history.go(-1);</script>';
}
}
}
}
}elseif($step=='4'){?>
<?php }?>
</section>
</body>
</br>
</html>
