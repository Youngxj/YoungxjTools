<?php
$id="40";
include '../../header.php';?>
<script src="js.js"></script>
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
      <form  name="ascii">
        <div class="form-group">
          <label class="sr-only" for="exampleInputAmount">英文字母</label>
          <div class="input-group">
            <div class="input-group-addon">文本</div>
            <input type="text" class="form-control" id="exampleInputAmount" placeholder="Young xj" value="Young xj" name="inputField">
          </div>
          <div>字体风格:
            <select name="textStyle" class="form-control"> 
              <option>Futuristik</option>
              <option selected="">Block</option>
            </select>
          </div> 
        </div>
        <div class="form-group">
          <input onclick="beginGenerator()" type="button" value="生成线条字" name="button" class="btn btn-success">
          <input onclick="outputField.select();document.execCommand(&quot;Copy&quot;)" type="button" value="复制" class="btn btn-info">

        </div>
        <span id="windowMarker">
          <textarea name="outputField" wrap="off" style="height:200px; font-family:'宋体';" class="form-control">
线条字生成器，是一个生成由字符组成的“线条字”的在线转换工具。因其笔划形如缝纫线痕，故名。
本转换器只支持字母和数字的转换，另外，可以使用换行符“\n”对输入的内容进行一次换行操作。
          </textarea> 
        </span>
      </form>
    </div>
    
  </div>
  
</div>
<?php include '../../footer.php';?>