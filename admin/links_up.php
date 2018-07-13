<?php
include 'header.php';
$links_up = new Model("tools_links");
$id=getParam('id');
if($id){
  $links_up_id = $links_up->find(array('id'=>$id),"","*");
}
if(getParam('domain') == 'update'){
  $config = array(
    "name" => getParam('name'),
    "description" => getParam('description'),
    "url" => getParam('url'),
    "state" => getParam('state'),
    "priority" => getParam('priority'),
    "type" => getParam('type'),
  );
  $links_ups = $links_up->update(array('id'=>$id),$config);
  if($links_ups){echo "<script type='text/javascript'>alert('修改成功');window.location.href='links_list.php';</script>"; 
}else{
  echo "<script>alert('失败');</script>";
}
}
?>
<?php ?>
<div id="content">
  <div id="content-header">
    <h1><?php echo $links_up_id['title'];?></h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current"><?php echo $links_up_id['title'];?></a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5><?php echo $links_up_id['title'];?></h5>
        </div>
        <div class="widget-content nopadding">
          <form action="links_up.php?domain=update" method="post" class="form-horizontal" name="setting">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">id：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="text" placeholder="id" class="form-control" name="id" id="id" value="<?php echo $links_up_id['id'];?>" readonly="readonly">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">标题：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-file-word-o"></i></span>
                      <input type="text" placeholder="标题" class="form-control" name="name" id="name" value="<?php echo $links_up_id['name'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">描述：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                      <input type="text" placeholder="描述" class="form-control" name="description" id="description" value="<?php echo $links_up_id['description'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">地址：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                      <input type="text" placeholder="地址" class="form-control" name="url" id="url" value="<?php echo $links_up_id['url'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">排行：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                      <input type="text" placeholder="排行(0-99)" class="form-control" name="priority" id="priority" value="<?php echo $links_up_id['priority'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">类别：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="type" value='1' id="type_off" <?php if($links_up_id['type']=='1'){echo 'checked="checked"';}?>>导航
                      <input type="radio"  name="type" value='0' id="type_on" <?php if($links_up_id['type']=='0'){echo 'checked="checked"';}?>>友链
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
                      <input type="radio"  name="state" value='1' id="state_off" <?php if($links_up_id['state']=='1'){echo 'checked="checked"';}?>>隐藏
                      <input type="radio"  name="state" value='0' id="state_on" <?php if($links_up_id['state']=='0'){echo 'checked="checked"';}?>>显示
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