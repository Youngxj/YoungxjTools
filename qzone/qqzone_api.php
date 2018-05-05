
<?php
include '../function.base.php';
if(getParam('qq')){
  $qq = htmlClean(getParam('qq'));
  if(!is_numeric($qq)){
    $arr = array('code'=>'0','msg'=>'不是QQ');
    echoJson(json_encode($arr));
  }
  $name = 'qzone_url/'.md5($qq).'.html';
  $fileDir = $name;
  
  if(file_exists($fileDir)){
    $arr = array('code'=>'1','msg'=>'ok','url'=>$fileDir,'qq'=>$qq);
    echoJson(json_encode($arr));
  }
  //要创建的两个文件 
  $TxtFileName = $name; 
  //以读写方式打写指定文件，如果文件不存则创建 
  if( ($TxtRes=fopen ($TxtFileName,"w+")) === FALSE){
    $arr = array('code'=>'0','msg'=>'创建失败');
    echoJson(json_encode($arr));
    exit(); 
  }

  $StrConents = '
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<body>
	<script language="javascript" type="text/javascript">
var ua = navigator.userAgent;
var ipad = ua.match(/(iPad).*OS\s([\d_]+)/),
    isIphone = !ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/),
    isAndroid = ua.match(/(Android)\s+([\d.]+)/),
    isMobile = isIphone || isAndroid;
	if(isIphone){
        location.href = "mqqapi://card/show_pslcard?src_type=internal&version=1&uin='.$qq.'&card_type=person&source=sharecard";
    }else if(isAndroid){
        location.href = "mqqapi://card/show_pslcard?src_type=internal&version=1&uin='.$qq.'&card_type=person&source=sharecard";
    }else{
        location.href = "tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin='.$qq.'";
    }
</script>
</head>
</body>
</html>';
  if(!fwrite ($TxtRes,$StrConents)){ //将信息写入文件 
    $arr = array('code'=>'0','msg'=>'写入失败');
    echoJson(json_encode($arr));
    exit(); 
  } 
  $arr = array('code'=>'1','msg'=>'ok','url'=>$TxtFileName,'qq'=>$qq);
  echoJson(json_encode($arr));
  fclose ($TxtRes); //关闭指针 
}else{exit();}
?>