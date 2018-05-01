<?php
$id="30";
include '../header.php';
$string = <<<html
/*   美化：格式化代码，使之容易阅读			*/
/*   净化：去掉代码中多余的注释、换行、空格等	*/
/*   压缩：将代码压缩为更小体积，便于传输		*/
/*   解压：将压缩后的代码转换为方便阅读的格式	*/

/*   如果有用，请别忘了推荐给你的朋友：		*/
/*   javascript在线美化、净化、压缩、解压：http://tools.yum6.cn/js_Format/   */

/*   只需要复制js代码即可，无需<script>标签				*/

/*   以下是演示代码				*/

	$.ajax({
            type: "GET",
            url: "url.php",
            dataType: "json",
			cache: false,
            success: function (data) {
                alert(data);
            }
        });

html;
?>
<div class="container clearfix" >
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="form-inline">
            <div class="row">
              <div class="col-xs-6">
                <div style="min-height:34px;">
                  <div class="form-group">
                    <div id="info" name="info"><p class="text-success">工具准备就绪</p></div>
                    <span>加密层数：
                      <span style="color: red" id="deg">0</span>层</span>
                    <span>处理时间：
                      <span style="color: blue" id="tme">0</span>毫秒</span>
                    <p class="text-danger" id="errmsg"></p>
                  </div>
                  
                </div>
              </div>
              <div class="col-xs-6 text-right">
                <p>
                <select id="compresstype" name="compresstype" class="form-control">
                    <option value="0" selected="">普通压缩</option>
                    <option value="1">加密压缩</option>
                  </select>
                  <select id="tabsize" name="tabsize" class="form-control">
                    <option value="1">制表符缩进</option>
                    <option value="2">2个空格缩进</option>
                    <option value="4" selected="">4个空格缩进</option>
                    <option value="8">8个空格缩进</option>
                  </select>
                </p>
                <p>
                <button class="btn btn-default" id="copycode" type="button" data-clipboard-target='#content'><i class="fa fa-copy"></i> 复制内容</button>
                <button class="btn btn-warning" id="encode" type="button" title="加密/编码/压缩/Encode/Compress"><i class="fa fa-sign-in"></i> 压缩</button>
                <button class="btn btn-success" id="decode" type="button" title="解密/解码/格式化/decode/format"><i class="fa fa-sign-out"></i> 解密</button>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body" style="height:400px;">
          <textarea style="width:100%;height:100%;" id="content" placeholder="请输入待处理的 js 代码" onfocus="this.select()" rows="15" name="content"><?php if(!isset($string)||$string==''){?><?php }else{echo $string;} ?></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">工具简介</div>
    <div class="panel-body">
      <p>专门解码解密eval(function(p,a,c,k,e,r){})、eval(function(p,a,c,k,e,d){})以及eval(function(h,b,j,f,g,i){})等多种编码加密的代码。 在线格式化Javascript脚本、JS脚本、HTML代码。</p>
      <p class="text-success">
        <i class="fa fa-warning"></i> 注：加密前请备份原 JS代码，加密后请测试JS代码能否正常使用。</p>
      <p class="text-success">
        <i class="fa fa-external-link"></i> 欢迎使用<a href="http://tools.yum6.cn/run/">前端在线运行测试工具</a></p>
    </div>
  </div>
</div>
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
<script src="js/code_packed.js"></script>
<script src="js/eval_out.js"></script>
<?php include '../footer.php';?>