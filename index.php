<?php
include 'header.php';
// 拼音类库
include 'function/function.py.php';

$sp->table_name = "tools_list";

if(getParam('sort')){
    //分类
  echo '<style>#choose-tool{display:none;}</style>';
    $tools_list=$sp->findall(array("tools_type= '".addslashes(getParam('sort'))."'and state=0"),constant("Desc"),"*");//查询分类
  }elseif(getParam('query')){
    //查询工具
    echo '<style>.search-fr{display:none;}</style>';
    //查询标题
    $tools_list=$sp->findall(array("title like '%".addslashes(getParam('query'))."%'"),constant("Desc"),"*");
  }else{
    //默认输出所有工具
    $tools_list=$sp->findall(array('state'=>'0'),constant("Desc"),"*");
  }

  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Tools_url;?>/css/templates.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Tools_url;?>/css/bootstrap-select.min.css">
  <script src="<?php echo Tools_url;?>/js/bootstrap-select.min.js"></script>
  <style type="text/css">
  .breadcrumb{padding:8px 15px 13px 15px;}
  .breadcrumb>li{margin-top:6px;}
  .tools_list{min-height: 500px;}
</style>

<div class="container centent" style="padding-bottom:20px;">
  <ol class="breadcrumb" id="choose-tool">
    <li class="active" data-class=".tool-item"><span>所有工具</span></li>
    <?php foreach($tools_navsort as $age){?><!--分类导航目录优先-->
    <li data-class=".<?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?>"><span><?php echo $age['tools_type'];?></span></li>
  <?php }?>
  <?php if (search=='1') {?>
    <div class="search-fr">
      <style type="text/css">
      .search-fr{float:right;}
      @media screen and (max-width: 720px){.search-fr {float:none;text-align:center;}}
      .dropdown-menu{width:100% !important;}
    </style>
    <form class="form-horizontal" role="form">
      <div class="form-group">
        <div class="col-lg-1">
          <select id="basic" class="selectpicker" data-live-search="true">
            <option data-subtext="搜索">搜索</option>
            <?php foreach ($tools_list as $age) {?>
              <option data-subtext="<?php echo $age['title'].' '.$age['tools_url'];?>"><?php echo pinyin($age['title'], 'first');?></option>
            <?php }?>
          </select>
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
        //模糊搜索特别优化
        $('.selectpicker').on('changed.bs.select',function(e){
          $('.dropdown-toggle').data("class",'.'+$('#basic').val());
          $('.active').removeClass("active");
          if ($('.dropdown-toggle').attr('class') == 'active') return false;
          $('.dropdown-toggle').addClass("active");
          if($('.dropdown-toggle').data("class")=='.搜索'){
            $(".tool-item").show();
          }else{
            if ($('.dropdown-toggle').data("class") !== ".tool-item") $(".tool-item").hide();
          }
          $($('.dropdown-toggle').data("class")).fadeIn(0);
        });
      </script>
    <?php }?>
  </ol>
  
  <div class="row row-xs tools_list">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="row">
        <?php if(!$tools_list){
          echo '<div class="row row-centered">
          <div class="form-group" id="input-wrap">
          <h1 class="text-center" style="font-size: 80px;">没有工具</h1>
          <h3 class="text-center"><script>text()</script></h3>
          </div>
          </div>';}?>
          <?php if(constant('templates')=='1'){?>
            <link rel="stylesheet" type="text/css" href="<?php echo Tools_url;?>/css/temp_one.css">
            <?php foreach ($tools_list as $age) {if($age['type']=='0'){$toolsurl = Tools_url.'/'.$CONF['config']['TOOLS_T'].'/'.$age['tools_url'];}else{$toolsurl = $age['tools_url'];}?>
            <div class="col-xs-12 col-sm-3 boxs tool-item <?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?> <?php echo pinyin($age['title'], 'first');?>">
              <div class="item-inner">
                <div class="item-hd">
                  <a target="_blank" href="<?php echo $toolsurl;?>" class="item-icon">
                    <img src="<?php echo $age['tools_img'];?>" width="48" height="48" alt="coderunner">
                  </a>
                  <h3><a target="_blank" href="<?php echo $toolsurl;?>"><?php echo $age['title'];?></a></h3>
                  <span class="item-category">
                    [<a target="_blank" rel="nofollow" href="<?php echo Tools_url;?>/?sort=<?php echo $age['tools_type'];?>"><?php echo $age['tools_type'];?></a>]
                  </span>
                  <a title="喜欢" class="likeable" href="javascript:ajax_love(<?php echo $age['id'];?>)" data-slug="coderunner" data-url="<?php echo Tools_url;?>" id="tools_love_<?php echo $age['id'];?>" <?php if ($_COOKIE["love_id_".$age['id']]) {echo 'style="color:red;"';}?>>
                    <i class="fa fa-heart"></i>
                    <var><?php echo $age['tools_love'];?></var>
                  </a>
                  <a title="访问次数" class="see" data-slug="coderunner" data-url="<?php echo Tools_url;?>" id="tools_<?php echo $age['id'];?>">
                    <i class="fa fa-eye"></i>
                    <var><?php echo $age['tools_number'];?></var>
                  </a>
                </div>
                <div class="item-bd">
                  <div class="item-desc" title="<?php echo $age['keyword'];?>"><?php echo $age['keyword'];?></div>
                </div>
                <div class="item-ft">
                  <a target="_blank" class="item-link" href="<?php echo $toolsurl;?>"><?php echo $age['tools_url'];?></a>
                  <a target="_blank" class="item-btn" href="<?php echo $toolsurl;?>">进入</a>
                </div>
              </div>
            </div>
          <?php }?>
        </div>
      </div>
    <?php }elseif(constant('templates')=='2'){?>
      <link rel="stylesheet" href="css/mdui.min.css"/>
      <script src="js/mdui.min.js"></script>
      <style type="text/css">.mdui-col-sm-6.mdui-col-md-3 {padding-bottom: 20px;}.mdui-card:hover {    box-shadow: 0 5px 15px 0 rgb(108, 148, 186);}.mdui-card img{width: 80%;margin: 0 auto;}</style>
      <?php foreach ($tools_list as $age) {if($age['type']=='0'){$toolsurl = Tools_url.'/'.$CONF['config']['TOOLS_T'].'/'.$age['tools_url'];}else{$toolsurl = $age['tools_url'];}?>
      <div class="mdui-col-sm-6 mdui-col-md-3 tool-item <?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?> <?php echo pinyin($age['title'], 'first');?>">
        <div class="mdui-card">
          <a href="<?php echo $toolsurl;?>" target="_blank">
            <div class="mdui-card-media">
              <img src="<?php echo $age['tools_img'];?>"/>
              <div class="mdui-card-media-covered">
                <div class="mdui-card-primary">
                  <div class="mdui-card-primary-title"><?php echo $age['title'];?></div>
                  <div class="mdui-card-primary-subtitle"><?php echo $age['subtitle'];?></div>
                </div>
              </div>
            </div>
          </a>
          <div class="mdui-card-actions">
            <button class="mdui-btn mdui-ripple"><span class="maple-tool-tag"  title="点赞" onclick="ajax_love(<?php echo $age['id'];?>)" id="tools_love_<?php echo $age['id'];?>" <?php if ($_COOKIE["love_id_".$age['id']]) {echo 'style="color:red;"';}?>><i class="fa fa-heart"></i> <?php echo $age['tools_love'];?></span></button>
            <button class="mdui-btn mdui-ripple"><span class="maple-tool-tag"  title="使用次数"><i class="fa fa-eye"></i> <?php echo $age['tools_number'];?></span></button>
            <button class="mdui-btn mdui-btn-icon mdui-float-right"><a href="<?php echo $toolsurl;?>" target="_blank"><span class="maple-tool-tag" title="打开"><i class="fa fa-angle-right fa-fw"></i></button></a></span>
          </div>
        </div>
      </div>
    <?php }?>
  </div>
</div>
<?php }else{?>
  <?php foreach ($tools_list as $age) {if($age['type']=='0'){$toolsurl = Tools_url.'/'.$CONF['config']['TOOLS_T'].'/'.$age['tools_url'];}else{$toolsurl = $age['tools_url'];}?>
  <div class="col-sm-6 col-md-4 col-lg-3 tool-item <?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?> <?php echo pinyin($age['title'], 'first');?>">

    <div class="maple-tool-item image-shadow">
      <span class="maple-tool-icon maple-tool-item-color<?php echo rand(1,6);?>"><?php echo mb_substr($age['title'],0,1,'utf-8');?></span>
      <a href="<?php echo $toolsurl;?>" target="_blank"><h3 class="maple-tool-name"><?php echo $age['title'];?></h3></a>
      <span class="maple-tool-describe"><?php echo $age['keyword'];?></span>
      <div class="maple-tool-tags">
        <a target="_blank" rel="nofollow" href="<?php echo Tools_url;?>/?sort=<?php echo $age['tools_type'];?>"><span class="maple-tool-tag"  title="工具类型"><?php echo $age['tools_type'];?></span></a>
        <span class="maple-tool-tag"  title="使用次数"><i class="fa fa-eye"></i> <?php echo $age['tools_number'];?></span>
        <span class="maple-tool-tag"  title="点赞" onclick="ajax_love(<?php echo $age['id'];?>)" id="tools_love_<?php echo $age['id'];?>" <?php if ($_COOKIE["love_id_".$age['id']]) {echo 'style="color:red;"';}?>><i class="fa fa-heart"></i> <?php echo $age['tools_love'];?></span>
      </div>
      <span class="maple-tool-auth" title="工具作者"><i class="fa fa-user-circle-o"></i> <?php echo $age['tools_author'];?></span>
      <a href="<?php echo $toolsurl;?>" target="_blank"><span class="maple-tool-in" title="点击打开工具"><i class="fa fa-sign-in"></i> Open</span></a>
    </div>
  </div>
<?php }?>
</div>
</div>

<?php }?>
</div>

<script type="text/javascript">
    // 无刷新导航js
    $(function() {
      $('#choose-tool li').click(function() {
        if ($(this).attr('class') == 'active') return false;
        $('.active').removeClass("active");
        $(this).addClass("active");
        if ($(this).data("class") !== ".tool-item") $(".tool-item").hide();
        $($(this).data("class")).fadeIn(0);
      });
    });
  </script>
  <?php
  $sp->table_name = "tools_links";
  $tools_links = $sp->findall(array('state'=>'0','type'=>'0'),"priority desc","*");
  if($tools_links){
    ?>
    <div class="container links_">
      <div class="links_bt">
        <div class="links_bt_l">
          <a href="javascript:;">友情链接</a>
        </div>
        <div class="links_bt_r">
          <a href="<?php echo Tools_url;?>/about.php" rel="nofollow" target="_blank">申请</a>
        </div>
      </div>
      <div class="links_lb">
        <ul>
          <?php foreach($tools_links as $age){?>
            <li><a href="<?php echo $age['url'];?>" title="<?php echo $age['description'];?>" target="_blank"><?php echo $age['name'];?></a></li>
          <?php }?>
        </ul>
      </div>
    </div>
  <?php }?>
  <?php include 'footer.php';?>