<?php
include 'header.php';
$time_log = new Model("tools_log");
  $id=getParam('id');
  if($id){
    $log_up_id = $time_log->find(array('id'=>$id),"","*");
  }
  if(getParam('domain') == 'update'){
    $config = array(
      "user" => getParam('user'),
      "content" => getParam('content'),
      "state" => getParam('state'),
    );
    $log_ups = $time_log->update(array('id'=>$id),$config);
    if($log_ups){echo "<script type='text/javascript'>layui.use('layer', function(){alert('修改成功');});window.location.href='log_list.php';</script>"; 
                  }else{
      echo "<script>layui.use('layer', function(){alert('修改失败');});</script>";
    }
  }
?>
<div id="content">
  <div id="content-header">
    <h1>修改时间轴内容</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">修改时间轴内容</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5>修改时间轴内容</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="log_up.php?domain=update" method="post" class="form-horizontal" name="setting">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">id：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="text" placeholder="id" class="form-control" name="id" id="id" value="<?php echo $log_up_id['id'];?>" readonly="readonly">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">用户名：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-file-word-o"></i></span>
                      <input type="text" placeholder="用户名" class="form-control" name="user" id="user" value="<?php echo $log_up_id['user'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">内容：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                      <input type="text" placeholder="内容" class="form-control" name="content" id="log_content" value="<?php echo $log_up_id['content'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">状态：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="state" value='1' id="state_off" <?php if($log_up_id['state']=='1'){echo 'checked="checked"';}?>>隐藏
                      <input type="radio"  name="state" value='0' id="state_on" <?php if($log_up_id['state']=='0'){echo 'checked="checked"';}?>>显示
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-actions">
              <input type="submit" value="修改" class="btn btn-primary" id="open-dialog">
            </div>
          </form>
        </div>
      </div>						
    </div>
  </div>

  <?php include 'footer.php';?>