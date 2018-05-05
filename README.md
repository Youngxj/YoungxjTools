# YoungxjTools

#### 项目介绍
工具箱？导航？你觉得是什么它就是什么
欢迎加入QQ交流群 774688083 反馈和讨论关于YoungxjTools

#### 项目架构

项目中主要包含和使用到如下框架和开源项目
1. bootstrap 3.3.7
2. font-awesome 4.7
3. layer 3.1.1
4. jquery 2.1.4
5. 阿里云矢量图库
6. 等等……


#### 安装教程

1. 安装请直接上传项目，解压到根目录，之后访问域名即可，路径为/install
2. 初始账号：admin
3. 初始密码：admin000
4. 请搭建完成后尽快修改密码

#### 使用说明

1. 内置的所有工具，大部分基于杨小杰api，以及其他网站的api接口，不代表能永久有效使用
2. 至于另外一些开源的工具，部分也是依靠网上的资源汇聚而成。
3. 如果你想自己做工具，请参考《答疑解惑》

#### 项目特色

	前台支持两主题的切换,ajax点赞,浏览次数统计和站内站外分开跳转的功能
	内置时间轴功能,可以记录你的网站发展历程和一些重要的消息
	关于页面支持留言，内置smtp发信可以轻松完成用户交流
	后台使用Unicorn Admin开源项目进行对接搭建完成
具体功能如下：
1. 工具(主页的列表)的管理功能
2. 友情链接的增加、删除等等管理功能
3. 时间轴的发布与管理功能
4. 内置留言管理功能
5. 网站信息设置，内置smtp发信配置


#### 答疑解惑

1. 问：有些小伙伴可能会拿去做导航，做工具箱，那么之后如果我需要添加和创建我自己的工具应该如何操作呢？

答：项目本身支持站内站外跳转，添加新的工具箱，你只需要在网站根目录创建一个文件夹，在文件夹内部就是你的工具箱，只需要在头部插入

	<?php
	$id="xx"; //后台生成的工具id
	include "../header.php";
	?>
	这是你的主体
	<?php include '../footer.php';?>

2. 问：伪静态规则有没有特别的要求？

答：其实本项目并没有设置相关伪静态规则

3. 问：后台路径和密码是什么？

答：后台路径为/tools_admin    账号：admin    密码：admin000
请搭建完成后尽快修改密码

4. 问：如何安装？

答：安装请直接上传项目，解压到根目录，之后访问域名即可，路径为/install

5. 问：php版本是否有限制？

答：本项目搭建到测试都使用的5.6的，使用7.2测试安装时发现不能正常安装，所以建议大家还是使用5.4-5.6的版本

6. 问：我需要注意些什么？

答：本身为开源项目，也是第一次做开源项目，所以本程序未加密，版权可以在后台设置，但是建议大家不改，尊重作者！

7. 问：谷歌浏览器，火狐浏览器下载附件报毒？

答：开源项目，代码基本都是我亲自审查的，所以我可以保证是没有问题的，哈勃分析也显示未发现风险，至于为毛它俩要爆我毒，我就不清楚了

8. 问：无限循环安装是什么鬼？

答：如果确定数据库已经导入，请删除header.php文件中几行代码：

	if ($_SERVER["DOCUMENT_ROOT"] == getcwd()) {
	if(!file_exists('./install/install.lock')){
		exit('你还没有安装！<a href="./install">点击安装<a>');
	}
	}else{
		if(!file_exists('../install/install.lock')){
			exit('你还没有安装！<a href="../install">点击安装<a>');
		}
	}

9. 建议在php中安装redis缓存插件，至于怎么安装请百度，用到缓存插件的目前只有ajax提交评论，如果遇到评论异常请联系解决

更多问题有待发掘……


#### 更新记录

1. 2018年5月1日 22:59:35 经网友反馈安装完成后数据库未导入数据的问题，现已更新初始数据库文件。
2. 2018年5月2日 15:56:05 更新数据库文件，更新ajax评论提交，更新小细节
3. 2018年5月3日 22:04:35 修复一个bug
4. 2018年5月5日 13:16:16 完善程序安装，修复安装错误，修复安装锁错误，修复评论提交失败，更新三个小工具