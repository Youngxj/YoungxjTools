<?php
$id="31";
include '../header.php';?>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">摩斯密码转换器</div>
    <div class="panel-body text-center">
      <div class="form-group">
        <textarea class="form-control" rows="3" id="input" placeholder="在这里贴入要转换的内容">YoungxjTools tools.yum6.cn</textarea></div>
      <div class="form-group row">
        <div class="col-xs-4">
          <div class="input-group">
            <span class="input-group-addon">分割</span>
            <input type="text" class="form-control" id="space" value="/"></div>
        </div>
        <div class="col-xs-4">
          <div class="input-group">
            <span class="input-group-addon">长</span>
            <input type="text" class="form-control" id="long" value="-"></div>
        </div>
        <div class="col-xs-4">
          <div class="input-group">
            <span class="input-group-addon">短</span>
            <input type="text" class="form-control" id="short" value="."></div>
        </div>
      </div>
      <div class="form-group">
        <button class="btn btn-success" id="encode">
          <i class="fa fa-sign-in"></i> 编码</button>
        <button class="btn btn-info" id="decode">
          <i class="fa fa-sign-out"></i> 解码</button>
        <button class="btn btn-info" id="copycode" data-clipboard-target='#result'>
          <i class="fa fa-copy"></i> 复制</button>
        <button class="btn btn-info" id="play" style="display: none">
          <i class="fa fa-play-circle-o"></i> 播放</button>
        <button class="btn btn-default" onclick="$(&#39;#input&#39;).val(&#39;&#39;);$(&#39;#output&#39;).val(&#39;&#39;)">
          <i class="fa fa-trash-o"></i> 清空</button>
      </div>
      <div class="form-group">
        <textarea class="form-control" rows="3" id="result" placeholder="转换结果" readonly="" onmouseover="this.focus();this.select();"></textarea>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">工具简介</div>
    <div class="panel-body">
      <p>摩斯电码（Morse alphabet）（又译为摩尔斯电码）是一种时通时断的信号代码，这种信号代码通过不同的排列顺序来表达不同的英文字母、数字和标点符号等。</p>
      <p>摩斯电码由美国人摩尔斯（Samuel Finley Breese Morse）于1837年发明，为摩尔斯电报机的发明（1835年）提供了条件。</p>
      <p>摩斯电码加密的字符只有字符，数字，标点，不区分大小写。本工具对其进行了扩展，使其支持编码、解码中文汉字(原理：将中文字符先转换为Unicode编码再进行摩斯电码转换)。</p>
      <p>如遇解码失败，请确保长、短、分隔符设置正确。</p>
    </div>
  </div>
</div>
<script src="js/xmorse.min.js"></script>
<script src="js/morse.js"></script>
<script>
  var clipboard = new ClipboardJS('#copycode');
  clipboard.on('success',function(e){
    e.clearSelection();
    layer.msg('复制成功！');
  });
  clipboard.on('error',function(e){
    e.clearSelection();
    layer.msg('复制失败！');
  });
</script>
<?php include '../footer.php';?>