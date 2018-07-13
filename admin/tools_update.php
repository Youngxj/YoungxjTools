<?php
include 'header.php';
include 'module.php';

if ($_POST['submit']){
  $tmp_name = $_FILES["file"]["tmp_name"];
  $fileName = $_FILES["file"]["name"];
  if(!$tmp_name){
    echo msgEcho('请选择文件','tools_update');
  }

  $zip = new ZipArchive();
  $res = $zip->open($tmp_name);
  if ($res === TRUE) {
    $failfiles = $zip->extractTo("../".$CONF['config']['TOOLS_T']);
    if(!$failfiles){
      echo msgEcho('上传失败,工具目录不可写','tools_update');
      exit();
    }
    $stream = $zip->getStream(str_replace('.zip','',$fileName).'/index.php'); 
  } else {
    echo msgEcho('文件打开失败','tools_update');
    exit();
  }
  $zip->close();
  /*获取文件注释信息*/
  $a = stream_get_contents($stream);
  $encode = mb_detect_encoding($a, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
  if ($encode == "GBK"){ 
    $outstr = iconv("GBK","UTF-8",$a); 
  }else{
    $outstr = $a; 
  }
  preg_match_all('/Title:(.*)/',$outstr,$Tools_Title);
  preg_match_all('/Subtitle:(.*)/',$outstr,$Tools_Subtitle);
  preg_match_all('/Plugin Name:(.*)/',$outstr,$Tools_Name);
  preg_match_all('/Description:(.*)/',$outstr,$Tools_Description);
  preg_match_all('/Author:(.*)/',$outstr,$Tools_Author);
  preg_match_all('/Author Email:(.*)/',$outstr,$Tools_Email);
  preg_match_all('/Author URL:(.*)/',$outstr,$Tools_URL);
  preg_match_all('/Version:(.*)/',$outstr,$Tools_Version);

  $Title = trim($Tools_Title[1][0]) ? trim($Tools_Title[1][0]) : '';
  $Subtitle = trim($Tools_Subtitle[1][0]) ? trim($Tools_Subtitle[1][0]) : '';
  $Name = trim($Tools_Name[1][0]) ? trim($Tools_Name[1][0]) : '';
  $Description = trim($Tools_Description[1][0]) ? trim($Tools_Description[1][0]) : '';
  $Author = trim($Tools_Author[1][0]) ? trim($Tools_Author[1][0]) : '';
  $Email = trim($Tools_Email[1][0]) ? trim($Tools_Email[1][0]) : '';
  $URL = trim($Tools_URL[1][0]) ? trim($Tools_URL[1][0]) : '';
  $Version = trim($Tools_Version[1][0]) ? trim($Tools_Version[1][0]) : '';
  if ($Title=='' && $Name=='' && $Description=='') {
    echo msgEcho('插件信息有误,请检查并编写规范','tools_update');
    exit();
  }

  

  $tools_up = new Model("tools_list");

  $as=$tools_up->find(array("tools_url = '$Name'"),"id desc","*");
  if($as){
    $config = array(
      "title" => addslashes($Title),
      "subtitle" => addslashes($Subtitle),
      "keyword" => addslashes($Description),
      "tools_url" => addslashes($Name),
      "tools_author" => addslashes($Author),
    );
    $condition = array('tools_url'=>$Name);
    $tools_ups = $tools_up->update($condition,$config);
    if($tools_ups){
      echo msgEcho('('.$Title.')覆盖成功','tools_list');
    }else{
      echo msgEcho('('.$Title.')覆盖失败[原始数据未更改]','tools_list');
    }
  }else{
    $config = array(
      "title" => addslashes($Title),
      "subtitle" => addslashes($Subtitle),
      "keyword" => addslashes($Description),
      "tools_url" => addslashes($Name),
      "tools_img" => '/images/default.png',
      "tools_type" => '站长类',
      "tools_number" => '0',
      "tools_love" => '0',
      "priority" => '0',
      "type" => '0',
      "state" => '0',
      "tools_author" => addslashes($Author),
    );
    $tools_ups = $tools_up->create($config);
    if($tools_ups){
      echo msgEcho('('.$Title.')安装成功','tools_list');
    }else{
      echo msgEcho('('.$Title.')安装失败','tools_update');
    }
  }

}

if (getParam('fileGet')) {
  $url = getParam('fileGet');
  $str = getFile($url,'down/',basename($url),1);
  $tmp_name = $str['save_path'];
  $fileName = $str['file_name'];
  if(!$tmp_name){
    echo msgEcho('文件未获取','tools_down');
  }

  $zip = new ZipArchive();
  $res = $zip->open($tmp_name); 
  if ($res === TRUE) {
    $failfiles = $zip->extractTo("../".$CONF['config']['TOOLS_T']);
    if(!$failfiles){
      deleteDir('down');
      echo msgEcho('安装失败,工具目录不可写','tools_down');
      exit();
    }
    $stream = $zip->getStream(str_replace('.zip','',$fileName).'/index.php'); 
  } else {
    deleteDir('down');
    echo msgEcho('文件打开失败','tools_down');
    exit();
  } 
  $zip->close();
  /*获取文件注释信息*/
  $a = stream_get_contents($stream);
  $encode = mb_detect_encoding($a, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
  if ($encode == "GBK"){ 
    $outstr = iconv("GBK","UTF-8",$a); 
  }else{
    $outstr = $a; 
  }
  preg_match_all('/Title:(.*)/',$outstr,$Tools_Title);
  preg_match_all('/Subtitle:(.*)/',$outstr,$Tools_Subtitle);
  preg_match_all('/Plugin Name:(.*)/',$outstr,$Tools_Name);
  preg_match_all('/Description:(.*)/',$outstr,$Tools_Description);
  preg_match_all('/Author:(.*)/',$outstr,$Tools_Author);
  preg_match_all('/Author Email:(.*)/',$outstr,$Tools_Email);
  preg_match_all('/Author URL:(.*)/',$outstr,$Tools_URL);
  preg_match_all('/Version:(.*)/',$outstr,$Tools_Version);

  $Title = trim($Tools_Title[1][0]) ? trim($Tools_Title[1][0]) : '';
  $Subtitle = trim($Tools_Subtitle[1][0]) ? trim($Tools_Subtitle[1][0]) : '';
  $Name = trim($Tools_Name[1][0]) ? trim($Tools_Name[1][0]) : '';
  $Description = trim($Tools_Description[1][0]) ? trim($Tools_Description[1][0]) : '';
  $Author = trim($Tools_Author[1][0]) ? trim($Tools_Author[1][0]) : '';
  $Email = trim($Tools_Email[1][0]) ? trim($Tools_Email[1][0]) : '';
  $URL = trim($Tools_URL[1][0]) ? trim($Tools_URL[1][0]) : '';
  $Version = trim($Tools_Version[1][0]) ? trim($Tools_Version[1][0]) : '';
  if ($Title=='' && $Name=='' && $Description=='') {
    deleteDir('down');
    echo msgEcho('插件信息有误,请检查并编写规范','tools_down');
    exit();
  }

  

  $tools_up = new Model("tools_list");

  $as=$tools_up->find(array("tools_url = '$Name'"),"id desc","*");
  if($as){
    $config = array(
      "title" => addslashes($Title),
      "subtitle" => addslashes($Subtitle),
      "keyword" => addslashes($Description),
      "tools_url" => addslashes($Name),
      "tools_author" => addslashes($Author),
    );
    $condition = array('tools_url'=>$Name);
    $tools_ups = $tools_up->update($condition,$config);
    if($tools_ups){
      deleteDir('down');
      echo msgEcho('('.$Title.')覆盖成功','tools_list');
    }else{
      deleteDir('down');
      echo msgEcho('('.$Title.')覆盖失败[原始数据未更改]','tools_list');
    }
  }else{
    $config = array(
      "title" => addslashes($Title),
      "subtitle" => addslashes($Subtitle),
      "keyword" => addslashes($Description),
      "tools_url" => addslashes($Name),
      "tools_img" => '/images/default.png',
      "tools_type" => '站长类',
      "tools_number" => '0',
      "tools_love" => '0',
      "priority" => '0',
      "type" => '0',
      "state" => '0',
      "tools_author" => addslashes($Author),
    );
    $tools_ups = $tools_up->create($config);
    if($tools_ups){
      deleteDir('down');
      echo msgEcho('('.$Title.')安装成功','tools_list');
    }else{
      echo msgEcho('('.$Title.')安装失败','tools_down');
    }
  }

}
?>
<div id="content">
  <div id="content-header">
    <h1>上传工具</h1>
  </div>
  <div id="breadcrumb">
    <a href="index.php" title="" class="tip-bottom" data-original-title="Go to Home"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">上传工具</a>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="fa fa-cog"></i>									
          </span>
          <h5>上传工具</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="tools_update.php" method="post" class="form-horizontal" name="setting" enctype="multipart/form-data">
            <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">安装工具</label>
              <div class="col-sm-9 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputfile">选择工具包(.zip)</label>
                      <input type="file" id="inputfile" accept=".zip" name="file">
                    </div>
                    <div class="form-group">
                      <input type="submit"  name="submit" value="安装" class="form-control btn-success" id="update">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>						
    </div>
  </div>
  <script type="text/javascript">
    document.getElementById("update").onclick=function(){
      if(document.getElementById("inputfile").value==""){
        alert("请上传附件");
        return false;
      }
    }
  </script>
  <?php include 'footer.php';?>