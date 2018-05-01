<?php
$id="16";
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
					<input type="text" class="form-control" aria-label="..." id="withdraw_echo">
					<div class="input-group-btn">
						<button class="btn btn-default" type="button" id="btn_echo">制作Echo</button>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			<div class="row">
				<div class="col-md-4"><input type="text" class="form-control" id="withdraw_front" placeholder="前缀"></div>
				<div class="col-md-4"><input type="text" class="form-control" id="withdraw_behind" placeholder="后缀"></div>
				<div class="col-md-4"><button class="btn btn-default col-md-12" type="button" id="btn_with">制作撤回</button></div>
			</div>
			<div class="form-controls text-center">
				<label class="control-label" for="inputContent">返回的内容:</label>
				<textarea class="form-control" rows="5" onclick="oCopy(this)" id="form-control_content"></textarea>
			</div>
			<div class="text-left Explain">
				<dl>
					<dt>Echo</dt>
					<dd>小杰|Echo</dd>
					<dd>小杰|Print</dd>
					<dd>小杰|Printf</dd>
					<dd>小杰|TracePrint</dd>
				</dl>
				<dl>
					<dt>撤回</dt>
					<dd>输入想要的名字，点击生成</dd>
					<dd>完整替换微信／QQ名字</dd>
					<dd>在对话中撤回消息，就会出现“XXX撤回了一条消息并XXXX”的效果 </dd>
					<dd>该效果会出现在别人的聊天界面里，本人的聊天界面里只显示撤回了一条消息，所以要问别人是否成功才知道</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="with.php"></script>
<?php include '../footer.php';?>