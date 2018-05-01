<?php
$id="17";
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
				<div class="input">
					答题内容：<input type="number" class="form-control" id="sz" ><br>
					答题次数：<input type="text" class="form-control" id="test" readonly='readonly'><br>
					答题结果：<input type="text" class="form-control" id="jg" readonly='readonly' ><br><br>
					<input type="button"  class="btn btn-primary col-xs-6" value="我猜" id=tj onclick="fun();">
					<input type="button" class="btn btn-primary col-xs-6" value="重置" id="cz" onclick="cx();">
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="form-controlss text-center">
				<div id="content"></div>
				<div id="msg"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="cs.php"></script>
<?php include '../footer.php';