<?php
$id="1";
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
          <input type="text" class="form-control" aria-label="...">
          <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">启动<span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="javascript:urlencode()">urlencode</a></li>
              <li><a href="javascript:urldecode()">urldecode</a></li>
              <li><a href="javascript:base64_encode()">base64_encode</a></li>
              <li><a href="javascript:base64_decode()">base64_decode</a></li>
              <li><a href="javascript:md5()">md5</a></li>
              <li><a href="javascript:addslashes()">addslashes</a></li>
              <li><a href="javascript:stripslashes()">stripslashes</a></li>
              <li><a href="javascript:base64_image_mult()">base64_image_mult</a></li>
              <li><a href="javascript:base64_image_url()">base64_image_url</a></li>
              <li role="separator" class="divider"></li>
              <li class="disabled"><a href="http://www.youngxj.cn">©Youngxj</a></li>
            </ul>
          </div><!-- /btn-group -->
        </div><!-- /input-group -->
        <small><code>如果没有报错但是不返回内容就需要注意字符编码问题(目前工具编码为UTF-8)</code></small>
      </div><!-- /.col-lg-6 -->
      <div class="form-controls">
        <label class="control-label" for="inputContent">返回的内容:</label>
        <textarea class="form-control" rows="10" onclick="oCopy(this)" id="form-control" placeholder="如果没有报错但是不返回内容就需要注意字符编码问题"></textarea>
      </div>
      <form id="form1">
        <div class="upload-drag" id="upload-drag" onclick="file.click()" title="点击上传图片">
          <img src="https://ww2.sinaimg.cn/large/843dc74bgy1fpkedpgq3tj201c01c0of.jpg">
          <p id="stat">点击上传</p>
          <input type="file" id="file" name="file" onchange="sc();" style="display:none" accept="image/*">  
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="code.php"></script>
<?php include '../footer.php';?>