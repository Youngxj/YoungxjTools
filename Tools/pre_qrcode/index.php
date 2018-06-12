<?php
$id="36";
include '../../header.php';
header('Content-type: image/png');
?>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">个性二维码制作</h3>
    </div>
    <div class="panel-body">
      <div class="col-md-6 col-md-offset-3">
        <div class="input-group">
          <span class="input-group-addon" id="sizing-addon1">网址</span>
          <input id="value" type="text" class="form-control" placeholder="输入网址[必填http://或https://]" aria-describedby="sizing-addon1">
        </div>
        <br/>
        <center>
          <div class="input-group">
            <input id="file" type="file">
          </div>
          <br/>
          <label>
            黑色: <input type="radio" value="threshold" name="filter" >
            彩色: <input type="radio" value="color" name="filter" checked>
          </label>
          <div class="group">
            <div style="display:none">
              <div id="qr"></div>
            </div>
          </div>
          <div id="combine"></div>
          <span id="png" class="btn btn-info">保存图片(下载时请填写相应后缀名)</span>
        </center>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">工具简介</h3>
    </div>
    <div class="panel-body">
      <p>一键制作个性二维码，支持黑白背景和彩色背景样式。</p>
      <p>如需制作彩色背景请先选择图片再点击“彩色”即可。</p>
    </div>
  </div>
</div>
<script src="js/base64.js"></script>
<script src="js/canvas2image.js"></script>
<script src="js/main.js"></script>
<script src="js/qrcode.js"></script>
<script src="js/qart.min.js"></script>

<script>
  document.getElementById("png").onclick = function() {
    var oCanvas = document.getElementById("canvas");
    Canvas2Image.saveAsPNG(oCanvas);  // 这将会提示用户保存PNG图片
    // 返回一个包含PNG图片的<img>元素
    var oImgPNG = Canvas2Image.saveAsPNG(oCanvas, true);   
    // 这些函数都可以接受高度和宽度的参数
    // 可以用来调整图片大小
    // 把画布保存成100x100的png格式
    Canvas2Image.saveAsPNG(oCanvas, false, 100, 100);
  }

</script>

<?php include 'footer.php';?>