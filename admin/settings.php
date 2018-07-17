<?php
include 'header.php';
$sett = new Model("tools_settings");
$setting = $sett->find(array(),"","*");
$setsmtp = new Model("tools_smtp");
$smtp = $setsmtp->find(array(),"","*");
if(getParam('domain')=='setting'){
  $config = array(
    "url" => getParam('url'),
    "title" => getParam('title'),
    "keyword" => getParam('keyword'),
    "description" => getParam('description'),
    "icp" => getParam('icp'),
    "notice" => getParam('notice'),
    "rand" => getParam('rand'),
    "ip_admin" => getParam('ip_admin'),
    "ua" => getParam('ua'),
    "referer" => getParam('referer'),
    "qq" => getParam('qq'),
    "emails" => getParam('emails'),
    "search" => getParam('search'),
    "tools_priority" => getParam('tools_priority'),
    "tz" => getParam('tz'),
    "tz_msg" => getParam('tz_msg'),
  );
  $state = $sett->update(array(),$config);
  if($state){
    echo '<script type="text/javascript">alert("修改成功");window.location.href="settings.php";</script>'; 
  }else{
    echo "<script>alert('失败');</script>";
  }
}
if(getParam('domain')=='smtp'){
  $config = array(
    "host" => getParam('host'),
    "port" => getParam('port'),
    "fromname" => getParam('fromname'),
    "username" => getParam('username'),
    "password" => getParam('password'),
    "add_email" => getParam('add_email'),
    "sub" => getParam('sub'),
  );
  $state = $setsmtp->update(array("1"),$config);
  if($state){
    echo '<script type="text/javascript">alert("修改成功");window.location.href="settings.php";</script>'; 
  }else{
    echo "<script>alert('失败');</script>";
  }
}
if(getParam('domain')=='logo'&&$_FILES["file"]){
  // 允许上传的图片后缀
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp);
  if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && in_array($extension, $allowedExts)){
    $file = $_FILES["file"]["tmp_name"];
    $uploaddir = "../images/";$uploaddir.="logo.png";
    if(move_uploaded_file($file, $uploaddir)) {
      echo '<script type="text/javascript">alert("修改成功");window.location.href="settings.php";</script>'; 
    }else{
      echo "<script>alert('失败');</script>";
    }
  }
}
?>
<div id="content">
  <div id="content-header">
    <h1>网站基本信息配置</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">基本信息配置</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-envelope-open-o"></i>                 
          </span>
          <h5>logo设置</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="settings.php?domain=logo" method="post"enctype="multipart/form-data" class="form-horizontal" name="logo">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">当前logo</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <img src="../images/logo.png" width="100%">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">logo上传(建议使用长方形图片)</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="file" name="file" id="file" accept="image/*"/>
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
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5>基本信息配置</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="settings.php?domain=setting" method="post" class="form-horizontal" name="setting">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">网站地址[需要填写http(s)://]：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="text" placeholder="网站地址" class="form-control" name="url" id="url" value="<?php echo $setting['url'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">网站标题：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                      <input type="text" placeholder="网站标题" class="form-control" name="title" id="title" value="<?php echo $setting['title'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">网站关键词：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
                      <input type="text" placeholder="网站关键词" class="form-control" name="keyword" id="keyword" value="<?php echo $setting['keyword'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">网站描述：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="网站描述" class="form-control" name="description" id="description" value="<?php echo $setting['description'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">QQ：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="QQ" class="form-control" name="qq" id="qq" value="<?php echo $setting['qq'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">邮箱：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="邮箱" class="form-control" name="emails" id="emails" value="<?php echo $setting['emails'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">备案号：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="备案号" class="form-control" name="icp" id="icp" value="<?php echo $setting['icp'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">公告：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="公告" class="form-control" name="notice" id="notice" value="<?php echo $setting['notice'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">加密随机中文字符：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="加密随机中文字符" class="form-control" name="rand" id="rand" value="<?php echo $setting['rand'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">ip黑名单：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="ip黑名单" class="form-control" name="ip_admin" id="ip_admin" value="<?php echo $setting['ip_admin'];?>">
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
                    <select class="form-control" name="tools_priority" id="tools_priority">
                      <option value="id desc" <?php if($setting['tools_priority']=='id desc'){echo 'selected="selected"';}?>>默认排序</option>
                      <option value="priority desc" <?php if($setting['tools_priority']=='priority desc'){echo 'selected="selected"';}?>>权重排序</option>
                      <option value="tools_love desc" <?php if($setting['tools_priority']=='tools_love desc'){echo 'selected="selected"';}?>>喜欢排序</option>
                      <option value="tools_number desc" <?php if($setting['tools_priority']=='tools_number desc'){echo 'selected="selected"';}?>>使用次数</option>
                      <option value="1" <?php if($setting['tools_priority']=='1'){echo 'selected="selected"';}?>>前台控制排序</option>
                      <option value="rand_priority" <?php if($setting['tools_priority']=='rand_priority'){echo 'selected="selected"';}?>>随机排序</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">ua开关：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="ua" value='1' id="ua_on" <?php if($setting['ua']=='1'){echo 'checked="checked"';}?>>开
                      <input type="radio"  name="ua" value='0' id="ua_off" <?php if($setting['ua']=='0'){echo 'checked="checked"';}?>>关
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">来路开关：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="referer" value='1' id="referer_on" <?php if($setting['referer']=='1'){echo 'checked="checked"';}?>>开
                      <input type="radio"  name="referer" value='0' id="referer_off" <?php if($setting['referer']=='0'){echo 'checked="checked"';}?>>关
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">搜索框样式</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="search" value='1' id="search_mh" <?php if($setting['search']=='1'){echo 'checked="checked"';}?>>模糊搜索
                      <input type="radio"  name="search" value='2' id="search_jy" <?php if($setting['search']=='2'){echo 'checked="checked"';}?>>简约搜索
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">防QQ拦截</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="tz" value='1' id="tz" <?php if($setting['tz']=='1'){echo 'checked="checked"';}?>>开
                      <input type="radio"  name="tz" value='2' id="tz" <?php if($setting['tz']=='2'){echo 'checked="checked"';}?>>关
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" <?php if($setting['tz']=='2'){echo 'style="display:none;"';}?>>
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">防QQ拦截消息</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                      <input type="text" placeholder="防QQ拦截消息" class="form-control" name="tz_msg" id="tz_msg" value="<?php echo $setting['tz_msg'];?>">
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
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-envelope-open-o"></i>									
          </span>
          <h5>评论交互smtp设置</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="settings.php?domain=smtp" method="post" class="form-horizontal" name="smtp">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">邮件地址</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                      <input type="text" placeholder="smtp.qq.com" class="form-control" name="host" id="host" value="<?php echo $smtp['host'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">端口</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                      <input type="text" placeholder="25 / 465" class="form-control" name="port" id="port" value="<?php echo $smtp['port'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">发件人昵称</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                      <input type="text" placeholder="发件人昵称" class="form-control" name="fromname" id="fromname" value="<?php echo $smtp['fromname'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">smtp账号</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                      <input type="text" placeholder="smtp账号" class="form-control" name="username" id="username" value="<?php echo $smtp['username'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">smtp密码</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-database"></i></span>
                      <input type="password" placeholder="smtp密码" class="form-control" name="password" id="password" value="<?php echo $smtp['password'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">收件人(请勿与发件人相同)</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-hdd-o"></i></span>
                      <input type="text" placeholder="收件人" class="form-control" name="add_email" id="add_email" value="<?php echo $smtp['add_email'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">邮件主题</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-map-o"></i></span>
                      <input type="text" placeholder="邮件主题" class="form-control" name="sub" id="sub" value="<?php echo $smtp['sub'];?>">
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
