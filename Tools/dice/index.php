<?php
$id = '38';
include '../../header.php';
ob_start();
if(getParam('xiao')||getParam('da')||getParam('dan')||getParam('shuang')||getParam('baozi')){
	$da = getParam('da') ? getParam('da') : '0';
	$xiao = getParam('xiao') ? getParam('xiao') : '0';
	$dan = getParam('dan') ? getParam('dan') : '0';
	$shuang = getParam('shuang') ? getParam('shuang') : '0';
	$baozi =getParam('baozi') ? getParam('baozi') : '0';
	$arra = array('da','xiao','dan','shuang','baozi');
	$arr_mamey = array($da,$xiao,$dan,$shuang,$baozi);
	$ya_msg = '';
	for ($i=0; $i < count($arra); $i++) { 
		$type = $arra[$i];
		switch ($type) {
			case 'da':
			$types = '大';
			break;
			case 'xiao':
			$types = '小';
			break;
			case 'dan':
			$types = '单';
			break;
			case 'shuang':
			$types = '双';
			break;
			case 'baozi':
			$types = '豹子';
			break;
			default:
			$types = '';
			break;
		}
		$mamey = $arr_mamey[$i];
		if(yazhu($type,$mamey)){
			if ($arr_mamey[$i]) {
				$ya_msg.= "押注".$types."成功<br/>";
			}
		}else{
			if ($arr_mamey[$i]) {
				$ya_msg.= "押注".$types."失败<br/>";
			}
		}

	}
	$ys_msgs = "layer.alert('".$ya_msg."');window.location.href='index.php';";
}
$cookie = $_COOKIE['username'] ? $_COOKIE['username'] : '';

$url = curl_request('http://api.yum6.cn/dice_game/index.php/index/yal?type=index&token='.$cookie);


//$url = file_get_contents('https://api.yum6.cn/dice_game/index.php/index/yal?type=index');

$json = json_decode($url,1);

if ($json['code']=='210') {
	$dqqishu = $json['dqqishu'];
	$outtime = $json['outtime'];
	$last_qishu = $json['last']['qishu'];
	$last_jssum = $json['last']['jssum'];
	$last_dianshu1 = $json['last']['dianshu1'];
	$last_dianshu2 = $json['last']['dianshu2'];
	$last_dianshu3 = $json['last']['dianshu3'];
	$last_dianshustate = $json['last']['dianshustate'];
	
	$daycount_n = $json['daycount']['countn'];
	$daycount_m = $json['daycount']['countm'];
	$yazhu_da = $json['yazhu']['da'];
	$yazhu_xiao = $json['yazhu']['xiao'];
	$yazhu_dan = $json['yazhu']['dan'];
	$yazhu_shuang = $json['yazhu']['shuang'];
	$yazhu_baozi = $json['yazhu']['baozi'];
	if($json['userstate']['code']!='206'){
		$user_state = $json['userstate']['userstate'];
		$user_id = $json['userstate']['userid'];
		$user_name = $json['userstate']['username'];
		$user_jinbi = $json['userstate']['jinbi'];
		$user_da = $json['userstate']['da'];
		$user_xiao = $json['userstate']['xiao'];
		$user_dan = $json['userstate']['dan'];
		$user_shuang = $json['userstate']['shuang'];
		$user_baozi = $json['userstate']['baozi'];
	}
}else{
	eixt('数据接口获取失败');
}

function yazhu($type,$mamey){
	$cookie = $_COOKIE['username'] ? $_COOKIE['username'] : '';
	$arr = array('type'=>$type,'mamey'=>$mamey);
	$ya_url = curl_request('http://api.yum6.cn/dice_game/index.php/index/yal?token='.$cookie,$arr);
	//$ya_url = request_post('https://api.yum6.cn/dice_game/index.php/index/yal',$arr);
	//var_dump($ya_url);
	$ya_json = json_decode($ya_url,1);
	if($ya_json['msg']=='押注成功'){
		return true;
	}else{
		return false;
	}
}

?>
<style type="text/css">
#dianshuimg img{width:50px;}
.shouye-header{padding-top: 10px;}
.shouye-b input{width: 100px;}
</style>
<div class="container">
	<div class="panel panel-default">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">骰子游戏</h3>
			</div>
			<div class="panel-body">
				<ul id="myTab" class="nav nav-tabs">  
					<li class="active"><a href="#shouye" data-toggle="tab">首页</a></li>
					<li><a href="#user" data-toggle="tab">用户信息</a></li>
					<li><a href="#touzhu" data-toggle="tab">投注记录</a></li>
					<li><a href="#lishicx" data-toggle="tab">历史查询</a></li>
					<li><a href="#gamegz" data-toggle="tab">游戏规则</a></li>
					<li><a href="#talk" data-toggle="tab" class="talk-list" >交流区</a></li> 

				</ul>  

				<div id="myTabContent" class="tab-content">  
					<div class="tab-pane fade in active" id="shouye">
						<div class="shouye-header">
							<h4>数据汇总</h4>
							<p>今日掷骰总数： <b id="countn"><?php echo $daycount_n;?></b></p>
							<p>今日掷骰总金币：<b id="countm"><?php echo $daycount_m;?></b></p>
						</div>
						<hr/>
						<div class="shouye-b">
							<h4>第<b id="qishu"><?php echo $dqqishu;?></b>期</h4>
							<p>剩余<b id="outime"><?php echo $outtime;?></b>秒开蛊,买大买小买定离手</p>
							<form action="index.php" method="post">
								<p>小(1赔2)(<b id="xiao_val"><?php echo $yazhu_xiao;?></b>金币) <input type="number" id="xiao" class="yazhu" class="form-control" name="xiao"></p>
								<p>大(1赔2)(<b id="da_val"><?php echo $yazhu_da;?></b>金币) <input type="number" id="da" class="yazhu" class="form-control" name="da"></p>
								<p>单(1赔2)(<b id="dan_val"><?php echo $yazhu_dan;?></b>金币) <input type="number" id="dan" class="yazhu" class="form-control" name="dan"></p>
								<p>双(1赔2)(<b id="shuang_val"><?php echo $yazhu_shuang;?></b>金币) <input type="number" id="shuang" class="yazhu" class="form-control" name="shuang"></p>
								<p>豹子(1赔10)(<b id="baozi_val"><?php echo $yazhu_baozi;?></b>金币) <input type="number" id="baozi" class="yazhu" class="form-control" name="baozi"></p>
								<button type="submit" class="btn btn-info">押注提交</button>
							</form>
						</div>
						<hr/>
						<div class="shouye-last">
							<div class="shouye-header">
								<h4>上一期开奖结果</h4>
								<p>上<b id="lastqishu"><?php echo $last_qishu;?></b>期点数<b id="dianshu"><?php echo $last_dianshu1.$last_dianshu2.$last_dianshu3;?></b> <b id="dianshustate"><?php echo $last_dianshustate;?></b>赢家获得<b id="jiesuan"><?php echo $last_jssum;?></b>金币</p>
								<p id="dianshuimg"><img src="images/<?php echo $last_dianshu1;?>.png"><img src="images/<?php echo $last_dianshu2;?>.png"><img src="images/<?php echo $last_dianshu3;?>.png"></p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="user">  
						<div class="shouye-header">
							<h4>用户信息</h4>
							<?php if($json['userstate']['user_state']=='0'){?>
								<p>用户未登录</p>

								<p>用户名：<input type="text" name="username" id="username" class="form-control"></p>
								<p>用户密码：<input type="text" name="password" id="password" class="form-control"></p>
								<input type="submit" id="login" value="登陆" class="btn btn-primary" onclick="login();">
								<input type="submit" id="signup" value="注册" class="btn btn-info" onclick="signup();">

							<?php }else{?>
								<p>用户名：<b id="username"><?php echo $user_name;?></b></p>
								<p>用户ID：<b id="userid"><?php echo $user_id;?></b></p>
								<p>携带金币：<b id="usermeny"><?php echo $user_jinbi;?></b></p>
								<h4>押注情况</h4>
								<p>大：<b id="user_da"><?php echo $user_da;?></b>金币</p>
								<p>小：<b id="user_xiao"><?php echo $user_xiao;?></b>金币</p>
								<p>单：<b id="user_dan"><?php echo $user_dan;?></b>金币</p>
								<p>双：<b id="user_shuang"><?php echo $user_shuang;?></b>金币</p>
								<p>豹子：<b id="user_baozi"><?php echo $user_baozi;?></b>金币</p>
								<a href="javascript:out_user()" id="out_user">退出登录</a>
							<?php }?>
						</div>
					</div>
					<div class="tab-pane fade" id="touzhu">
						<div class="shouye-header">
							<h4>投注记录</h4>
							<p>会员ID：<input type="number" name="userid" id="userid_q" value="<?php echo $user_id;?>" class="form-control"></p>
							<p>查询期数：<input type="number" name="qishu" id="qishu_q" value="<?php echo $dqqishu;?>" class="form-control"></p>
							<input type="submit" id="get_tz" value="查询" class="btn btn-warning" onclick="query();">
							<p><ol id="que"> </ol></p>
						</div>
					</div>
					<div class="tab-pane fade" id="lishicx">  
						<div class="shouye-header">
							<h4>历史记录</h4>
							<p>显示以往十期的开奖记录</p>
							<p class="form-inline">期数：<input type="number" id="ls_qishu" class="form-control"><input class="btn btn-link" type="submit" id="qishu_get" value="查找" onclick="qishu_get();"></p>
							<p><ol class="list" id="list"></ol></p>
						</div>
					</div>
					<div class="tab-pane fade" id="gamegz">
						<div class="shouye-header">
							<h4>游戏规则</h4>
							<div class="well well-lg">
								<ol>
									<li>小:4,5,6,7,8,9,10</li>
									<li>大:11,12,13,14,15,16,17</li>
									<li>单:5,7,9,11,13,15,17</li>
									<li>双:4,6,8,10,12,14,16</li>
									<li>豹子:三个骰子点数相同</li>
									<li>每次赢家获得奖金90%</li>
									<li>每期最多投50000金币</li>
									<li>五分钟开盘一次</li>
								</ol>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="talk">
						<div class="shouye-header">
							<h4>用户交流区</h4>
							<p>谨慎发言，否则封IP</p>
							<p id="talk_content" class="talk_content"></p>
							<hr/>
							<div class="form-group">
								<label for="exampleInputEmail1">留言内容：</label><span style="color:red;">*</span>
								<textarea class="form-control" rows="5" id="content" placeholder="文明交流……" name="content" required="required"></textarea>
							</div>
							<input type="submit" id="talk_get" value="发布" class="btn btn-info" onclick="talk_get();">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">项目介绍</h3>
			</div>
			<div class="panel-body">
				<h3>项目简介:</h3>
				<p>作者：涛 or 杰</p>
				<p>这是一个纯json实现的一个在线小游戏,具体玩法参考游戏规则</p>
				<p>项目文档已发布到api文档中</p>
				<p>地址：<a href="http://doc.yum6.cn/web/#/1?page_id=24" target="_blank">http://doc.yum6.cn/web/#/1?page_id=24</a></p>
				<p>项目目前可实现多平台对接</p>
				<p>可参与web,机器人,app等平台移植开发使用</p>
				<h3>声明：</h3>
				<p>《刑法》第三百零三条规定：“以营利为目的，聚众赌博、开设赌场或者以赌博为业的，处三年以下有期徒刑、拘役或者管制，并处罚金。</p>
				<p>本项目只是概率小游戏并不涉及盈利，请无脑用户带上脑子</p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if($ys_msgs){echo $ys_msgs;}?>
	// function login(){
	// 	var username = $('#username').val();
	// 	var password = $('#password').val();
	// 	$.post('login.php',{username:username,password:password},function(data){
	// 		if (data.code == '200') {
	// 			layer.alert(data.msg);
	// 			window.location.href="index.php";
	// 		}else{
	// 			layer.alert(data.msg);
	// 		}
	// 	})
	// }
	function settime(outtime) {
		if (outtime == 0) {
			window.location.reload();
		} else {
			$('#outime').html(outtime);
			outtime--; 
		} 
		setTimeout(function() {
			settime(outtime)
		},950) 
	}
	$(function(){
		settime('<?php if($outtime){echo $outtime;}else{echo '999';};?>');
	});

	function query(){
		var type= "ya";
		var userid = $('#userid_q').val();
		var qishu  = $('#qishu_q').val();
		if(userid==''||qishu==''){
			layer.msg('所有项都不能为空');
			return false;
		}
		$.post('https://api.yum6.cn/dice_game/index.php/query/query/query',{type:type,userid:userid,qishu:qishu},function(data){
			if(data.code=='200'){
				layer.msg('查询完毕');
				if(data.state['msg'] == '输'){state = '损失'}else{state = '盈利'}
					$('#que').append('<li>期数:'+data.qishu+'开'+data.dianshustate+'('+'押注:大'+data.da+'小'+data.xiao+'单'+data.dan+'双'+data.shuang+'豹子'+data.baozi+')'+' 共计'+state+data.state['num']+'金币</li>');
			}else if(data.code=='201'){
				$('#que').append('<li>期数:'+data.qishu+'未开</li>');
			}else{
				layer.msg(data.msg);
			}
		})
	}

	$.getJSON("https://api.yum6.cn/dice_game/index.php/query/query/query?type=lishi",function(data){
		if (data[0]) {
			for(var a=0;a<data.length;a++){
				var qishu = data[a]['qishu'];
				var dianshu1 = data[a]['dianshu1'];
				var dianshu2 = data[a]['dianshu2'];
				var dianshu3 = data[a]['dianshu3'];
				var dianshustate = data[a]['dianshustate'];
				$('#list').append('<li>第'+qishu+'期开'+dianshu1+dianshu2+dianshu3+' '+dianshustate+'</li>');
			}
		}else{
			layer.msg('历史列表通信错误');
		}
	});
	function qishu_get()
	{
		var qishu = $('#ls_qishu').val();
		var type  = 'lishi';
		$.post("https://api.yum6.cn/dice_game/index.php/query/query/query",{type:type,qishu:qishu},function(data){
			if (data['code']=="201"){
				layer.msg('查询完毕');
				var qishu = data['qishu'];
				$('#list').append('<li>第'+qishu+'期开未开</li>');
			}else if(data['code']=="200"){
				layer.msg('查询完毕');
				var qishu = data['qishu'];
				var dianshu1 = data['dianshu1'];
				var dianshu2 = data['dianshu2'];
				var dianshu3 = data['dianshu3'];
				var dianshustate = data['dianshustate'];
				$('#list').append('<li>第'+qishu+'期开'+dianshu1+dianshu2+dianshu3+' '+dianshustate+'</li>');
			}else{
				layer.msg(data.msg);
			}
		});
	}
	$(function(){
		$.getJSON("https://api.yum6.cn/dice_game/index.php/index/talk/talk_list",function(data){
			if(data){
				for(var c =0;c< data.length;c++){
					$('#talk_content').append('<div class="talk_list"><blockquote><p><b>'+data[c]['username']+'</b>：'+data[c]['content']+'</p><footer>'+data[c]['time']+'</footer></blockquote></div>');
				}
			}
		});
	});

	function login(){
		var username = $('#username').val();
		var password = $('#password').val();
		$.post('login.php',{username:username,password:password},function(data){
			if (data.code == '200') {
				layer.alert(data.msg);
				window.location.href="index.php";
			}else{
				layer.alert(data.msg);
			}
		})
	}
	function signup(){
		var username = $('#username').val();
		var password = $('#password').val();
		$.post('https://api.yum6.cn/dice_game/index.php/user/user/zc',{username:username,password:password},function(data){
			if (data.code == '200') {
				layer.alert('注册成功<br/>ID：'+data['user']['userid']+'<br/>账号：'+data['user']['username']+'<br/>密码：'+data['user']['password']+'<br/>初始金币：'+data['user']['csjb']);
			}else{
				layer.alert(data.msg);
			}
		})
	}
	function out_user(){
		setCookie('username');
		layer.msg('已退出');
		window.location.href="index.php";
	}
	function talk_get(){
		var content = $('#content').val();
		var cache=getCookie('username');
		if(content==''){
			layer.alert('内容为空');
			return false;
		}

		$.post('https://api.yum6.cn/dice_game/index.php/index/talk/index',{content:content,token:cache},function(data){
			console.log(data.code);
			if(data.code=='200'){
				layer.alert('已发布');
				window.location.href="index.php";
			}else if(data.code=="201"){
				layer.alert(data.msg);
			}else if(data.code=='202'){
				layer.alert(data.msg);
			}else if(data.code=='203'){
				layer.alert(data.msg);
			}else{
				layer.alert('发布失败');
			}
		});

	}
</script>
<?php include '../../footer.php';?>

