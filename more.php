<?php
include '../fucntion.base.php';
function more($name){?>
<style>
.more ul{list-style:none;margin:0;padding-right:40px;}
.more li{display:inline;white-space:nowrap;}
</style>
<div class="table text-center more">
 <ul>
  <?php if($name!='urlblast'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/urlblast/" id="more" >子域名爆破</a></li><?php }?>
  <?php if($name!='dns'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/dns/" id="more">Dns解析记录</a></li><?php }?>
  <?php if($name!='ping'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/ping/" id="more">超级Ping</a></li><?php }?>
  <?php if($name!='StatusCode'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/StatusCode/" id="more">网站状态码</a></li><?php }?>
  <?php if($name!='dwzurl'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/dwzurl/" id="more">短网址生成</a></li><?php }?>
  <?php if($name!='icp'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/icp/" id="more">ICP备案查询</a></li><?php }?>
  <?php if($name!='whois'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/whois/" id="more">Whios查询</a></li><?php }?>
  <?php if($name!='rank'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/rank/" id="more">权重查询</a></li><?php }?>
</ul>
</div>
<?php }?>

<?php
function more_ip($name){?>
<style>
.more ul{list-style:none;margin:0;padding-right:40px;}
.more li{display:inline;white-space:nowrap;}
</style>
<div class="table text-center more">
 <ul>
  <?php if($name!='ip'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/ip/" id="more" >IP地址查询</a></li><?php }?>
  <?php if($name!='portblast'){?><li><a href="//<?php echo $_SERVER['HTTP_HOST'];?>/portblast/" id="more">IP端口扫描</a></li><?php }?>
</ul>
</div>
<?php }?>