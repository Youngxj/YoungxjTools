<?php
$id="13";
include '../header.php';?>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
			<div class="form-group" id="input-wrap">
				<label class="control-label control-msg" for="inputContent" copy="Youngxj|杨小杰，admin@youngxj.com">时间：<a id="js_datetime" href="javascript:to_datetime();layer.tips('将现在时间填充到文本框', '#js_datetime');" title="将现在时间填充到文本框"></a><br/>时间戳：<a id="js_timestamp" href="javascript:to_timestamp();layer.tips('将现在时间填充到文本框', '#js_timestamp');" title="将现在时间填充到文本框"></a></label>
				
              <div class="input-group">
					<input type="text" class="form-control" placeholder="时间戳" id="o_timestamp">
					<div class="input-group-btn">
						<button class="btn btn-primary" type="button" id="btn_state_o">转换</button>
					</div><!-- /btn-group -->
					<input type="text" class="form-control" placeholder="YYYY-MM-DD HH:mm:ss" id="o_datetime">
				</div><!-- /input-group -->
				<br/>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="YYYY-MM-DD HH:mm:ss" id="f_datetime" >
					<input type="text" id="mirror_field" readonly hidden>
					<div class="input-group-btn">
						<button class="btn btn-primary" type="button" id="btn_state_f">转换</button>
					</div><!-- /btn-group -->
					<input type="text" class="form-control" placeholder="时间戳" id="f_timestamp">
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
		</div>
	</div>
</div>
<script type="text/javascript" src="timestamp.php"></script>
<?php include '../footer.php';?>