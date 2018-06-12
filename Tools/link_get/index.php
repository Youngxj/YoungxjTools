<?php
$id = '37';
include '../../header.php';
?>
<div class="container">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h3 class="panel-title">在线网址链接批量生成器</h3>
    </div>
    <div class="panel-body">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <label for="scq_url">网址</label>：<input type="text" id="scq_url" size="46" value="http://www.a.com/(*).jpg" class="form-control">变量用(*)号表示
        </div>
        <div class="form-group">
          <input name="scq_radio" type="radio" id="scq_dcsl" checked="checked"> <label for="scq_dcsl">等差数列</label>
          <label for="scq_dcsl_sx">首项</label>：<input type="text" id="scq_dcsl_sx" size="5" value="1">
          <label for="scq_dcsl_xs">项数</label>：<input type="text" id="scq_dcsl_xs" size="5" value="5">
          <label for="scq_dcsl_gc">公差</label>：<input type="text" id="scq_dcsl_gc" size="5" value="1"> 
          <input type="checkbox" id="scq_dcsl_bl"><label for="scq_dcsl_bl">补0</label>
          <input type="checkbox" id="scq_dcsl_dx"><label for="scq_dcsl_dx">倒序</label>
        </div>
        <div class="form-group">
          <input type="radio" name="scq_radio" id="scq_dbsl"> <label for="scq_dbsl">等比数列</label>
          <label for="scq_dbsl_sx">首项</label>：<input type="text" id="scq_dbsl_sx" size="5" value="1">
          <label for="scq_dbsl_xs">项数</label>：<input type="text" id="scq_dbsl_xs" size="5" value="5">
          <label for="scq_dbsl_gc">公比</label>：<input type="text" id="scq_dbsl_gb" size="5" value="2"> 
          <input type="checkbox" id="scq_dbsl_bl"><label for="scq_dbsl_bl">补0</label>
          <input type="checkbox" id="scq_dbsl_dx"><label for="scq_dbsl_dx">倒序</label>
        </div>
        <div class="form-group">
          <input type="radio" name="scq_radio" id="scq_zmbh"> <label for="scq_zmbh">字母变化</label>
          <label for="scq_zmbh_c">从</label>：<input type="text" id="scq_zmbh_c" size="5" value="a">
          <label for="scq_zmbh_d">到</label>：<input type="text" id="scq_zmbh_d" size="5" value="z">
          <input type="checkbox" id="scq_zmbh_dx"><label for="scq_zmbh_dx">倒序</label>
        </div>
        <div align="center"><input type="button" onclick="run();" value="生成" class="btn btn-success"></div>

      </div>
    </div>
  </div>
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title panel-warning">生成结果</h3>
    </div>
    <div class="panel-body">
      <textarea id="scq_jieguo" rows="20" class="form-control" onclick="this.focus();this.select()"></textarea>
    </div>
  </div>
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">工具简介</h3>
    </div>
    <div class="panel-body">
      <p>批量下载功能可以方便的创建多个包含共同特征的下载任务。例如网站A提供了10个这样的下载链接：</p>
      <p>http://www.a.com/01.zip</p>
      <p>http://www.a.com/02.zip</p>
      <p>...（中间省略）</p>
      <p>http://www.a.com/10.zip</p>
      <p>这10个地址只有数字部分不同，如果用(*)表示不同的部分，这些地址可以写成：</p>
      <p>http://www.a.com/(*).zip</p>
      <p>同时，通配符长度指的是这些地址不同部分数字的长度，例如：</p>
      <p>从01.zip－10.zip，通配符长度是2；</p>
      <p>从001.zip－010.zip，通配符长度是3。</p>
      <p>注意，在填写从xxx到xxx的时候，虽然是从01到10或者是001到010，但是，当您设定了通配符长度以后，就只需要填写成从1到10。 填写完成后，在示意窗口会显示第一个和最后一个任务的具体链接地址，您可以检查是否正确，然后点确定完成操作。</p>
      <p>应用举例：<br>1.百度站长后台批量提交待收录文章可以使用该工具将文章链接批量生成后进行提交。<br>2.网址批量抓取可使用该工具批量生成链接地址。</p>
    </div>
  </div>
</div>
<script src="run.js"></script>
<?php include '../../footer.php';?>