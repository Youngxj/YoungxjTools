<?php
$id="39";
include '../../header.php';?>
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
      <form action="refresh.php" method="get" class="form-group">
        <div class="form-group" id="input-wrap">
          <label class="control-label control-msg" for="inputContent" copy="Youngxj|杨小杰，admin@youngxj.com"></label>
          <div class="input-group">

            <input type="text" class="form-control" aria-label="..." value="http://" id="url" name="url" placeholder="http(s)://">
            <div class="input-group-btn">
              <button class="btn btn-default " type="submit" id="btn_state">启动</button>
            </div><!-- /btn-group -->

          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="row">
          <div class="col-md-3"><input type="number" class="form-control" id="refresh" placeholder="刷新时间" name="refresh" value="10"></div>
        </div>
      </form>

      <div class="form-controlss text-center">
        <div id="content"></div>
        <div id="msg"></div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">工具简介</h3>
        </div>
        <style>.panel-body h4{color:red;}.panel-body p{font-size: x-small;}</style>
        <div class="panel-body">
          <h4>PV介绍(摘取百度百科)</h4>
          <p>PV（page view）即页面浏览量，通常是衡量一个网络新闻频道或网站甚至一条网络新闻的主要指标。网页浏览数是评价网站流量最常用的指标之一，简称为PV。监测网站PV的变化趋势和分析其变化原因是很多站长定期要做的工作。 Page Views中的Page一般是指普通的html网页，也包含php、jsp等动态产生的html内容。来自浏览器的一次html内容请求会被看作一个PV，逐渐累计成为PV总数。</p>
          <p>该工具娱乐为主,没有数据表明对SEO有优化作用</p>
          <h4>实现原理</h4>
          <p>利用iframe框架加上自动刷新页面实现自动刷新页面访问量</p>
          <h4>声明</h4>
          <p>合理利用工具切勿滥用，否则封域名封IP</p>
        </div>
      </div>
    </div>


  </div>
</div>
<script type="text/javascript" >
	
</script>
<?php include '../../footer.php';?>