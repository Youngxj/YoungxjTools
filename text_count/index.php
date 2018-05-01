<?php
$id="32";
include '../header.php';
$string = <<<html
/*   适用于word一键排版和统计字数        */
/*   如果有用，请别忘了推荐给你的朋友   */
/*   word在线排版和整理：http://tools.yum6.cn/text_count/   */

html;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">字数统计</div>
    <div class="panel-body text-center">
      <div class="row">
        <div class="col-sm-8">
          <textarea class="form-control" rows="14" id="content" placeholder="在这里贴入文字内容" style="margin-bottom: 10px"><?php if(!isset($string)||$string==''){?><?php }else{echo $string;} ?></textarea>
          <div class="btns">
            <button class="btn btn-info" onclick="count()">
              <i class="fa fa-refresh"></i> 统计字数</button>
            <div class="btn-group">
              <button type="button" class="btn btn-success" onclick="format()">一键排版</button>
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a href="javascript:;" onclick="noSpace()">去行尾空格</a></li>
                <li>
                  <a href="javascript:;" onclick="noEmptyLines()">删除空行</a></li>
              </ul>
            </div>
            <button class="btn btn-warning" id="copycode" data-clipboard-target='#content'>
              <i class="fa fa-copy"></i> 复制</button>
            <button class="btn btn-default" onclick="$(&#39;#content&#39;).val(&#39;&#39;);">
              <i class="fa fa-trash-o"></i> 清空</button>
          </div>
        </div>
        <div class="col-sm-4">
          <table class="table table-bordered table-hover">
            <tbody><tr>
              <td style="width: 100px">总字数</td>
              <td>
                <span id="id_total">0</span>(个)</td></tr>
              <tr>
                <td>总行数</td>
                <td>
                  <span id="id_part">0</span>(行)</td></tr>
              <tr>
                <td class="">中文字数</td>
                <td class="">
                  <span id="id_c_total">0</span>(个)</td></tr>
              <tr>
                <td class="">中文标点</td>
                <td class="">
                  <span id="id_c_punctuation">0</span>(个)</td></tr>
              <tr>
                <td class="">字母个数</td>
                <td class="">
                  <span id="id_e_total">0</span>(个)</td></tr>
              <tr>
                <td class="">单词个数</td>
                <td class="">
                  <span id="id_e_words">0</span>(个)</td></tr>
              <tr>
                <td class="">英文标点</td>
                <td class="">
                  <span id="id_e_punctuation">0</span>(个)</td></tr>
              <tr>
                <td class="">数字个数</td>
                <td class="">
                  <span id="id_n_total">0</span>(个)</td></tr>
              <tr>
                <td class="">数字组</td>
                <td class="">
                  <span id="id_n_words">0</span>(个)</td></tr>
            </tbody></table>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">工具简介</div>
    <div class="panel-body">
      <p>在线统计字数，在线排版。</p>
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
<script src="js/count.js"></script>
  <?php include '../footer.php';?>