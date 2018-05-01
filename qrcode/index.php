<?php
$id="10";
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
					<input type="text" class="form-control" aria-label="..." name="form-control" id="form-control">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">启动<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="javascript:qrcode()">自定义版</a></li>
                           <li><a href="javascript:qrcode_decode()">二维码内容获取</a></li>
							<li role="separator" class="divider"></li>
							<li class="disabled"><a href="http://www.youngxj.cn">©Youngxj</a></li>
						</ul>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="row">
				<div class="col-md-3"><input type="text" class="form-control" id="qrcode_width" placeholder="宽度"></div>
				<div class="col-md-3"><input type="text" class="form-control" id="qrcode_height" placeholder="高度"></div>
				<div class="col-md-3"><input type="text" class="form-control" id="qrcode_pro" placeholder="前景" value="#000000"></div>
				<div class="col-md-3"><input type="text" class="form-control" id="qrcode_bg" placeholder="背景" value="#ffffff"></div>
			</div>
			<div class="form-controls text-center" id="form-controls">
				<label class="control-label" for="inputContent">返回的内容:</label>
				<textarea class="form-control" rows="10" onclick="oCopy(this)" id="form-control"></textarea>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/qrcode.js"></script>
<script type="text/javascript" src="qrcode.php"></script>
<?php include '../footer.php';?>