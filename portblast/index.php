<?php
$id="8";
include '../header.php';?>
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
					<input type="text" class="form-control" aria-label="..." onkeyup="value=value.replace(/[^\d\.]/g,'')" id="form-control">
					<div class="input-group-btn">
						<button class="btn btn-default" type="button" id="btn_state">启动</button>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="row">
				<div class="col-md-5"><input type="text" class="form-control" id="user_port" placeholder="自定义端口(多端口用.分隔)" onkeyup="value=value.replace(/[^\d\.]/g,'')"></div>
			</div>
			<div class="table-responsive position">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td colspan="5" class="text-center success"><strong>常见端口参照表(以下端口无需再次添加)</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>21(Ftp)</th>
							<th>22(Ssh)</th>
							<th>23(Telnet)</th>
							<th>25(Smtp)</th>
							<th>8888(BT)</th>
						</tr>
						<tr>
							<th>80(Http)</th>
							<th>110(Pop3)</th>
							<th>143(IMAP)</th>
							<th>443(Https)</th>
							<th>445(共享)</th>
						</tr>
						<tr>
							<th>1433(MSSQL)</th>
							<th>3306(MYSQL)</th>
							<th>3311(康乐)</th>
							<th>3312(康乐)</th>
							<th>3389(远程桌面)</th>
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
<?php include '../more.php';more_ip('portblast');?>
<script type="text/javascript" src="portblast.php"></script>
<?php include '../footer.php';?>