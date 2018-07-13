<?php
include 'header.php';
$tools_user = new Model("tools_user");
$user_token = $tools_user->find(array(),"","*");
if(getParam('domain')=='update'){
  if (!getParam('user')||!getParam('password')) {
    exit("<script language='javascript'>layui.use('layer', function(){alert('账号密码均不能为空');});window.location.href='admin.php';</script>");
  }
	$user = getParam('user');
  $password = md5(md5(getParam('password')).md5($user_token['user_token']));
  $user_up = $tools_user->update(array('id'=>'1'),array('user'=>$user,'password'=>$password));
  if($user_up){
    exit("<script language='javascript'>layui.use('layer', function(){alert('修改成功');});window.location.href='admin.php';</script>");
  }else{
    exit("<script language='javascript'>layui.use('layer', function(){alert('修改失败[可能内容未更改]');});window.location.href='admin.php';</script>");
  }
}

?>
<div id="content">
  <div id="content-header">
    <h1>用户信息配置</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">用户信息配置</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5>用户信息配置</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="admin.php?domain=update" method="post" class="form-horizontal" name="setting">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">用户名：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="text" placeholder="用户名" class="form-control" name="user" id="user" value="<?php echo $user_token['user'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">密码：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="password" placeholder="密码" class="form-control" name="password" id="password" >
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