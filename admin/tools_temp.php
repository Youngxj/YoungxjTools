<?php
include 'header.php';
$sett = new Model("tools_settings");
$setting = $sett->find(array(),"","templates");
if(getParam('domain')=='setting'){
  $config = array(
    "templates" => getParam('temp'),
  );
  $state = $sett->update(array(),$config);
  if($state){
    echo '<script type="text/javascript">alert("修改成功");window.location.href="tools_temp.php";</script>'; 
  }else{
    echo "<script>alert('失败');</script>";
  }
}
?>
<div id="content">
  <div id="content-header">
    <h1>主题风格设置</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">主题风格设置</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>                 
          </span>
          <h5>主题风格设置</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="tools_temp.php?domain=setting" method="post" class="form-horizontal" name="setting">
            <div class="form-group" style="padding: 30px;">
              <div style="text-align: center;" id="temple">
                <p id="other"><label for="t0"><img src="img/other.jpg" width="50%"></label><br/><input type="radio" name="temp" id="t0" onclick="sub(0)" value="0" <?php if($setting['templates']!='1'&&$setting['templates']!='2'&&$setting['templates']!='3'){echo 'checked="checked"';}?>><label for="t0">默认(前台可控)</label></p>
                <p id="one"><label for="t1"><img src="img/temp1.png" width="70%"></label><input type="radio" name="temp" id="t1" onclick="sub(1)" value="1" <?php if($setting['templates']=='1'){echo 'checked="checked"';}?>><label for="t1">主题一</label></p>
                <p id="two"><label for="t2"><img src="img/temp3.png" width="70%"></label><input type="radio" name="temp" id="t2" onclick="sub(2)" value="2" <?php if($setting['templates']=='2'){echo 'checked="checked"';}?>><label for="t2">主题二</label></p>
                <p id="three"><label for="t3"><img src="img/temp2.png" width="70%"></label><input type="radio" name="temp" id="t3" onclick="sub(3)" value="3" <?php if($setting['templates']=='3'){echo 'checked="checked"';}?>><label for="t3">主题三</label></p>
              </div>
              <div class="text-center">
                <input type="submit" value="确认" class="btn btn-primary" id="open-dialog">
              </div>
            </form>
          </div>
        </div>            
      </div>
    </div>
    <script type="text/javascript">
      if($('input:radio:checked').val()=='0'){
        sub(0);
      }else if($('input:radio:checked').val()=='1'){
        sub(1);
      }else if($('input:radio:checked').val()=='2'){
        sub(2);
      }else if($('input:radio:checked').val()=='3'){
        sub(3);
      }
      function sub(num){console.log(num);if(num==1){$('#one').css({border:'1px red dashed '});$('#two').css({border:'none'});$('#three').css({border:'none'});$('#other').css({border:'none'})}else if(num==2){$('#two').css({border:'1px red dashed '});$('#one').css({border:'none'});$('#three').css({border:'none'});$('#other').css({border:'none'})}else if(num==3){$('#three').css({border:'1px red dashed '});$('#one').css({border:'none'});$('#two').css({border:'none'});$('#other').css({border:'none'})}else{$('#other').css({border:'1px red dashed '});$('#one').css({border:'none'});$('#two').css({border:'none'});$('#three').css({border:'none'})}}
    </script>
    <?php include 'footer.php';?>