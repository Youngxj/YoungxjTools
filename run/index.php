<?php 
$id="11";
include '../header.php';?>
<script src="//cdn.bootcss.com/codemirror/5.2.0/codemirror.min.js"></script>
<link rel="stylesheet" href="//cdn.bootcss.com/codemirror/5.2.0/codemirror.min.css">
<script src="//cdn.bootcss.com/codemirror/5.2.0/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="//cdn.bootcss.com/codemirror/5.2.0/mode/css/css.min.js"></script>
<script src="//cdn.bootcss.com/codemirror/5.2.0/mode/javascript/javascript.min.js"></script>
<script src="//cdn.bootcss.com/codemirror/5.2.0/mode/xml/xml.min.js"></script>
<script src="//cdn.bootcss.com/codemirror/5.2.0/addon/edit/closetag.min.js"></script>
<script src="//cdn.bootcss.com/codemirror/5.2.0/addon/edit/closebrackets.min.js"></script>
<style>
  body{min-height:300px;background: #f6f6f6;}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.CodeMirror{min-height:385px;font-family: Menlo,Monaco,Consolas,"Andale Mono","lucida console","Courier New",monospace;}#textareaCode{min-height:300px}#iframeResult{display: block;overflow: hidden;border:0!important;min-width:100px;width:100%;min-height:385px;background-color:#fff}@media screen and (max-width:768px){#textareaCode{height:300px}.CodeMirror{height:300px;font-family: Menlo,Monaco,Consolas,"Andale Mono","lucida console","Courier New",monospace;}#iframeResult{height:300px}.form-inline{padding:6px 0 2px 0}}.logo h1{background-image:url(/images/logo-domain-white.png);background-repeat:no-repeat;text-indent:-9999px;width:160px;height:39px;margin-top:10px;display:block}
  .iframewrapper{min-height:600px;}
</style>
<div class="container clearfix" >
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <form class="form-inline">
            <div class="row">
              <div class="col-xs-6">
               <button type="button" class="btn btn-default" onclick="layer.msg('仅支持前端测试使用(Html/Js/Css)');">源代码：</button>
               <button type="button" class="btn btn-default" onclick="go_ajax();">Ajax</button>
               <button type="button" class="btn btn-default" onclick="go_multipart();">Mult</button>
             </div>
             <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-success" onclick="submitTryit()" id="submitBTN"><span class="glyphicon glyphicon-send"></span> 点击运行</button>
            </div>
          </div>
        </form>
      </div>
      <div class="panel-body" style="height:400px;">
        <textarea class="form-control"  id="textareaCode" name="textareaCode"></textarea>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><form class="form-inline"> <button type="button" class="btn btn-default" onclick="layer.msg('如有问题请联系QQ1170535111');">运行结果</button></form></div>
      <div class="panel-body" style="height:400px;"><div id="iframewrapper"></div></div>
    </div>
  </div>
</div>
</div>
<script>
  function go_ajax(){
  	var txt = `<!--支持快捷ajax传递数据-->\r
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"><\/script>\r
<script>\r
	$.ajax({\r
            type: "GET",\r
            url: "url.php",\r
            dataType: "json",\r
			cache: false,\r
            success: function (data) {\r
                alert(data);\r
            }\r
        });\r
<\/script>`;
    editor.setValue(txt);
  }
  function go_multipart(){
  	var txt = `<html>\r
<body>\r
<form action="https://api.yum6.cn/sinaimg.php" method="post"\r
enctype="multipart/form-data">\r
<label for="file">Filename:</label>\r
<input type="file" name="file" id="file" /> \r
<br />\r
<input type="submit" name="submit" value="Submit" />\r
</form>\r

</body>\r
</html>`;
    editor.setValue(txt);
  }
</script>
<script type="text/javascript" src="run.php"></script>
<?php include '../footer.php';?>