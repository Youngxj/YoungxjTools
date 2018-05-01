<?php 
$id="14";
include '../header.php';?>
<?php
function getBrowser($agent = null)
{
	if ($agent==null) {
		$u_agent = $agent ?: isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	}else{
		$u_agent = $agent;
	}

	if (!$u_agent) return ['agent' => '', 'browser' => '', 'version' => '', 'os' => '', 'kernel' => ''];

    //操作系统
	if (preg_match('/Android/i', $u_agent)) {
		$os = 'Android';
	} elseif (preg_match('/linux/i', $u_agent)) {
		$os = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$os = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$os = 'windows';
	} else {
		$os = 'Unknown';
	}

    //内核
	if (preg_match('/Trident/i', $u_agent)) {
		$kernel = 'Trident';
	} elseif (preg_match('/Webkit/i', $u_agent)) {
		$kernel = 'Webkit';
	} elseif (preg_match('/Gecko/i', $u_agent)) {
		$kernel = 'Gecko';
	} elseif (preg_match('/Presto/i', $u_agent)) {
		$kernel = 'Presto';
	} else {
		$kernel = 'Unknown';
	}

    //浏览器
	switch (true) {
		case (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) :
		$browser = 'Internet Explorer';
		$fix = 'MSIE';
		break;
        case (preg_match('/Trident/i', $u_agent)) : // IE11专用
        $browser = 'Internet Explorer';
        $fix = 'rv';
        break;
        case (preg_match('/Edge/i', $u_agent)) ://必须在Chrome之前判断
        $browser = $fix = 'Edge';
        break;
        case (preg_match('/MicroMessenger/i', $u_agent)) ://必须在QQBrowser之前判断
        $browser = $fix = 'MicroMessenger';
        break;
        case (preg_match('/QQ/i', $u_agent)) ://必须在Chrome之前判断
        $browser = $fix = 'QQBrowser';
        break;
        case (preg_match('/UC/i', $u_agent)) ://必须在Apple Safari之前判断
        $browser = $fix = 'UCBrowser';
        break;
        case (preg_match('/Firefox/i', $u_agent)) :
        $browser = $fix = 'Firefox';
        break;
        case (preg_match('/Chrome/i', $u_agent)) :
        $browser = $fix = 'Chrome';
        break;
        case (preg_match('/Safari/i', $u_agent)) :
        $browser = $fix = 'Safari';
        break;
        case (preg_match('/Opera/i', $u_agent)) :
        $browser = $fix = 'Opera';
        break;
        case (preg_match('/Netscape/i', $u_agent)) :
        $browser = $fix = 'Netscape';
        break;
        default:
        $browser = $fix = 'Unknown';
    }

    $pattern = "/(?<bro>Version|{$fix}|other)[\/|\:|\s](?<ver>[0-9a-zA-Z\.]+)/i";
    preg_match_all($pattern, $u_agent, $matches);
    $i = count($matches['bro']) !== 1 ? (strripos($u_agent, "Version") < strripos($u_agent, $fix) ? 0 : 1) : 0;

    return [
    'agent' => $u_agent,
    'browser' => $browser,
    'version' => $matches['ver'][$i] ?: '?',
    'os' => $os,
    'kernel' =>$kernel];
}
if (isset($_POST['useragent'])) {
	$useragent = $_POST['useragent'];
}else{
	$useragent = null;
}
$arr = getBrowser($useragent);
?>
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
			<div class="form-group" id="input-wrap">
				<label class="control-label control-msg" for="inputContent" copy="Youngxj|杨小杰，admin@youngxj.com"></label>
				<form action="#" method="POST">
					<div class="input-group">
						<input type="text" class="form-control" value="<?php echo $arr['agent'];?>" name="useragent">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit" id="btn_state">分析</button>
						</div><!-- /btn-group -->
					</div><!-- /input-group -->
				</form>
			</div><!-- /.col-lg-6 -->
			<div class="table-responsive position">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td colspan="2" class="text-center success"><strong>UA基本信息如下(<a href="http://www.aeink.com/383.html" target="_blank">更多常见ua请查看</a>)</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>浏览器</th>
							<th><?php echo $arr['browser'];?></th>
						</tr>
						<tr>
							<th>浏览器版本</th>
							<th><?php echo $arr['version'];?></th>
						</tr>
						<tr>
							<th>操作系统</th>
							<th><?php echo $arr['os'];?></th>
						</tr>
						<tr>
							<th>操作内核</th>
							<th><?php echo $arr['kernel'];?></th>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-controlss text-left">
				<div id="content"></div>
				<div id="msg"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	control('请输入ua信息');
	$("#btn_state").click(function() {
		if ($('.form-control').val() == "") {layer.alert('你是不是忘记填内容了？');return false;}
	});
</script>
<?php include '../footer.php';?>