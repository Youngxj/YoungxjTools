<?php
$id="2";
include '../header.php';?>
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
			<div class="form-group" id="input-wrap">
				<style type="text/css">
					#clear:after{content:'清空';position: absolute;top: 0;right: 0;padding: 5px 10px;background: #EA5A47;color: #fff;cursor: pointer;}
				</style>
				<label class="control-label control-msg" for="inputContent" copy="Youngxj|杨小杰，admin@youngxj.com"></label>
				<div class="input-group">
					<input type="text" class="form-control" aria-label="..." name="form-control" id="form-control">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">启动<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="javascript:dns('ns');">ns</a></li>
							<li><a href="javascript:dns('a');">a</a></li>
							<li><a href="javascript:dns('cname');">cname</a></li>
							<li><a href="javascript:dns('aaaa');">aaaa</a></li>
							<li><a href="javascript:dns('mx');">mx</a></li>
							<li><a href="javascript:dns('txt');">txt</a></li>
							<li><a href="javascript:dns('srv');">srv</a></li>
							<li><a href="javascript:dns('ptr');">ptr</a></li>
							<li><a href="javascript:dns('soa');">soa</a></li>
							<li><a href="javascript:dns('hinfo');">hinfo</a></li>
							<li><a href="javascript:dns('naptr');">naptr</a></li>
							<li role="separator" class="divider"></li>
							<li class="disabled"><a href="http://www.youngxj.cn">©Youngxj</a></li>
						</ul>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="form-controls text-left" style="position: relative;">
				<pre id="content"></pre>
				<span id="clear"></span>
				<div id="msg"></div>
			</div>
		</div>
	</div>
</div>
<?php include '../more.php';more('dns');?>
<script type="text/javascript" src="dns.php"></script>
<?php include '../footer.php';?>