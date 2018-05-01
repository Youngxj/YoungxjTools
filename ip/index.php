<?php
$id="5";
include '../header.php';?>
<?php
$ip = real_ip();
$url = "https://api.yum6.cn/ip.php?ip=".$ip;
$json_string = json_decode(file_get_contents($url),1);
$url_tb = "https://api.yum6.cn/ip.php?type=tb&ip=".$ip;
$json_string_tb = json_decode(file_get_contents($url_tb),1);
$content = '<table class="table table-bordered"><tbody><tr><th scope="row">IP地址</th><td>'.$json_string['ip'].'</td></tr><tr><th scope="row">IP long</th><td>'.$json_string['longip'].'</td></tr><tr><th scope="row">归属地(纯真库)</th><td>'.$json_string['location'].'</td></tr><tr><th scope="row">归属地(淘宝库)</th><td>'.$json_string_tb['location'].'</td></tr><tr><th scope="row">IPv4地址段</th><td>'.$json_string['ipv4'].'</td></tr><tr><th scope="row">网络名称</th><td>'.$json_string['network'].'</td></tr><tr><th scope="row">单位描述</th><td>'.$json_string['company'].'</td></tr></tbody></table>';
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
				<div class="input-group">
					<input type="text" class="form-control" aria-label="..." placeholder="IP" value="<?php echo real_ip();?>" onkeyup="value=value.replace(/[^\d\.]/g,'')" id="form-control">
					<div class="input-group-btn">
						<button class="btn btn-default" type="button" id="btn_state">启动</button>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="form-controlss text-lefter">
				<div id="content"><?php echo $content;?></div>
				<div id="msg"></div>
			</div>
		</div>
	</div>
</div>
<?php include '../more.php';more_ip('ip');?>
<script type="text/javascript" src="ip.php"></script>
<?php include '../footer.php';?>