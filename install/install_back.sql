--
-- 表的结构 `tools_links`
--

CREATE TABLE IF NOT EXISTS `tools_links` (
  `id` int(6) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `type` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ;

--
-- 转存表中的数据 `tools_links`
--

INSERT INTO `tools_links` (`id`, `name`, `description`, `url`, `type`, `state`, `priority`) VALUES
(1, '杨小杰博客', '杨小杰博客提供免费教程下载和网站搭建技术教程,主要分享和发布网站源码,致力创造一个高质量网络资源教程的分享平台', 'http://www.youngxj.cn', 1, 0, 0),
(2, 'YoungxjTools', 'YoungxjTools', 'https://tools.yum6.cn', 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tools_list`
--

CREATE TABLE IF NOT EXISTS `tools_list` (
  `title` varchar(30) NOT NULL,
  `subtitle` text NOT NULL,
  `explains` text NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `tools_url` varchar(30) NOT NULL,
  `tools_img` text NOT NULL,
  `tools_type` text NOT NULL COMMENT '1:站长-2:开发-3:娱乐-4:其他',
  `priority` int(30) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '内外站类型',
  `id` int(11) NOT NULL,
  `tools_number` int(11) NOT NULL,
  `tools_love` int(11) NOT NULL
) ;

--
-- 转存表中的数据 `tools_list`
--

INSERT INTO `tools_list` (`title`, `subtitle`, `explains`, `keyword`, `tools_url`, `tools_img`, `tools_type`, `priority`, `state`, `type`, `id`, `tools_number`, `tools_love`) VALUES
('字符加解密', 'EnCode Or DeCode', '支持url加解密、base64加解密、md5加密、addsl', 'url加解密,base64加解密,md5加密,正则转义,图片', 'code', '//tools.yum6.cn/images/code.png', '站长类', 1, 0, 0, 1, 0, 0),
('Dns解析记录', 'Dns', 'Dns解析记录查询', 'dns解析查询,dns记录查询,ns解析查询', 'dns', '//tools.yum6.cn/images/dns.png', '站长类', 1, 0, 0, 2, 0, 0),
('短网址生成', 'Dwz Url', '短网址跳转防红生成工具', '短网址,dwz,短网址生成,免费防红,防红接口,ae博客', 'dwzurl', '//tools.yum6.cn/images/dwz.png', '站长类', 0, 0, 0, 3, 0, 0),
('ICP备案查询', 'icp', '域名备案信息查询', 'icp备案,备案查询,域名信息查询,备案记录查询', 'icp', '//tools.yum6.cn/images/icp.png', '站长类', 0, 0, 0, 4, 0, 0),
('IP地址查询', 'IP Query', 'Ip地址相关信息查询', 'ip定位,ip相关,ip地址归属', 'ip', '//tools.yum6.cn/images/ip.png', '站长类', 0, 0, 0, 5, 0, 0),
('全民K歌解析', 'KG Analysis', '解析的音乐归视频上传者所有。本工具只提供音乐下载地址', '全民K歌,K歌解析,全民K歌解析工具', 'kg', '//tools.yum6.cn/images/kge.png', '娱乐类', 0, 0, 0, 6, 0, 0),
('超级Ping', 'Super Ping', '超级Ping用于测试网站节点响应速度', '超级ping,在线ping,网站测速,网站解析查询,地区测速', 'ping', '//tools.yum6.cn/images/ping.png', '站长类', 1, 0, 0, 7, 0, 0),
('端口扫描', 'Port Blast', '批量扫描IP端口打开情况', '端口扫描,在线扫描工具,批量扫描,ip端口查询', 'portblast', '//tools.yum6.cn/images/port.png', '站长类', 0, 0, 0, 8, 0, 0),
('QQ在线状态', 'QQ State', '查询QQ是否电脑在线,强制会话', 'qq查询,QQ状态,QQ相关', 'qqstate', '//tools.yum6.cn/images/qq.png', '站长类', 99, 0, 0, 9, 0, 0),
('二维码生成', 'Qrcode', '方便快捷版二维码生成，统一大小', 'qrcode,二维码,自定义二维码,二维码在线生成', 'qrcode', '//tools.yum6.cn/images/qrcode.png', '站长类', 0, 0, 0, 10, 0, 0),
('前端在线运行', 'run', '在线运行,前端测试,代码审计,运行测试', '在线运行,前端测试,代码审计,运行测试', 'run', '//tools.yum6.cn/images/html.png', '开发类', 0, 0, 0, 11, 0, 0),
('新浪图床', 'Sina Img', '全网CDN图床 不限流量 无限外链 永久免费 图床API', '图床,急速图床,免费图床,新浪图床,cdn图床', 'sinaimg', '//tools.yum6.cn/images/sina.png', '站长类', 0, 0, 0, 12, 0, 0),
('时间戳转换', 'Unix Timestamp', '转换Unix时间戳转', '时间戳,unix时间戳,北京时间,时间转换', 'timestamp', '//tools.yum6.cn/images/time.png', '站长类', 0, 0, 0, 13, 0, 0),
('useragent分析', 'Ua分析', '获取并分析useragent', '浏览器信息,用户信息,ua查询,useragent分析', 'ua', '//tools.yum6.cn/images/useragent.png', '站长类', 0, 0, 0, 14, 0, 0),
('子域名爆破', 'Url Blast', '字典批量扫描域名已解析域名(已存放1393字段)', '字典批量扫描域名已解析域名(已存放1393字段)', 'urlblast', '//tools.yum6.cn/images/urlblast.png', '站长类', 0, 0, 0, 15, 0, 0),
('特殊群昵称制作', 'withdraw', 'QQ群娱乐昵称包含撤回以及echo', 'qq群昵称.群昵称制作,特殊群昵称,娱乐昵称,群名片', 'qqqun', '//tools.yum6.cn/images/qun.png', '娱乐类', 0, 0, 0, 16, 0, 0),
('猜数小游戏', 'Game', '0-100随机生成一个数字，请答对这数字！', 'js小游戏,jsgame,智力游戏,猜数测试', 'cs', '//tools.yum6.cn/images/js.png', '娱乐类', 0, 0, 0, 17, 0, 0),
('Whios查询', 'Whois query', '域名注册信息查询', 'whois信息,域名whois,域名注册信息,whois反查', 'whois', '//tools.yum6.cn/images/icp.png', '站长类', 0, 0, 0, 18, 0, 0),
('手机号码归属地查询', 'phone', '手机号码归属地查询', '手机号码归属地查询', 'phone', '//tools.yum6.cn/images/phone.png', '站长类', 0, 0, 0, 19, 0, 0),
('帮你百度一下', 'go to baidu', '帮你百度一下', '百度,百度一下', 'baidu', '//tools.yum6.cn/images/baidu.png', '娱乐类', 0, 0, 0, 20, 0, 0),
('dns检测', 'dns test', '在线dns检测', 'dns,dns检测,dns劫持', 'dnstest', '//tools.yum6.cn/images/dns.png', '站长类', 0, 0, 0, 21, 0, 0),
('贴吧云签到', 'baidu tb', '每日自动执行百度贴吧的签到功能', '云签到,百度贴吧', 'tb.youngxj.cn', '//tools.yum6.cn/images/baidu.png', '站长类', 0, 0, 1, 22, 0, 0),
('在线制作网页', 'Online production', '在线一键制作个性网页', '在线网页制作,个人网页制作,表白网页制作,祝福网页制作,免费', 'zx.yum6.cn', '//tools.yum6.cn/images/online.gif', '娱乐类', 0, 0, 1, 23, 0, 0),
('听歌房', 'music', '一款开源的基于网易云音乐api的在线音乐播放器', '孟坤播放器,在线音乐播放器,MKOnlinePlayer,网', 'music.yum6.cn', '//tools.yum6.cn/images/music.png', '娱乐类', 0, 0, 1, 24, 0, 0),
('音乐搜索器', 'music seach', '麦葱特制多站合一音乐搜索解决方案，可搜索试听网易云音乐、QQ音乐、酷狗音乐、酷我音乐、虾米音乐、百度音乐、一听音乐、咪咕音乐、荔枝FM、蜻蜓FM、喜马拉雅FM、全民K歌、5sing原创翻唱音乐。', '音乐搜索,音乐搜索器,音乐试听,音乐在线听,网易云音乐,QQ', 'music', '//tools.yum6.cn/images/music.png', '娱乐类', 0, 0, 0, 25, 0, 0),
('中文转拼音', 'PinYin', '在线中文转拼音', '在线中文转拼音', 'Pinyin', '//tools.yum6.cn/images/zw.png', '其他', 1, 0, 0, 26, 0, 0),
('站长权重查询', 'rank query', '百度权重,360权重,神马权重,站长权重查询', '百度权重,360权重,神马权重,站长权重', 'rank', '//tools.yum6.cn/images/rank.png', '站长类', 1, 0, 0, 27, 0, 0),
('CSS代码整理', 'css Format', 'CSS代码在线整理格式化高亮', 'CSS,css代码高亮,css代码格式化,css代码整理', 'css_Format', '//tools.yum6.cn/images/css.png', '开发类', 2, 0, 0, 28, 0, 0),
('网站状态码', 'StatusCode', '网站状态码,http状态码,网站响应值', '网站状态码,http状态码,网站响应值', 'StatusCode', '//tools.yum6.cn/images/http.png', '站长类', 1, 0, 0, 29, 0, 0),
('Js代码整理', 'JS Format', 'Js代码加解密,格式化整理,压缩和解压', 'Js代码加解密,js代码格式化,js压缩,js解压', 'js_Format', '//tools.yum6.cn/images/js.png', '开发类', 1, 0, 0, 30, 0, 0),
('摩斯密码转换器', 'morse', '在线摩斯密码转换器', '摩斯密码转换器', 'morse', '//tools.yum6.cn/images/morse.png', '其他', 0, 0, 0, 31, 0, 0),
('文字排版统计', 'text count', '文字排版统计', '文字排版统计', 'text_count', '//tools.yum6.cn/images/word.png', '其他', 1, 0, 0, 32, 0, 0),
('随机密码生成器', 'Random key', '随机密码生成器', '随机密码生成器', 'rand_key', '//tools.yum6.cn/images/key.png', '其他', 1, 0, 0, 33, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tools_log`
--

CREATE TABLE IF NOT EXISTS `tools_log` (
  `user` text NOT NULL,
  `content` text NOT NULL,
  `time` text NOT NULL,
  `state` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- 表的结构 `tools_settings`
--

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
  `emails` text NOT NULL
) ;

--
-- 转存表中的数据 `tools_settings`
--

INSERT INTO `tools_settings` (`id`, `url`, `title`, `keyword`, `description`, `copyright`, `icp`, `footer`, `notice`, `ip_admin`, `ip_vip`, `rand`, `referer`, `ua`, `name`, `qq`, `emails`) VALUES
(1, 'tools.yum6.cn', '杨小杰工具箱', '二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密', 'YoungxjTools提供二维码生成,dns解析查询,短网址生成,icp备案查询,ip定位,全民k歌解析,在线ping,端口扫描,子域名扫描,QQ在线状态,在线运行,时间戳转换,ua查询,whois查询,字符加解密等优质的小工具,更加方便的使用我们的小工具,便捷站长使用工具', 'Youngxj', '', '', '', '', '127.0.0.255', 'Youngxj', 1, 1, 'YoungxjTools', '1170535111', 'blog@youngxj.cn');

-- --------------------------------------------------------

--
-- 表的结构 `tools_smtp`
--

CREATE TABLE IF NOT EXISTS `tools_smtp` (
  `id` int(6) unsigned NOT NULL,
  `host` tinytext NOT NULL,
  `port` tinytext NOT NULL,
  `fromname` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `smtp_from` tinytext NOT NULL,
  `sub` tinytext NOT NULL
) ;

--
-- 转存表中的数据 `tools_smtp`
--

INSERT INTO `tools_smtp` (`id`, `host`, `port`, `fromname`, `username`, `password`, `smtp_from`, `sub`) VALUES
(1, '', '', '', '', '', '', '收到一条来自xxxxx的回复');

-- --------------------------------------------------------

--
-- 表的结构 `tools_talk`
--

CREATE TABLE IF NOT EXISTS `tools_talk` (
  `name` text NOT NULL,
  `content` text NOT NULL,
  `times` text NOT NULL,
  `state` int(30) NOT NULL,
  `emails` text NOT NULL,
  `ip` text NOT NULL,
  `id` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- 表的结构 `tools_user`
--

CREATE TABLE IF NOT EXISTS `tools_user` (
  `id` int(6) unsigned NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `type` int(30) NOT NULL
);

--
-- 转存表中的数据 `tools_user`
--

INSERT INTO `tools_user` (`id`, `user`, `password`, `type`) VALUES
(1, 'admin', 'bc82d5aa164f0ec990d1a9adaa7fcc73', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tools_links`
--
ALTER TABLE `tools_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_list`
--
ALTER TABLE `tools_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_log`
--
ALTER TABLE `tools_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_settings`
--
ALTER TABLE `tools_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_smtp`
--
ALTER TABLE `tools_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_talk`
--
ALTER TABLE `tools_talk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_user`
--
ALTER TABLE `tools_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tools_links`
--
ALTER TABLE `tools_links`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tools_list`
--
ALTER TABLE `tools_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tools_log`
--
ALTER TABLE `tools_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tools_settings`
--
ALTER TABLE `tools_settings`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tools_smtp`
--
ALTER TABLE `tools_smtp`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tools_talk`
--
ALTER TABLE `tools_talk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tools_user`
--
ALTER TABLE `tools_user`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
