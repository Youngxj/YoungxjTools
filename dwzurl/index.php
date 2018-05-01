<?php
$id="3";
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
					<input type="text" class="form-control" aria-label="..." id="form-control">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">启动<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="javascript:dwzurl()">dwzurl(跳转)</a></li>
							<li><a href="javascript:dwzqrcode()">dwzqrcode(跳转)</a></li>
                          	<li><a href="javascript:sinadwz()">新浪短网址</a></li>
                          	<li><a href="javascript:sinalong()">新浪短网址还原</a></li>
                          	<li><a href="javascript:eps_gs()">eps.gs短网址</a></li>
                          	<li><a href="javascript:eps_gs_un()">eps.gs短网址还原</a></li>
							<li role="separator" class="divider"></li>
							<li class="disabled"><a href="http://www.youngxj.cn">©Youngxj</a></li>
						</ul>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="form-controls text-center">
				<label class="control-label" for="inputContent">返回的内容:</label><br/>
				
			</div>
		</div>
	</div>
</div>
<?php include '../more.php';more('dwzurl');?>
<script type="text/javascript" src="dwzurl.php"></script>
<?php include '../footer.php';?>