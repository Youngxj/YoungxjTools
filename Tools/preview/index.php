<?php
$id = '35';
include '../../header.php';

?>
<script>
  if (browserRedirect()) {
    layer.msg('设备类型为手机,页面不能正常访问', {
      time: 0 //不自动关闭
      ,btn: ['返回一步', '确认']
      ,yes: function(index){
        layer.close(index);
        window.history.back(-1); 
      }
    });
  }
</script>
<link href="./css/ami.css?v=23022013" rel="stylesheet">
    <style>
      .ad {text-align: center; padding: 1em;}
    </style>
    <!-- IE8 BugFixes thanks to @ingozoell details are  https://github.com/justincavery/am-i-responsive/issues/2?utm_source=buffer&utm_campaign=Buffer&utm_content=buffer8b8d6&utm_medium=twitter -->
    <!--[if IE 8]>
<style>

.desktop iframe {
-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=0.3181, M12=0, M21=0, M22=0.3181, SizingMethod='auto expand')";
}

.laptop iframe {
-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=0.277, M12=0, M21=0, M22=0.277, SizingMethod='auto expand')";
}

.tablet iframe {
-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=0.234, M12=0, M21=0, M22=0.234, SizingMethod='auto expand')";
}

.mobile iframe {
-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=0.219, M12=0, M21=0, M22=0.219, SizingMethod='auto expand')";
}

</style>
<![endif]-->


    <!--[if lte IE 7]>
<style>

.desktop iframe {
filter: progid:DXImageTransform.Microsoft.Matrix(
M11=0.3181,
M12=0,
M21=0,
M22=0.3181,
SizingMethod='auto expand');
}

.laptop iframe {
filter: progid:DXImageTransform.Microsoft.Matrix(
M11=0.277,
M12=0,
M21=0,
M22=0.277,
SizingMethod='auto expand');
}

.tablet iframe {
filter: progid:DXImageTransform.Microsoft.Matrix(
M11=0.234,
M12=0,
M21=0,
M22=0.234,
SizingMethod='auto expand');
}


.mobile iframe {
filter: progid:DXImageTransform.Microsoft.Matrix(
M11=0.219,
M12=0,
M21=0,
M22=0.219,
SizingMethod='auto expand');
}

</style>
<![endif]-->


  <?php 
  $t="http://tools.yum6.cn";
  if(isset($_GET['url'])){
    $t=$_GET['url'];
  }
  ?>

  <body class="ami">
    <div class="wrapper">
      <section class="display">
        <div class="mobile ui-draggable">
          <div class="trim">
            <iframe src="<?php echo $t; ?>" id="mobile">
            </iframe>
          </div>
        </div>

        <div class="tablet ui-draggable">
          <div class="trim">
            <iframe src="<?php echo $t; ?>" id="tablet">
            </iframe>
          </div>
        </div>
        <div class="laptop ui-draggable">
          <div class="trim">
            <iframe src="<?php echo $t; ?>" id="laptop">
            </iframe>
          </div>
        </div>
        <div class="desktop ui-draggable">
          <div class="trim">
            <iframe src="<?php echo $t; ?>" id="desktop">
            </iframe>
          </div>
        </div>

      </section>
    </div>
	  <div style="position: fixed;bottom: 30px;right: 25px;font-size: 0;line-height: 0;z-index: 999;" class="emailss">
    <script>

      function getrec(){
        document.getElementById('url').style.display="block";
        document.getElementById('start').style.display="block";
        document.getElementById('starts').style.display="none";
      }

    </script>
    <form id="rwdform" action="" method="get">
      <input type="text" id="url" name="url"  class="btn" placeholder="地址" value="<?php echo $t;?>" style="background:#ffffff;display:none;float: left; line-height:31px; border:1px solid #ddd; padding:4px 5px 3px 20px; width:195px; color:#999;border-bottom-left-radius:5px; border-top-left-radius:5px; font-family:Times New Roman,Georgia,Serif;">
      <input type="submit" id="start" value="提交"    class="btn" style="width:60px; height:40px; background:rgb(197, 31, 31) !important; border:none; color:#fff; border-top-right-radius:5px; border-bottom-right-radius:5px;font-family:Times New Roman,Georgia,Serif;display:none;" onclick="outrec()">
    </form>
    <input type="" id="starts" value="地址" class="seach_diana" style="transition:all .3s linear;text-align: center; width: 40px; height: 40px; background: rgb(197, 111, 111); border: none; color: rgb(255, 255, 255); border-radius: 5px; font-family: &quot;Times New Roman&quot;, Georgia, serif; font-size: xx-small; display: block;" onclick="getrec()">
  </div>
<?php include '../../footer.php';?>

