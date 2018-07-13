<?php
set_time_limit(0);   //设置运行时间
error_reporting(E_ALL & ~E_NOTICE);  //显示全部错误
define('ROOT_PATH', dirname(dirname(__FILE__)));  //定义根目录
define('DBCHARSET','UTF8');   //设置数据库默认编码
/*获取配置项*/
$CONF = require('../function.config.php');
define('VERSION', $CONF['config']['VERSION']);		//当前版本号
$var = VERSION;
if(function_exists('date_default_timezone_set')){
	date_default_timezone_set('Asia/Shanghai');
}
header("Content-type:text/html;charset=utf-8");

if(is_file('install.lock')){
	@header("Content-type: text/html; charset=UTF-8");
	echo "如果你看到这段话，说明你已经安装过了。<br>请删除install目录下的install.lock文件即可正常安装。";
	exit;
}

$step=is_numeric($_GET['step'])?$_GET['step']:'1';

require_once('function.php');
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>YoungxjTools数据库安装界面</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">
		$.ajax({
			url: 'http://api.yum6.cn/service/update.php',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(result) {
			if(result.state=='200'){
				if($('#version').attr("version") < result['data']['version']){
					$('#msg').html('当前版本不是最新版本,请下载<a href="'+result['data']['my']+'" target="_blank">最新版本</a>进行安装');
				}else{
					$('#msg').html('当前版本:'+$('#version').attr("version")+'是最新版');
				}
			}
		})
		.fail(function(result) {
			$('#msg').html('检测最新版失败,请前往<a href="https://gitee.com/youngxj0/YoungxjTools">项目地址</a>查看最新版本');
		});
		
	</script>
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
								<h1 id="version" version="<?php echo VERSION;?>">YoungxjTools<?php echo VERSION;?></h1>
								<h1>1.本PHP代码由Youngxj开发。</h1>
								<h1>2.程序为开源项目</h1>
								<h1>3.YoungxjQQ：1170535111</h1>
								<h3 id="msg"></h3>
								<input type="submit" name="submit" value="开始安装">
							</div>
							<div class="cd-app-screen"></div>
							<div class="cd-cover-layer"></div>
						</form> 
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<?php }elseif($step=='2'){
	require('var.php');
	env_check($env_items);
	dirfile_check($dirfile_items);
	function_check($func_items);
	?>
	<style type="text/css">
	.content-box{text-align: center;padding-bottom: 10px;}
	.content-box caption{color: red;font-weight:bold;}
</style>
<form action="?step=3" class="form-horizontal" method="post" role="form">
	<div class="cd-nugget-info" style="color: wheat;">
		<div class="content-box">
			<table width="50%" border="1">
				<caption>环境检查</caption>
				<tr>
					<th scope="col">项目</th>
					<th width="25%" scope="col">程序所需</th>
					<th width="25%" scope="col">最佳配置推荐</th>
					<th width="25%" scope="col">当前服务器</th>
				</tr>
				<?php foreach($env_items as $v){?>
				<tr>
					<td scope="row"><?php echo $v['name'];?></td>
					<td><?php echo $v['min'];?></td>
					<td><?php echo $v['good'];?></td>
					<td><span class="<?php echo $v['status'] ? 'yes' : 'no';?>"><i></i><?php echo $v['cur'];?></span></td>
				</tr>
				<?php }?>
			</table>
			<table width="50%" border="1">
				<caption>目录、文件权限检查</caption>
				<tr>
					<th scope="col">目录文件</th>
					<th width="25%" scope="col">所需状态</th>
					<th width="25%" scope="col">当前状态</th>
				</tr>
				<?php foreach($dirfile_items as $k => $v){?>
				<tr>
					<td><?php echo $v['path'];?> </td>
					<td><span>可写</span></td>
					<td><span class="<?php echo $v['status'] == 1 ? 'yes' : 'no';?>"><i></i><?php echo $v['status'] == 1 ? '可写' : '不可写';?></span></td>
				</tr>
				<?php }?>
			</table>
			<table width="50%" border="1">
				<caption>函数检查</caption>
				<tr>
					<th scope="col">目录文件</th>
					<th width="25%" scope="col">所需状态</th>
					<th width="25%" scope="col">当前状态</th>
				</tr>
				<?php foreach($func_items as $k =>$v){?>
				<tr>
					<td><?php echo $v['name'];?>()</td>
					<td><span>支持</span></td>
					<td><span class="<?php echo $v['status'] == 1 ? 'yes' : 'no';?>"><i></i><?php echo $v['status'] == 1 ? '支持' : '不支持(将会影响程序正常运行)';?></span></td>
				</tr>
				<?php }?>
			</table>
		</div>
		<input type="submit" name="submit" value="开始安装">
	</div>
	<div class="cd-app-screen"></div>
	<div class="cd-cover-layer"></div>
</form>
</section>
</body>
</html>
<?php }elseif($step=='3'){?>
<center>
	<div class="form-signin">
		<div class="login-wrap">
			<section class="container">
				<div class="login">
					<h1>数据库设置安装</h1>
					<form action="?step=4" class="form-sign" method="post">
						数据库地址:<input type="text" name="host" value="localhost" placeholder="数据库地址"><br><br>
						数据库用户名:<input type="text" name="user" value="root" placeholder="数据库用户名"><br><br>
						数据库密码:<input type="text" name="password" value="" placeholder="数据库密码"><br><br>
						数据库库名:<input type="text" name="database" value="" placeholder="数据库库名"><br><br><br><hr/>
						网站地址:<input type="text" name="web_url" placeholder="网站地址"><br><br><br>
						用户名:<input type="text" name="username" value="admin" placeholder="后台用户名"><br><br><br>
						密码:<input type="password" name="userpw" placeholder="后台密码"><span>(不小于6位)</span><br><br><br>
						校对密码:<input type="password" name="userpw2" placeholder="再次输入密码"><span>(不小于6位)</span><br><br><br>
						是否安装默认工具:<br/>
						是:<input type="radio" name="initial" value="1" checked="checked">
						否:<input type="radio" name="initial" value="0">
						<input type="submit" name="submit" value="开始安装">
					</form>
				</div>
			</section>
		</div>
	</div>
</center>
</section>
</body>
</html>
<?php }elseif($step=='4'){
	if($_POST['submit']){
		if(!$_POST['host'] || !$_POST['user'] || !$_POST['password'] || !$_POST['database']|| !$_POST['username']|| !$_POST['userpw']|| !$_POST['userpw2']|| !$_POST['web_url']){
			echo '<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			//获取表单提交数据
			$host = isset($_POST['host']) ? $_POST['host'] : '';
			$dk = isset($_POST['dk']) ? $_POST['dk'] : '';
			$user = isset($_POST['user']) ? $_POST['user'] : '';
			$web_url = is_http($_POST['web_url']) ? $_POST['web_url'] : 'http://'.$_POST['web_url'];
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			$database = isset($_POST['database']) ? $_POST['database'] : '';
			$username = isset($_POST['username']) ? $_POST['username'] : '';
			$userpw = isset($_POST['userpw']) ? $_POST['userpw'] : '';
			$userpw2 = isset($_POST['userpw2']) ? $_POST['userpw2'] : '';
			$initial = isset($_POST['initial']) ? $_POST['initial'] : '';


			if(strlen($userpw) < 6){
				exit('<script language=\'javascript\'>alert(\'登录密码不得小于6位\');history.go(-1);</script>');
			}elseif($userpw!=$userpw2)	 {
				exit('<script language=\'javascript\'>alert(\'两次输入的密码不一致\');history.go(-1);</script>');
			}
			
			$user_token = md5(md5(md5(generate_password(20))));

			$user_pw = md5(md5($userpw).md5($user_token));

			$mysqli = @new mysqli($host, $user, $password, $database);


			if($mysqli->connect_error){
				echo'<script language=\'javascript\'>alert("连接数据库失败，'.$mysqli->connect_error.'");history.go(-1);</script>';
			}else{

					$data = "<?php
return array(
	'mysql' => array(
		//数据库地址
		'MYSQL_HOST' => '{$host}', 
		//数据库端口一般是3306
		'MYSQL_PORT' => '{$dk}',    
		//数据库用户名 
		'MYSQL_USER' => '{$user}',  
		//数据库密码    
		'MYSQL_PASS' => '{$password}', 
		//数据库表名         
		'MYSQL_DB'   => '{$database}',  
		//数据库编码，一般utf8即可 
		'MYSQL_CHARSET' => 'utf8',  
	)
);
?>";
				if(file_put_contents('../config.php',$data)){
					$mysqli->query("SET NAMES UTF8");
					$sql = "
					SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
					SET time_zone = '+00:00';

					CREATE TABLE IF NOT EXISTS `tools_links` (
						`id` int(6) unsigned NOT NULL AUTO_INCREMENT,
						`name` text NOT NULL,
						`description` text NOT NULL,
						`url` text NOT NULL,
						`type` int(11) NOT NULL,
						`state` int(11) NOT NULL,
						`priority` int(11) NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

					INSERT INTO `tools_links` (`id`, `name`, `description`, `url`, `type`, `state`, `priority`) VALUES
					(1, '杨小杰博客', '杨小杰博客提供免费教程下载和网站搭建技术教程主要分享和发布网站源码致力创造一个高质量网络资源教程的分享平台', 'https://www.youngxj.cn', 0, 0, 0),
					(2, 'YoungxjTools', 'YoungxjTools', 'https://tools.yum6.cn', 1, 0, 2);

					CREATE TABLE IF NOT EXISTS `tools_list` (
						`title` varchar(30) NOT NULL,
						`subtitle` text NOT NULL,
						`keyword` text NOT NULL,
						`tools_url` text NOT NULL,
						`tools_img` text NOT NULL,
						`tools_type` text NOT NULL COMMENT '1:站长-2:开发-3:娱乐-4:其他',
						`priority` int(30) NOT NULL DEFAULT '0',
						`state` int(11) NOT NULL,
						`type` int(11) NOT NULL COMMENT '内外站类型',
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`tools_number` int(11) NOT NULL,
						`tools_love` int(11) NOT NULL,
						`tools_author` text NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;


					
					CREATE TABLE IF NOT EXISTS `tools_log` (
						`user` text NOT NULL,
						`content` text NOT NULL,
						`time` text NOT NULL,
						`state` int(11) NOT NULL,
						`id` int(11) NOT NULL AUTO_INCREMENT,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


					CREATE TABLE IF NOT EXISTS `tools_settings` (
						`id` int(6) unsigned NOT NULL AUTO_INCREMENT,
						`url` varchar(99) NOT NULL,
						`title` text NOT NULL,
						`keyword` text NOT NULL,
						`description` text NOT NULL,
						`copyright` text NOT NULL,
						`icp` text NOT NULL,
						`footer` text NOT NULL,
						`notice` text NOT NULL,
						`ip_admin` text NOT NULL,
						`ip_vip` text NOT NULL,
						`rand` varchar(30) NOT NULL,
						`referer` int(30) NOT NULL,
						`ua` int(30) NOT NULL,
						`name` text NOT NULL,
						`qq` text NOT NULL,
						`emails` text NOT NULL,
						`search` int(30) NOT NULL,
						`tools_priority` text NOT NULL,
						`tz` int(30) NOT NULL,
						`tz_msg` text NOT NULL,
						`templates` int(11) NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


					INSERT INTO `tools_settings` (`id`, `url`, `title`, `keyword`, `description`, `copyright`, `icp`, `footer`, `notice`, `ip_admin`, `ip_vip`, `rand`, `referer`, `ua`, `name`, `qq`, `emails`, `search`, `tools_priority`, `tz`, `tz_msg`, `templates`) VALUES
					(1, '{$web_url}', '杨小杰工具箱', '二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密', 'YoungxjTools提供二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密等优质的小工具,更加方便的使用我们的小工具,便捷站长使用工具', 'Youngxj', '', '', '', '', '127.0.0.255', 'Youngxj', 1, 1, 'YoungxjTools', '1170535111', 'blog@youngxj.cn', 2, '1', 2, '<h2>浏览器打开</h2>', 0);

					CREATE TABLE IF NOT EXISTS `tools_smtp` (
						`id` int(6) unsigned NOT NULL AUTO_INCREMENT,
						`host` tinytext NOT NULL,
						`port` tinytext NOT NULL,
						`fromname` tinytext NOT NULL,
						`username` tinytext NOT NULL,
						`password` tinytext NOT NULL,
						`smtp_from` tinytext NOT NULL,
						`sub` tinytext NOT NULL,
						`add_email` tinytext NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

					INSERT INTO `tools_smtp` (`id`, `host`, `port`, `fromname`, `username`, `password`, `smtp_from`, `sub`, `add_email`) VALUES
					(1, '', '', '', '', '', '', '收到一条来自xxxxx的回复', '');

					CREATE TABLE IF NOT EXISTS `tools_talk` (
						`name` text NOT NULL,
						`content` text NOT NULL,
						`times` text NOT NULL,
						`state` int(30) NOT NULL,
						`emails` text NOT NULL,
						`ip` text NOT NULL,
						`id` int(11) NOT NULL AUTO_INCREMENT,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

					CREATE TABLE IF NOT EXISTS `tools_user` (
						`id` int(6) unsigned NOT NULL AUTO_INCREMENT,
						`user` text NOT NULL,
						`password` text NOT NULL,
						`type` int(30) NOT NULL,
						`token` text NOT NULL,
						`user_token` text NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

					INSERT INTO `tools_user` (`id`, `user`, `password`, `type`,`token`,`user_token`) VALUES
					(1, '{$username}', '{$user_pw}', 1,'','{$user_token}');
					";
					if($initial==1){
						$sql.="
						INSERT INTO `tools_list` (`title`, `subtitle`, `keyword`, `tools_url`, `tools_img`, `tools_type`, `priority`, `state`, `type`, `id`, `tools_number`, `tools_love`, `tools_author`) VALUES
					('帮你百度一下', 'Go To Baidu', '帮你百度一下', 'baidu', '/images/baidu.png', '娱乐类', 0, 0, 0, 1, 0, 0, 'Youngxj'),
					('字符串加解密', 'EnCode Or DeCode', 'url加解密,base64加解密,md5加密,正则转义,图片base', 'code', '/images/code.png', '开发类', 0, 0, 0, 2, 0, 0, 'Youngxj'),
					('猜数小游戏', 'Game', 'js小游戏,jsgame,智力游戏,猜数测试', 'cs', '/images/game.png', '娱乐类', 0, 0, 0, 3, 0, 0, 'Youngxj'),
					('CSS代码整理', 'CSS Format', 'CSS,css代码高亮,css代码格式化,css代码整理', 'css_Format', '/images/css.png', '开发类', 0, 0, 0, 4, 0, 0, 'Youngxj'),
					('骰子游戏', 'Dice', '骰子游戏', 'dice', '/images/sz.png', '娱乐类', 0, 0, 0, 5, 0, 0, 'Youngxj'),
					('Dns解析查询', 'Dns Query', 'dns解析查询,dns记录查询,ns解析查询', 'dns', '/images/dns.png', '站长类', 0, 0, 0, 6, 0, 0, 'Youngxj'),
					('Dns检测', 'Dns Test', '在线dns检测,dns检测,dns劫持', 'dnstest', '/images/dns.png', '便民', 0, 0, 0, 7, 0, 0, 'Youngxj'),
					('短网址生成', 'Dwz Url', '短网址,dwz,短网址生成,免费防红,防红接口,ae博客', 'dwzurl', '/images/dwz.png', '站长类', 0, 0, 0, 8, 0, 0, 'Youngxj'),
					('FuckJS转码加密', 'Fuck JS', 'FuckJS转码加密', 'Fuck_js', '/images/js.png', '开发类', 0, 0, 0, 9, 0, 0, 'Youngxj'),
					('在线进制转换', 'HEX', '在线进制转换', 'hex', '/images/hex.png', '开发类', 0, 0, 0, 10, 0, 0, 'Youngxj'),
					('文本转ASCII', 'HTML ASCII', 'Html转文本转ASCII', 'HTML_ASCII', '/images/html.png', '站长类', 0, 0, 0, 11, 0, 0, 'Youngxj'),
					('ICP备案查询', 'ICP Query', 'icp备案,备案查询,域名信息查询,备案记录查询', 'icp', '/images/icp.png', '站长类', 0, 0, 0, 12, 0, 0, 'Youngxj'),
					('IP地址查询', 'IP Query', 'ip定位,ip相关,ip地址归属', 'ip', '/images/ip.png', '便民', 0, 0, 0, 13, 0, 0, 'Youngxj'),
					('在线正则表达式测试', 'Expression', 'js在线正则表达式测试', 'js_expression', '/images/js.png', '开发类', 0, 0, 0, 14, 0, 0, 'Youngxj'),
					('JS代码整理', 'JS Format', 'Js代码加解密,js代码格式化,js压缩,js解压', 'js_Format', '/images/js.png', '开发类', 0, 0, 0, 15, 0, 0, 'Youngxj'),
					('JSON验证与整理', 'JSON Format', 'JSON整理', 'json_format', '/images/json.png', '站长类', 0, 0, 0, 16, 0, 0, 'Youngxj'),
					('全民K歌解析', 'Music Analysis', '全民K歌,K歌解析,全民K歌解析工具', 'kg', '/images/kge.png', '娱乐类', 0, 0, 0, 17, 0, 0, 'Youngxj'),
					('长度计量单位换算', 'Length', '长度计量单位换算计算', 'length', '/images/length.png', '便民', 0, 0, 0, 18, 0, 0, 'Youngxj'),
					('线条字生成', 'Line Text', '线条字生成', 'line_text', '/images/xt.png', '娱乐类', 0, 0, 0, 19, 0, 0, 'Youngxj'),
					('网址链接生成器', 'Link Get', '在线网址链接生成', 'link_get', '/images/link.png', '站长类', 0, 0, 0, 20, 0, 0, 'Youngxj'),
					('摩斯电码转换', 'Morse', '在线摩斯电码转换器', 'morse', '/images/morse.png', '娱乐类', 0, 0, 0, 21, 0, 0, 'Youngxj'),
					('听歌房', 'Music', '一款开源的基于网易云音乐api的在线音乐播放器', 'music', '/images/music.png', '娱乐类', 0, 0, 0, 22, 0, 0, 'Youngxj'),
					('PV刷新工具', 'Page View', '在线刷PV工具', 'page_view', '/images/view-stats.png', '站长类', 0, 0, 0, 23, 0, 0, 'Youngxj'),
					('手机号归属查询', 'Phone', '手机号码归属地查询', 'phone', '/images/phone.png', '便民', 0, 0, 0, 24, 0, 0, 'Youngxj'),
					('超级Ping', 'Super Ping', '超级ping,在线ping,网站测速,网站解析查询,地区测速', 'ping', '/images/ping.png', '站长类', 0, 0, 0, 25, 0, 0, 'Youngxj'),
					('中文转拼音', 'PinYin', '在线中文转拼音转语音', 'Pinyin', '/images/zw.png', '便民', 0, 0, 0, 26, 0, 0, 'Youngxj'),
					('端口扫描', 'Port Blast', '端口扫描,在线扫描工具,批量扫描,ip端口查询', 'portblast', '/images/port.png', '站长类', 0, 0, 0, 27, 0, 0, 'Youngxj'),
					('个性二维码制作', 'Pre Code', '个性二维码制作', 'pre_qrcode', '/images/qrcode.png', '站长类', 0, 0, 0, 28, 0, 0, 'Youngxj'),
					('略缩图四合一', 'Preview', '网站略缩图,网站快照,略缩图四合一', 'preview', '/images/preview.png', '站长类', 0, 0, 0, 29, 0, 0, 'Youngxj'),
					('新浪图片主识别', 'Sina Pro', '新浪图片主识别', 'pro', '/images/sina.png', '便民', 0, 0, 0, 30, 0, 0, 'Youngxj'),
					('QQ群个性昵称', 'QQ card', 'QQ个性昵称', 'qqqun', '/images/qq.png', '娱乐类', 0, 0, 0, 31, 0, 0, 'Youngxj'),
					('QQ在线状态', 'QQ State', 'QQ电脑在线查询', 'qqstate', '/images/qq.png', '便民', 0, 0, 0, 32, 0, 0, 'Youngxj'),
					('二维码制作', 'Qrcode', '二维码制作', 'qrcode', '/images/qrcode.png', '站长类', 0, 0, 0, 33, 0, 0, 'Youngxj'),
					('Qzone蓝链艾特', 'Qzone', 'Qzone蓝链艾特', 'qzone', '/images/qq.png', '娱乐类', 0, 0, 0, 34, 0, 0, 'Youngxj'),
					('随机密码生成', 'Rand Key', '随机密码生成,卡密生成', 'rand_key', '/images/key.png', '开发类', 0, 0, 0, 35, 0, 0, 'Youngxj'),
					('域名权重查询', 'Rank', '站长之家,爱站网权重查询,搜狗PR,谷歌PR', 'rank', '/images/rank.png', '站长类', 0, 0, 0, 36, 0, 0, 'Youngxj'),
					('三合一收款码制作', 'Recode', 'QQ,支付宝,微信收款码三合一制作', 'recode', '/images/pay.png', '站长类', 0, 0, 0, 37, 0, 0, 'Youngxj'),
					('中国家庭称谓计算器', 'Relation Ship', '中国家庭称谓计算器', 'relationship', '/images/ch.png', '便民', 0, 0, 0, 38, 0, 0, 'Youngxj'),
					('前端在线运行', 'Run', '前端在线运行调试', 'run', '/images/html.png', '开发类', 0, 0, 0, 39, 0, 0, 'Youngxj'),
					('新浪图床外链', 'Sina Img', '新浪图床外链,CDN图床', 'sinaimg', '/images/sina.png', '站长类', 0, 0, 0, 40, 0, 0, 'Youngxj'),
					('网站状态码', 'Status Code', '网站状态码获取', 'StatusCode', '/images/code_view.png', '站长类', 0, 0, 0, 41, 0, 0, 'Youngxj'),
					('在线文本对比', 'Text Contrast', '在线文本对比,代码对比', 'text_contrast', '/images/word.png', '站长类', 0, 0, 0, 42, 0, 0, 'Youngxj'),
					('Unix时间戳', 'TimeStamp', '在线Unix时间戳转换', 'timestamp', '/images/time.png', '站长类', 0, 0, 0, 43, 0, 0, 'Youngxj'),
					('UA分析', 'UA Analysis', '在线获取并分析useragent', 'ua', '/images/useragent.png', '站长类', 0, 0, 0, 44, 0, 0, 'Youngxj'),
					('在线子域名扫描', 'Url Blast', '在线子域名爆破扫描工具', 'urlblast', '/images/www.png', '站长类', 0, 0, 0, 45, 0, 0, 'Youngxj'),
					('重量计量单位转换', 'Weight', '在线重量计量单位转换工具', 'weight', '/images/weight.png', '便民', 0, 0, 0, 46, 0, 0, 'Youngxj'),
					('Whois查询', 'Whois', '域名Whois查询,域名注册人信息查询', 'whois', '/images/qqurl.png', '站长类', 0, 0, 0, 47, 0, 0, 'Youngxj'),
					('字数统计与排版', 'Text Count', '在线字数统计,在线word排版', 'text_count', '/images/word.png', '便民', 0, 0, 0, 48, 0, 0, 'Youngxj');
						";
						$zip = new ZipArchive();
						$res = $zip->open('../Tools/Tools.zip');
						if ($res === TRUE) {
							$failfiles = $zip->extractTo("../Tools");
							if(!$failfiles){
								echo'<script language=\'javascript\'>alert("Tools目录写失败");history.go(-1);</script>';
								exit();
							}
						} else {
							echo'<script language=\'javascript\'>alert("工具包打开失败");history.go(-1);</script>';
							exit();
						}
						$zip->close();
					}else{
						$sql.="truncate table tools_list;";
					}
					$array_sql = preg_split("/;[\r\n]/", $sql);
					$num = count($array_sql);
					foreach($array_sql as $sql){
						$sql = trim($sql);
						if ($sql){
							$mysqli->query($sql);
						}
					}

					if($mysqli->connect_error){
						echo'<script language=\'javascript\'>alert("导入数据表时错误，'.$mysqli->connect_error.'");history.go(-1);</script>';
					}else{
						@file_put_contents('install.lock','');
						curl_get_https('https://api.yum6.cn/service/inc_url.php?url='.$_SERVER['HTTP_HOST'].'&VERSION='.$var);
						?>
						<div class="login-wrap">
							<div class="panel-body">
								<div class="cd-nugget-info">
									<h1>YoungxjTools成功安装。</h1>
									<h1>1、网站安装成功.</h1>
									<h1>2、共写入<code><?php echo $num;?></code>条数据</h1>
									<h1>3、使用条例请遵守GPL-3.0</h1>
									<input type="submit" name="submit" value="网站首页" onclick="javascrtpt:window.location.href='<?php echo $web_url;?>/index.php'">
									<input type="submit" name="submit" value="QQ交流群" onclick="javascrtpt:window.location.href='http://shang.qq.com/wpa/qunwpa?idkey=3ce04929f3f5c27b3fc20a892fefd8bfa9a2849f6e33fb4c49b1f1ab16991ff5'">
									<input type="submit" name="submit" value="网站后台" onclick="javascrtpt:window.location.href='<?php echo $web_url;?>/admin'">
								</div>
								<div class="cd-app-screen"></div>
								<div class="cd-cover-layer"></div>
							</div>
						</div>
					</section>
				</body>
				</html>
				<?php }}else{
					echo '<script language=\'javascript\'>alert("保存数据库配置文件失败，请检查网站是否有写入权限！");history.go(-1);</script>';
				}
			}
		}
	}else{
		echo '<script language=\'javascript\'>alert("禁止直接访问");history.go(-1);</script>';
	}}else{
		echo '<script language=\'javascript\'>alert("非法访问！");history.go(-1);</script>';
	}?>

</section>
</body>
</html>
