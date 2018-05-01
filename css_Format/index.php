<?php
$id="28";
include '../header.php';
$string = <<<html
/*   美化：格式化代码，使之容易阅读	*/
/*   净化：将代码单行化，并去除注释   */
/*   整理：按照一定的顺序，重新排列css的属性   */
/*   优化：将css的长属性值优化为简写的形式   */
/*   压缩：将代码最小化，加快加载速度   */

/*   如果有用，请别忘了推荐给你的朋友：		*/
/*   css在线美化、压缩：https://tools.yum6.cn/css_Format   */
/*   v1.1 2018-04-25	完成css代码整理功能   */
/*   v1.1 2018-04-25	完成css代码压缩功能   */

body {
    font-family: "HanHei SC","PingHei","PingFang SC","微软雅黑","Helvetica Neue","Helvetica","Arial",sans-serif;
    font-size: 13px;
    line-height: 1.846;
    color: #666666;
    background-color: #ffffff;
}
html;
?>
<script src="js/codemirror.js" charset="utf-8"></script>
    <script src="js/css.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="css/codemirror.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/cssbeautify.js" charset="utf-8"></script>
    <script src="js/format.js" charset="utf-8"></script>
<div class="container clearfix" >
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="form-inline">
            <div class="row">
              <div class="col-xs-6">
                <div style="min-height:34px;">
                  <span>缩进:</span>
                  <label><input checked="" type="radio" name="indent" id="fourspaces" value="fourspaces" onchange="format()">4空格</label>
                  <label><input type="radio" name="indent" id="twospaces" value="twospaces" onchange="format()">2空格</label>
                  <label><input type="radio" name="indent" id="tab" value="tab" onchange="format()">Tab空格</label>
                </div>
             </div>
              <div class="col-xs-6 text-right">
                <button type="button" class="btn btn-success" onclick="clear_code()" id="clear" title="建议先整理后压缩,避免存在一些编写上的问题"><span class="glyphicon glyphicon-send"></span> 压缩</button>
              </div>
          </div>
        </div>
      </div>
      <div class="panel-body CodeMirror CodeMirror-wrap" style="height:400px;">
        <textarea id="raw" rows="22" autofocus="autofocus" spellcheck="false" onchange="format()" onkeydown="format()" style="display: none;"><?php if(!isset($string)||$string==''){?><?php }else{echo $string;} ?></textarea>
      </div>
    </div>
  </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="form-inline">
            <div class="row">
              <div class="col-xs-12">
                <div style="min-height:34px;">
                  <span>打开大括号:</span>
                  <label><input checked="" type="radio" name="openbrace" id="openbrace-end-of-line" onchange="format()">大括号同行</label>
        		  <label><input type="radio" name="openbrace" id="openbrace-separate-line" onchange="format()">大括号独行</label>
                  <label><input checked="" type="checkbox" name="autosemicolon" id="autosemicolon" onchange="format()">自动分号</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body CodeMirror CodeMirror-wrap" style="height:400px;">
          <textarea id="beautified" rows="22" readonly="" style="display: none;"></textarea>
        </div>
      </div>
    </div>
</div>
</div>
<script>
  function clear_code(){
    if(editor.getValue()==''){layer.alert('是不是忘记填写内容了');return false;}
    var txt = editor.getValue();
    $.post("https://api.yum6.cn/css_format/",{code:txt,method:'ys'},function(result){
      		layer.msg('压缩完成');
            editor.setValue(result.content);
          });
  }
</script>
<?php include '../footer.php';?>