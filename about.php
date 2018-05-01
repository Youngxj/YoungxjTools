<?php
$title = '关于YoungxjTools';
$keywords = 'Youngxj,YoungxjTools';
include './header.php';
// smtp发信模块
include 'page.class.php';
// 下面是输出留言板内容
// 及分页代码
$sp->table_name = "tools_talk";
$num=$sp->findall(array('state'=>'1'),"id desc","*");//总数
//每页输出数量
$pagenum = '5';
//总数除以分页数
$numss = ceil(count($num) / $pagenum);
//当前分页数
$page = isset($_GET['page'])?$_GET['page']:'1';
// 为什么要减一？
// 问的好，因为当页数为1的时候
// $fys的值就是1*5=5，所以sql里就会从5,5起步
// 所以我们需要-1,当页数为1时0*1=0,所以就会从0,5起步
$fy = $page-1;
$fys = $fy*$pagenum;
$talks=$sp->findall(array('state'=>'1'),"id desc","*","{$fys},{$pagenum}");
?>
<style type="text/css">
  /*用户头像的调整*/
  .avatar{float: left;margin: 6px 10px 0 0;}
  /*评论主体的调整*/
  .comment-info{width: 100%;border-bottom: #eee 1px solid;margin-bottom: 5px;padding: 5px 0 0;}
</style>
<div class="container" style="margin-top:70px">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">本站简介</h3>
    </div>
    <div class="panel-body">
      <p>YoungxjTools工具箱由原来的tools.youngxj.cn整理而来</p>
      <p>原工具箱工具基本整理到此工具</p>
      <p>本站致力于免费为广大网民提供各类免费在线工具。用户的支持是本站的唯一动力！</p>
      <p>同时收录优质小工具</p>
      <p>本站【YoungxjTools】已稳定运行了 <kbd><script language="JavaScript" type="text/javascript">var urodz = new Date("2018/04/01");var now = new Date();var ile = now.getTime() - urodz.getTime();var dni = Math.floor(ile / (1000 * 60 * 60 * 24));document.write( + dni)</script></kbd> 天。
      </p>
      <p>使用到以下框架：
        <li>bootstrap框架</li>
        <li>font-awesome4.7</li>
        <li>layer弹出层</li>
        <li>jquery2.1.4</li>
        <li>阿里云矢量图库</li>
      </p>
    </div>
  </div>
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h3 class="panel-title">本站声明</h3>
    </div>
    <div class="panel-body">
      <p>①本站部分工具都来源于网络和网友提供，如有版权问题，请联系本站！</p>
      <p>②本站工具仅为了大家方便使用，请勿用于违法、商务、交易 等方面！否则本站概不负责！</p>
    </div>
  </div>
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title">联系方式</h3>
    </div>
    <div class="panel-body">
      <p><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo constant('QQ');?>&amp;site=qq&amp;menu=yes"><button class="btn btn-warning">ＱＱ：<?php echo constant('QQ');?></button></a></p>
      <p><a href="mailto:<?php echo constant('Emails');?>"><button class="btn btn-info">邮箱：<?php echo constant('Emails');?></button></a></p>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">留言板<small class="text-capitalize">(所有留言将会以邮件方式回复)</small></h3>
    </div>
    <div class="panel-body">
      <?php for($a=0;$a<count($talks);$a++){?>
      <div class="comment" id="comment-<?php echo $talks[$a]['id'];?>">
        <a name="<?php echo $talks[$a]['id'];?>"></a>
        <div class="avatar"><img title="<?php echo $talks[$a]['name'];?>" alt="<?php echo $talks[$a]['name'];?>" src="//cn.gravatar.com/avatar/<?php echo md5($talks[$a]["emails"]);?>?s=64&amp;d=monsterid&amp;r=X" class="avatar avatar-32 photo" height="30" width="30"></div>
        <div class="comment-info">
          <b><?php echo $talks[$a]['name'];?></b>
          <span class="comment-time"><?php echo smartDate(strtotime($talks[$a]['times']));?></span>
          <div class="comment-content"><?php echo $talks[$a]['content'];?></div>
        </div>
      </div>
      <?php }?>
      <?php if(empty($talks)){echo '快来占个沙发吧';}else{?>
      <div class="page">
        <?php echo multipage($numss,$page);?>
      </div>
      <?php }?>
    </div>
  </div>
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $_COOKIE['user_name'].'你好，请';?>发布留言<small class="text-capitalize">(请勿刷留言，违者必封，手动审核之后显示在列表)</small></h3>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="exampleInputEmail1">QQ：</label>
        <input type="text" class="form-control" id="qqinfo" placeholder="QQ一键获取信息" name="name" maxlength="20" onblur="qqget()" onKeyUp="value=value.replace(/\D/g,'')" onafterpaste="value=value.replace(/\D/g,'')">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">昵称：</label><span style="color:red;">*</span>
        <input type="text" class="form-control" id="name" placeholder="昵称" name="name" required="required" value="<?php echo $_COOKIE['user_name'];?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">邮箱地址：</label><span style="color:red;">*</span>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="required" value="<?php echo $_COOKIE['user_email'];?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">留言内容：</label><span style="color:red;">*</span>
        <textarea class="form-control" rows="5" id="content" placeholder="文明交流……" name="content" required="required"></textarea>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" id="check" name="check" required="required" autocomplete="on" title="发表评论确认框：请勾选我再发表评论！"> <font color="red">请勾选我再发表评论！</font>
        </label>
      </div>
      <input type="submit" class="btn btn-default" value="提交" id="up">
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/about.php"></script>
<?php include './footer.php';?>