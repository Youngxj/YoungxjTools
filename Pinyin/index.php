<?php
$id = '26';
include '../header.php';
?>


<style>
  body{min-height:300px;background: #f6f6f6;}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.CodeMirror{min-height:385px;font-family: Menlo,Monaco,Consolas,"Andale Mono","lucida console","Courier New",monospace;}.textareaCode{min-height:100%}#iframeResult{display: block;overflow: hidden;border:0!important;min-width:100px;width:100%;min-height:385px;background-color:#fff}@media screen and (max-width:768px){.textareaCode{height:300px}.CodeMirror{height:300px;font-family: Menlo,Monaco,Consolas,"Andale Mono","lucida console","Courier New",monospace;}#iframeResult{height:300px}.form-inline{padding:6px 0 2px 0}}.logo h1{background-image:url(/images/logo-domain-white.png);background-repeat:no-repeat;text-indent:-9999px;width:160px;height:39px;margin-top:10px;display:block}
  .iframewrapper{min-height:600px;}
</style>
<div class="container clearfix" >
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <form class="form-inline">
            <div class="row">
              <div class="col-xs-12">
               <div style="min-height:34px;">
			<span>输出类型：</span>
			<label><input type="radio" name="pinyin_type" value="0" checked/>带声调拼音</label>
			<label><input type="radio" name="pinyin_type" value="1"/>不带声调拼音</label>
			<label><input type="radio" name="pinyin_type" value="2"/>拼音首字母</label>
            <label><input type="checkbox" name="polyphone" title="支持多音字仅仅是将所有可能的组合列举出来，要做到准确识别多音字还需非常完善的词库"/>简单支持多音字</label>
		</div>
             </div>
          </div>
        </form>
      </div>
      <div class="panel-body" style="height:400px;">
        <textarea class="form-control textareaCode"  id="textareaCode_zw" name="textareaCode"></textarea>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><button type="button" class="btn btn-default" onclick="layer.msg('如有问题请联系QQ1170535111');">拼音输出</button><button type="button" class="btn btn-default" onclick="copyUrl2();">复制内容</button><button type="button" class="btn btn-success" id="read">朗读</button></div>
      <div class="panel-body" style="height:400px;"><textarea class="form-control textareaCode"  id="textareaCode_py"></textarea></div>
    </div>
  </div>
</div>
</div>
<audio id="voice" src=""></audio>
<script type="text/javascript" src="dict/pinyin_dict_withtone.js"></script>
	<script type="text/javascript" src="pinyinUtil.js"></script>
<script type="text/javascript" src="py.php"></script>

<?php include '../footer.php';?>