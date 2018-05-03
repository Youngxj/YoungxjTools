<?php
include 'header.php';


$sp->table_name = "tools_list";
if(getParam('url')){

  $tools_url=$sp->find(array("tools_url= '".deepEscape(getParam('url'))."'"),constant("Desc"),"*");
  
  if($tools_url['type']=='0'){
    $url = constant("Tools_url").$tools_url['tools_url'];
  }elseif($tools_url['type']=='1'){
    $url = 'http://'.$tools_url['tools_url'];
    $numbers = $sp->incr(array('id'=>$tools_url['id']),'tools_number');
  }else{$url = '/';}
  exit("<script language='javascript'>layer.msg('跳转中……', {icon: 16,shade: 0.01});window.location.href='".$url."';</script>");
}else{
  if(getParam('sort')){
    echo '<style>#choose-tool{display:none;}</style>';
    $tools_list=$sp->findall(array("tools_type= '".deepEscape(getParam('sort'))."'and state=0"),constant("Desc"),"*");//查询分类
  }else{
    $tools_list=$sp->findall(array('state'=>'0'),constant("Desc"),"*");
  }
}


if(constant('templates')=='1'){
  ?>
  <link rel="stylesheet" type="text/css" href="css/temp_one.css">
  <div class="container centent" style="padding-bottom:20px;">
    <div class="row row-xs">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <?php if(!$tools_list){echo '目前没有工具！';}?>
          <?php foreach ($tools_list as $age) {
            $toolsurl = constant("Tools_url").'?url='.$age['tools_url'];
            ?>

            <div class="col-xs-12 col-sm-3 boxs">
              <div class="item-inner">
                <div class="item-hd">
                  <a target="_blank" href="<?php echo $toolsurl;?>" class="item-icon"><img src="<?php echo $age['tools_img'];?>" width="48" height="48" alt="coderunner"></a>
                  <h3><a target="_blank" href="<?php echo $toolsurl;?>"><?php echo $age['title'];?></a></h3>
                  <span class="item-category">[<a target="_blank" rel="nofollow" href="../?sort=<?php echo $age['tools_type'];?>"><?php echo $age['tools_type'];?></a>]</span>
                  <a title="喜欢" class="likeable" href="javascript:ajax_love(<?php echo $age['id'];?>)" data-slug="coderunner" data-url="//<?php echo constant("Tools_url");?>" id="tools_love_<?php echo $age['id'];?>" <?php if ($_COOKIE["love_id_".$age['id']]) {echo 'style="color:red;"';}?>><i class="fa fa-heart"></i><var><?php echo $age['tools_love'];?></var></a>
                  <a title="访问次数" class="see" data-slug="coderunner" data-url="<?php echo constant("Tools_url");?>" id="tools_<?php echo $age['id'];?>"><i class="fa fa-eye"></i><var><?php echo $age['tools_number'];?></var></a>
                </div>
                <div class="item-bd">
                  <div class="item-desc" title="<?php echo $age['explains'];?>"><?php echo $age['explains'];?></div>
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
      </div>
    </div>
    <?php }else{
/*拼音库用于首页分类卡片
 *作用不大，可用可不用
 *但是需要手动修改分类目录的class
 */
include 'function.py.php';
?>
<link rel="stylesheet" type="text/css" href="/css/templates.css">
<div class="container centent">
  <ol class="breadcrumb" id="choose-tool">
    <li class="active" data-class=".tool-item">
      <span>所有工具</span></li>
      <?php foreach($tools_navsort as $age){?><!--分类导航目录优先-->
      <li data-class=".<?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?>">
       <span><?php echo $age['tools_type'];?></span></li>
       <?php }?>
     </ol>
     <div class="row">
      <?php if(!$tools_list){echo '目前没有工具！';}?>
      <?php foreach ($tools_list as $age) {
       $toolsurl = constant("Tools_url").'?url='.$age['tools_url'];
       ?>
       <div class="col-sm-6 col-md-4 col-lg-3 tool-item <?php if($age['tools_type']){echo pinyin($age['tools_type'], 'first');}else{echo 'qt';}?>">
        <a href="<?php echo $toolsurl;?>">
          <div class="maple-tool-item image-shadow">
            <span class="maple-tool-icon maple-tool-item-color<?php echo rand(1,6);?>"><?php echo mb_substr($age['title'],0,1,'utf-8');?></span>
            <h3 class="maple-tool-name"><?php echo $age['title'];?></h3>
            <span class="maple-tool-describe"><?php echo $age['explains'];?></span>
            <div class="maple-tool-tags">
              <span class="maple-tool-tag"  title="工具类型"><?php echo $age['tools_type'];?></span><span class="maple-tool-tag"  title="使用次数"><i class="fa fa-eye"></i> <?php echo $age['tools_number'];?></span><span class="maple-tool-tag"  title="点赞" onclick="ajax_love(<?php echo $age['id'];?>)" id="tools_love_<?php echo $age['id'];?>" <?php if ($_COOKIE["love_id_".$age['id']]) {echo 'style="color:red;"';}?>><i class="fa fa-heart"></i> <?php echo $age['tools_love'];?></span>
            </div>
            <span class="maple-tool-auth" title="工具作者">
              <i class="fa fa-user-circle-o"></i> Youngxj</span>
              <span class="maple-tool-in" title="点击打开工具">
                <i class="fa fa-sign-in"></i> Open</span>
              </div>
            </a>
          </div>
          <?php }?>
        </div>
      </div>
      <script>
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
      <?php }?>
      <?php
      $sp->table_name = "tools_links";
      $tools_links = $sp->findall(array('state'=>'0','type'=>'0'),"priority desc","*");
      ?>
      <div class="container links_">
        <div class="links_bt">
          <div class="links_bt_l">
            <a href="javascript:;">友情链接</a>
          </div>
          <div class="links_bt_r">
            <a href="../about" rel="nofollow" target="_blank">申请</a>
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
      <?php include 'footer.php';?>