<?php
error_reporting(E_ALL & ~E_NOTICE);
if(file_exists('install.lock')){
	exit('如果你看到这段话，说明你已经安装过了。<br>请删除install目录下的install.lock文件即可正常安装。');
}
$step=is_numeric($_GET['step'])?$_GET['step']:'1';
/**
 * 获取站点地址
 */
function getWebUrl() {

	$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';   
	$PHP_SELF=$_SERVER['SCRIPT_NAME'];

	$url = $http_type . $_SERVER['SERVER_NAME'] . substr($PHP_SELF,0,strrpos($PHP_SELF,'/')+1);

	return $url;
}
function curl_get_https($url){
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
    $tmpInfo = curl_exec($curl);
    curl_close($curl);
    return $tmpInfo;
}

function generate_password( $length = 8 ) { 
// 密码字符集，可任意添加你需要的字符 
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
$password = ""; 
for ( $i = 0; $i < $length; $i++ ) 
{ 
// 这里提供两种字符获取方式 
// 第一种是使用 substr 截取$chars中的任意一位字符； 
// 第二种是取字符数组 $chars 的任意元素 
// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
$password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
} 
return $password; 
}
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>YoungxjTools数据库安装界面</title>
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
									数据库用户名:<input type="text" name="user" value="root" placeholder="数据库用户名"><br><br>
									数据库密码:<input type="text" name="password" value=""placeholder="数据库密码"><br><br>
									数据库库名:<input type="text" name="database" value="" placeholder="数据库库名"><br><br><br><hr/>
									网站地址:<input type="text" name="web_url" placeholder="网站地址(http://tools.yum6.cn)"><br><br><br>
									用户名:<input type="text" name="username" value="admin" placeholder="后台用户名"><br><br><br>
									密码:<input type="password" name="userpw" placeholder="后台密码"><span>(不小于6位)</span><br><br><br>
									校对密码:<input type="password" name="userpw2" placeholder="再次输入密码"><span>(不小于6位)</span><br><br><br>
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
		if(!$_POST['host'] || !$_POST['user'] || !$_POST['password'] || !$_POST['database']|| !$_POST['username']|| !$_POST['userpw']|| !$_POST['userpw2']|| !$_POST['web_url']){
			echo'<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			//获取表单提交数据
			$host = isset($_POST['host']) ? $_POST['host'] : '';
			$user = isset($_POST['user']) ? $_POST['user'] : '';
			$web_url = isset($_POST['web_url']) ? $_POST['web_url'] : '';
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			$database = isset($_POST['database']) ? $_POST['database'] : '';
			$username = isset($_POST['username']) ? $_POST['username'] : '';
			$userpw = isset($_POST['userpw']) ? $_POST['userpw'] : '';
			$userpw2 = isset($_POST['userpw2']) ? $_POST['userpw2'] : '';

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
						'MYSQL_HOST' => '{$host}', // 数据库地址
						'MYSQL_PORT' => '{$dk}',      // 数据库端口，一般是3306
						'MYSQL_USER' => '{$user}',      // 数据库用户名
						'MYSQL_PASS' => '{$password}',          // 数据库密码
						'MYSQL_DB'   => '{$database}',      // 数据库库名称
						'MYSQL_CHARSET' => 'utf8',   // 编码，一般utf8即可
					),
				);
				?>";
				if(file_put_contents('../config.php',$data)){
					$mysqli->query("SET NAMES UTF8");
					$sql = "
					SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
					SET time_zone = '+00:00';

					CREATE TABLE IF NOT EXISTS `tools_links` (
						`id` int(6) unsigned NOT NULL,
						`name` text NOT NULL,
						`description` text NOT NULL,
						`url` text NOT NULL,
						`type` int(11) NOT NULL,
						`state` int(11) NOT NULL,
						`priority` int(11) NOT NULL
					)  AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

					INSERT INTO `tools_links` (`id`, `name`, `description`, `url`, `type`, `state`, `priority`) VALUES
					(1, '杨小杰博客', '杨小杰博客提供免费教程下载和网站搭建技术教程,主要分享和发布网站源码,致力创造一个高质量网络资源教程的分享平台', 'http://www.youngxj.cn', 1, 0, 0),
					(2, 'YoungxjTools', 'YoungxjTools', 'https://tools.yum6.cn', 1, 0, 1);

					CREATE TABLE IF NOT EXISTS `tools_list` (
						`title` varchar(30) NOT NULL,
						`subtitle` text NOT NULL,
						`explains` text NOT NULL,
						`keyword` text NOT NULL,
						`tools_url` text NOT NULL,
						`tools_img` text NOT NULL,
						`tools_type` text NOT NULL COMMENT '1:站长-2:开发-3:娱乐-4:其他',
						`priority` int(30) NOT NULL DEFAULT '0',
						`state` int(11) NOT NULL,
						`type` int(11) NOT NULL COMMENT '内外站类型',
						`id` int(11) NOT NULL,
						`tools_number` int(11) NOT NULL,
						`tools_love` int(11) NOT NULL,
						`tools_author` text NOT NULL
					)  AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;


					INSERT INTO `tools_list` (`title`, `subtitle`, `explains`, `keyword`, `tools_url`, `tools_img`, `tools_type`, `priority`, `state`, `type`, `id`, `tools_number`, `tools_love`, `tools_author`) VALUES
					('字符加解密', 'EnCode Or DeCode', '支持url加解密、base64加解密、md5加密、addsl', 'url加解密,base64加解密,md5加密,正则转义,图片', 'code', '{$web_url}/images/code.png', '站长类', 1, 0, 0, 1, 0, 0,'Youngxj'),
					('Dns解析记录', 'Dns', 'Dns解析记录查询', 'dns解析查询,dns记录查询,ns解析查询', 'dns', '{$web_url}/images/dns.png', '站长类', 1, 0, 0, 2, 0, 0,'Youngxj'),
					('短网址生成', 'Dwz Url', '短网址跳转防红生成工具', '短网址,dwz,短网址生成,免费防红,防红接口,ae博客', 'dwzurl', '{$web_url}/images/dwz.png', '站长类', 0, 0, 0, 3, 0, 0,'Youngxj'),
					('ICP备案查询', 'icp', '域名备案信息查询', 'icp备案,备案查询,域名信息查询,备案记录查询', 'icp', '{$web_url}/images/icp.png', '站长类', 0, 0, 0, 4, 0, 0,'Youngxj'),
					('IP地址查询', 'IP Query', 'Ip地址相关信息查询', 'ip定位,ip相关,ip地址归属', 'ip', '{$web_url}/images/ip.png', '站长类', 0, 0, 0, 5, 0, 0,'Youngxj'),
					('全民K歌解析', 'KG Analysis', '解析的音乐归视频上传者所有。本工具只提供音乐下载地址', '全民K歌,K歌解析,全民K歌解析工具', 'kg', '{$web_url}/images/kge.png', '娱乐类', 0, 0, 0, 6, 0, 0,'Youngxj'),
					('超级Ping', 'Super Ping', '超级Ping用于测试网站节点响应速度', '超级ping,在线ping,网站测速,网站解析查询,地区测速', 'ping', '{$web_url}/images/ping.png', '站长类', 1, 0, 0, 7, 0, 0,'Youngxj'),
					('端口扫描', 'Port Blast', '批量扫描IP端口打开情况', '端口扫描,在线扫描工具,批量扫描,ip端口查询', 'portblast', '{$web_url}/images/port.png', '站长类', 0, 0, 0, 8, 0, 0,'Youngxj'),
					('QQ在线状态', 'QQ State', '查询QQ是否电脑在线,强制会话', 'qq查询,QQ状态,QQ相关', 'qqstate', '{$web_url}/images/qq.png', '站长类', 99, 0, 0, 9, 0, 0,'Youngxj'),
					('二维码生成', 'Qrcode', '方便快捷版二维码生成，统一大小', 'qrcode,二维码,自定义二维码,二维码在线生成', 'qrcode', '{$web_url}/images/qrcode.png', '站长类', 0, 0, 0, 10, 0, 0,'Youngxj'),
					('前端在线运行', 'run', '在线运行,前端测试,代码审计,运行测试', '在线运行,前端测试,代码审计,运行测试', 'run', '{$web_url}/images/html.png', '开发类', 0, 0, 0, 11, 0, 0,'Youngxj'),
					('新浪图床', 'Sina Img', '全网CDN图床 不限流量 无限外链 永久免费 图床API', '图床,急速图床,免费图床,新浪图床,cdn图床', 'sinaimg', '{$web_url}/images/sina.png', '站长类', 0, 0, 0, 12, 0, 0,'Youngxj'),
					('时间戳转换', 'Unix Timestamp', '转换Unix时间戳转', '时间戳,unix时间戳,北京时间,时间转换', 'timestamp', '{$web_url}/images/time.png', '站长类', 0, 0, 0, 13, 0, 0,'Youngxj'),
					('useragent分析', 'Ua分析', '获取并分析useragent', '浏览器信息,用户信息,ua查询,useragent分析', 'ua', '{$web_url}/images/useragent.png', '站长类', 0, 0, 0, 14, 0, 0,'Youngxj'),
					('子域名爆破', 'Url Blast', '字典批量扫描域名已解析域名(已存放1393字段)', '字典批量扫描域名已解析域名(已存放1393字段)', 'urlblast', '{$web_url}/images/urlblast.png', '站长类', 0, 0, 0, 15, 0, 0,'Youngxj'),
					('特殊群昵称制作', 'withdraw', 'QQ群娱乐昵称包含撤回以及echo', 'qq群昵称.群昵称制作,特殊群昵称,娱乐昵称,群名片', 'qqqun', '{$web_url}/images/qun.png', '娱乐类', 0, 0, 0, 16, 0, 0,'Youngxj'),
					('猜数小游戏', 'Game', '0-100随机生成一个数字，请答对这数字！', 'js小游戏,jsgame,智力游戏,猜数测试', 'cs', '{$web_url}/images/js.png', '娱乐类', 0, 0, 0, 17, 0, 0,'Youngxj'),
					('Whios查询', 'Whois query', '域名注册信息查询', 'whois信息,域名whois,域名注册信息,whois反查', 'whois', '{$web_url}/images/icp.png', '站长类', 0, 0, 0, 18, 0, 0,'Youngxj'),
					('手机号码归属地查询', 'phone', '手机号码归属地查询', '手机号码归属地查询', 'phone', '{$web_url}/images/phone.png', '站长类', 0, 0, 0, 19, 0, 0,'Youngxj'),
					('帮你百度一下', 'go to baidu', '帮你百度一下', '百度,百度一下', 'baidu', '{$web_url}/images/baidu.png', '娱乐类', 0, 0, 0, 20, 0, 0,'Youngxj'),
					('dns检测', 'dns test', '在线dns检测', 'dns,dns检测,dns劫持', 'dnstest', '{$web_url}/images/dns.png', '站长类', 0, 0, 0, 21, 0, 0,'Youngxj'),
					('贴吧云签到', 'baidu tb', '每日自动执行百度贴吧的签到功能', '云签到,百度贴吧', '//tb.youngxj.cn', '{$web_url}/images/baidu.png', '站长类', 0, 0, 1, 22, 0, 0,'Youngxj'),
					('在线制作网页', 'Online production', '在线一键制作个性网页', '在线网页制作,个人网页制作,表白网页制作,祝福网页制作,免费', '//zx.yum6.cn', '{$web_url}/images/online.gif', '娱乐类', 0, 0, 1, 23, 0, 0,'Youngxj'),
					('听歌房', 'music', '一款开源的基于网易云音乐api的在线音乐播放器', '孟坤播放器,在线音乐播放器,MKOnlinePlayer,网', '//music.yum6.cn', '{$web_url}/images/music.png', '娱乐类', 0, 0, 1, 24, 0, 0,'Youngxj'),
					('音乐搜索器', 'music seach', '麦葱特制多站合一音乐搜索解决方案，可搜索试听网易云音乐、QQ音乐、酷狗音乐、酷我音乐、虾米音乐、百度音乐、一听音乐、咪咕音乐、荔枝FM、蜻蜓FM、喜马拉雅FM、全民K歌、5sing原创翻唱音乐。', '音乐搜索,音乐搜索器,音乐试听,音乐在线听,网易云音乐,QQ', 'music', '{$web_url}/images/music.png', '娱乐类', 0, 0, 0, 25, 0, 0,'Youngxj'),
					('中文转拼音', 'PinYin', '在线中文转拼音', '在线中文转拼音', 'Pinyin', '{$web_url}/images/zw.png', '其他', 1, 0, 0, 26, 0, 0,'Youngxj'),
					('站长权重查询', 'rank query', '百度权重,360权重,神马权重,站长权重查询', '百度权重,360权重,神马权重,站长权重', 'rank', '{$web_url}/images/rank.png', '站长类', 1, 0, 0, 27, 0, 0,'Youngxj'),
					('CSS代码整理', 'css Format', 'CSS代码在线整理格式化高亮', 'CSS,css代码高亮,css代码格式化,css代码整理', 'css_Format', '{$web_url}/images/css.png', '开发类', 2, 0, 0, 28, 0, 0,'Youngxj'),
					('网站状态码', 'StatusCode', '网站状态码,http状态码,网站响应值', '网站状态码,http状态码,网站响应值', 'StatusCode', '{$web_url}/images/http.png', '站长类', 1, 0, 0, 29, 0, 0,'Youngxj'),
					('Js代码整理', 'JS Format', 'Js代码加解密,格式化整理,压缩和解压', 'Js代码加解密,js代码格式化,js压缩,js解压', 'js_Format', '{$web_url}/images/js.png', '开发类', 1, 0, 0, 30, 0, 0,'Youngxj'),
					('摩斯密码转换器', 'morse', '在线摩斯密码转换器', '摩斯密码转换器', 'morse', '{$web_url}/images/morse.png', '其他', 0, 0, 0, 31, 0, 0,'Youngxj'),
					('文字排版统计', 'text count', '文字排版统计', '文字排版统计', 'text_count', '{$web_url}/images/word.png', '其他', 1, 0, 0, 32, 0, 0,'Youngxj'),
					('随机密码生成器', 'Random key', '随机密码生成器', '随机密码生成器', 'rand_key', '{$web_url}/images/key.png', '其他', 1, 0, 0, 33, 0, 0,'Youngxj'),
					('QQ空间艾特蓝链', 'qzone', 'QQ空间艾特蓝链', 'QQ空间艾特蓝链', 'qzone', '{$web_url}/images/qzone.png', '娱乐类', 1, 0, 0, 34, 0, 0,'Youngxj'),
					('略缩图四合一', 'preview', '略缩图四合一', '略缩图四合一', 'preview', '{$web_url}/images/preview.png', '其他', 1, 0, 0, 35, 0, 0,'Youngxj'),
					('个性二维码制作', 'pre_qrcode', '个性二维码制作', '个性二维码制作', 'pre_qrcode', '{$web_url}/images/qrcode.png', '其他', 1, 0, 0, 36, 0, 0,'Youngxj');
					

					CREATE TABLE IF NOT EXISTS `tools_log` (
						`user` text NOT NULL,
						`content` text NOT NULL,
						`time` text NOT NULL,
						`state` int(11) NOT NULL,
						`id` int(11) NOT NULL
					)  DEFAULT CHARSET=utf8;


					CREATE TABLE IF NOT EXISTS `tools_settings` (
						`id` int(6) unsigned NOT NULL,
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
						`templates` INT NOT NULL
					)  AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


					INSERT INTO `tools_settings` (`id`, `url`, `title`, `keyword`, `description`, `copyright`, `icp`, `footer`, `notice`, `ip_admin`, `ip_vip`, `rand`, `referer`, `ua`, `name`, `qq`, `emails`,`search`,`tools_priority`,`tz`,`tz_msg`,`templates`) VALUES
					(1, '{$web_url}', '杨小杰工具箱', '二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密', 'YoungxjTools提供二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密等优质的小工具,更加方便的使用我们的小工具,便捷站长使用工具', 'Youngxj', '', '', '', '', '127.0.0.255', 'Youngxj', 1, 1, 'YoungxjTools', '1170535111', 'blog@youngxj.cn','2','1','2','<h2>浏览器打开</h2>','0');

					CREATE TABLE IF NOT EXISTS `tools_smtp` (
						`id` int(6) unsigned NOT NULL,
						`host` tinytext NOT NULL,
						`port` tinytext NOT NULL,
						`fromname` tinytext NOT NULL,
						`username` tinytext NOT NULL,
						`password` tinytext NOT NULL,
						`smtp_from` tinytext NOT NULL,
						`sub` tinytext NOT NULL,
						`add_email` tinytext NOT NULL
					)  AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

					INSERT INTO `tools_smtp` (`id`, `host`, `port`, `fromname`, `username`, `password`, `smtp_from`, `sub`,`add_email`) VALUES
					(1, '', '', '', '', '', '', '收到一条来自xxxxx的回复','');

					CREATE TABLE IF NOT EXISTS `tools_talk` (
						`name` text NOT NULL,
						`content` text NOT NULL,
						`times` text NOT NULL,
						`state` int(30) NOT NULL,
						`emails` text NOT NULL,
						`ip` text NOT NULL,
						`id` int(11) NOT NULL
					)  DEFAULT CHARSET=utf8;

					CREATE TABLE IF NOT EXISTS `tools_user` (
						`id` int(6) unsigned NOT NULL,
						`user` text NOT NULL,
						`password` text NOT NULL,
						`type` int(30) NOT NULL,
						`token` text NOT NULL,
						`user_token` text NOT NULL
					)  AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

					INSERT INTO `tools_user` (`id`, `user`, `password`, `type`,`token`,`user_token`) VALUES
					(1, '{$username}', '{$user_pw}', 1,'','{$user_token}');

					ALTER TABLE `tools_links`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_list`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_log`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_settings`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_smtp`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_talk`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_user`
					ADD PRIMARY KEY (`id`);

					ALTER TABLE `tools_links`
					MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

					ALTER TABLE `tools_list`
					MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;

					ALTER TABLE `tools_log`
					MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

					ALTER TABLE `tools_settings`
					MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

					ALTER TABLE `tools_smtp`
					MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

					ALTER TABLE `tools_talk`
					MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

					ALTER TABLE `tools_user`
					MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

					";

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
						curl_get_https('https://api.yum6.cn/service/inc_url.php?url='.getWebUrl());
						?>
						<div class="login-wrap">
							<div class="panel-body">
								<div class="cd-nugget-info">
									<h1>YoungxjTools成功安装。</h1>
									<h1>1、网站安装成功.</h1>
									<h1>2、共写入<code><?php echo $num;?></code>条数据</h1>
									<h1>3、YoungxjQQ：1170535111</h1>
									<input type="submit" name="submit" value="网站首页" onclick="javascrtpt:window.location.href='<?php echo $web_url;?>/index.php'">
									<input type="submit" name="submit" value="QQ交流群" onclick="javascrtpt:window.location.href='http://shang.qq.com/wpa/qunwpa?idkey=3ce04929f3f5c27b3fc20a892fefd8bfa9a2849f6e33fb4c49b1f1ab16991ff5'">
									<input type="submit" name="submit" value="网站后台" onclick="javascrtpt:window.location.href='<?php echo $web_url;?>/tools_admin'">
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
