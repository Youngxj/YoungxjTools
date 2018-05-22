<?php
include 'header.php';
$talk_reply = new Model("tools_talk");
$emails = new Model("tools_smtp");
$sett = new Model("tools_settings");
$setting = $sett->find(array(),"","*");
$emails_val = $emails->find(array("id"=>1),"","*");
if(getParam('id')){
  $id=getParam('id');
  $talk_reply_id = $talk_reply->find(array('id'=>$id),"","*");
}
$name = getParam('name');
if(getParam('domain') == 'reply'){
  $config = array(
    "name" => $emails_val['fromname'],
    "content" => '@'.$name.'：'.getParam('content'),
    "times" => date('Y-m-d H:i:s'),
    "state" => getParam('state'),
    "emails" => $emails_val['smtp_from'],
    "ip" => real_ip(),
  );
  $talk_replys = $talk_reply->create($config);
  if($talk_replys){
    include 'email.php';
    $mail->addAddress(getParam('user_emails'),'');
    $mail->Subject = $emails_val['sub'];
    $mail->Body = '<div id="mailContentContainer" style="font-size: 14px; padding: 0px; height: auto; min-height: auto; font-family: &quot;lucida Grande&quot;, Verdana; position: relative; zoom: 1; margin-right: 170px;">                <style type="text/css"> .qmbox{margin:0;padding:0;font-family:微软雅黑;background-color:#fff}
    .qmbox a{text-decoration:none;}
    .qmbox .box{position:relative;max-width:100%;padding:0;margin:0 auto;border:1px solid #ccc;font-size:13px;color:#333;}
    .qmbox .header{width:100%;padding-top:50px;background:url("http://www.youngxj.cn/content/plugins/kl_sendmail/bian.jpg") repeat-x;}
    .qmbox .logo{float:right;padding-right:50px;}
    .qmbox .clear{clear:both;}
    .qmbox .content{max-width:100%;padding:0 20px;}
    .qmbox .admin{padding:10px 10px 10px 0;word-break:keep-all;line-height:30px;}
    .qmbox .admin a{width: auto;height: auto;border: 2px #eee solid;color: #FFF;background: #87A7D6;padding: 4px 10px;cursor: pointer;border-radius: 5px;text-decoration:none !important;}
    .qmbox .content p{line-height:40px;word-break:break-all;}
    .qmbox .content ul{padding-left:40px;}
    .qmbox .xiugai{height:50px;line-height:30px;font-size:16px;}
    .qmbox .xiugai a{color:#0099ff;}
    .qmbox .fuzhi{word-break:break-all;color:#b0b0b0;}
    .qmbox .table{border:1px solid #ccc;border-left:0;border-top:0;border-collapse:collapse;}
    .qmbox .table td{border:1px solid #ccc;border-right:0;border-bottom:0;padding:6px;min-width:160px;}
    .qmbox .gray{background:#f5f5f5;}
    .qmbox .no_indent{font-weight:bold;line-height:40px;color:#737171}
    .qmbox .no_indent a{text-decoration:none !important;color:#737171}
    .qmbox .no_indent span{padding-right:20px;}
    .qmbox .no_after{height:40px;line-height:40px; text-align:right;font-weight:bold}
    .qmbox .btnn{padding:50px 0 0 0;font-weight:bold}
    .qmbox .btnn a{padding-right:20px;text-decoration:none !important;color:#000;}
    .qmbox .need{background:#fa9d00;}
    .qmbox .noneed{background:#3784e0;}
    .qmbox .footer{width:100%;height:10px;padding-top:20px;background:url("http://www.youngxj.cn/content/plugins/kl_sendmail/bian.jpg") repeat-x left bottom;}
    </style><div class="qmbox"><div class="box"><div class="header"></div><div class="content"><p class="no_indent" style="color:#383838">评论《'.getParam("user_content").'》有了最新的回复</p><br><p style="line-height:25px;padding:10px;background:#5C96BE;border-radius:4px;color:#fff;">'.getParam("content").'</p><p class="no_indent"><span>评论作者：'.$emails_val['fromname'].'</span><span>邮件地址：'.$emails_val['username'].'</span><span>评论者ip：(保障用户隐私)</span></p><table cellspacing="0" class="table">	</table><div class="btnn"><a href="'.$setting['url'].'/about.php" target="_blank">查看回复</a><a href="'.$setting['url'].'" target="_blank">查看YoungxjTools</a><a href="http://www.youngxj.cn" target="_blank">杨小杰博客</a></div></div><div class="footer clear"></div></div></div>  <!--<![endif]--><style></style>  </div>';
    $status = $mail->send();
    if(!$status){echo '<script type="text/javascript">alert("发信失败");</script>';}
    echo '<script type="text/javascript">alert("回复成功");window.location.href="talk_list.php";</script>'; 
  }else{
    echo "<script>alert('失败');</script>";
  }
}
?>
<?php ?>
<div id="content">
  <div id="content-header">
    <h1>回复留言</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">回复留言</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5><?php echo '回复<code>'.$talk_reply_id['name'].'</code>的留言';?></h5>
        </div>
        <div class="widget-content nopadding">
          <form action="talk_reply.php?domain=reply" method="post" class="form-horizontal" name="setting">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label"><?php echo $talk_reply_id['name'].'的留言';?>：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <blockquote><span class="control-label"><?php echo $talk_reply_id['content'];?></span></blockquote>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">回复内容：</label>
              <textarea rows="5" placeholder="content" name="content" id="talk_content" style="width:70%"></textarea>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">状态：</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="radio"  name="state" value='1' id="state_off" >显示
                      <input type="radio"  name="state" value='0' id="state_on" checked="checked">隐藏
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="name" value="<?php echo $talk_reply_id['name'];?>" />
            <input type="hidden" name="user_emails" value="<?php echo $talk_reply_id['emails'];?>" />
            <input type="hidden" name="user_content" value="<?php echo $talk_reply_id['content'];?>" />
            <div class="form-actions">
              <input type="submit" value="回复" class="btn btn-primary" id="open-dialog">
            </div>
          </form>
        </div>
      </div>						
    </div>
  </div>

  <?php include 'footer.php';?>