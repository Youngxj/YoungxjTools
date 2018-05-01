<?php
$title = '时间轴';
include 'header.php';
$sp->table_name = "tools_log";
$time_logs=$sp->findall(array('state'=>'0'),"id desc","*");

// 分页模块
include 'page.class.php';

//每页输出数量
$pagenum = '6';
//总数除以分页数
$numss = ceil(count($time_logs) / $pagenum);
//当前分页数
$page = isset($_GET['page'])?$_GET['page']:'1';

$fy = $page-1;
$fys = $fy*$pagenum;
$time_log_page=$sp->findall(array('state'=>'0'),"id desc","*","{$fys},{$pagenum}");
?>
<style type="text/css">
  /*用户头像的调整*/
  .avatar{float: left;margin: 6px 10px 0 0;}
  /*内容主体的调整*/
  .comment-info{width: 100%;border-bottom: #eee 1px solid;margin-bottom: 5px;padding: 5px 0 0;}
</style>

<div class="container" style="margin-top:40px">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">时间轴</h3>
    </div>
    <div class="panel-body">
      <?php for($a=0;$a<count($time_log_page);$a++){?>
      <div class="avatar"><img title="Youngxj" alt="Youngxj" src="//cn.gravatar.com/avatar/89703f47410fcebada2beaa143cca3d7?s=64&amp;d=monsterid&amp;r=X" class="avatar avatar-32 photo" height="30" width="30"></div>
      <div class="comment-info">
        <b><?php echo $time_log_page[$a]['user'];?></b>
        <span class="comment-time"><?php echo smartDate(strtotime($time_log_page[$a]['time']),'Y-m-d');?></span>
        <div class="comment-content"><?php echo $time_log_page[$a]['content'];?></div>
      </div>
      <?php }?>
      <?php if(empty($time_log_page)){echo '目前没有发布内容';}else{?>
      <div class="page">
        <?php echo multipage($numss,$page);?>
      </div>
      <?php }?>
    </div>
  </div>
</div>
<?php include 'footer.php';?>