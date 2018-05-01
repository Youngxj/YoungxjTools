<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>css压缩和解压缩-php源码-代潇瑞博客</title>
<meta name="keywords" content="css压缩,css解压缩,php压缩css" />
<meta name="description" content="一款实用的工具，php实现压缩css和解压缩css的功能" />
</head>
<?php   
    $string = trim(stripslashes($_POST['code']));       //stripslashes()函数删除转义字符（反斜杠）
    if(!empty($string)){
        if($_POST['method'] == '压缩' ){
            $string = css_compress($string);
        }elseif($_POST['method'] == '解压缩' ){
            $string = css_decompress($string);
        }
    }else{
        $string = '';
    }
    
    function css_compress($string){
        //压缩
        $string = str_replace("\r\n","",$string);   //首先去掉换行
        $string = preg_replace("/(\s*\{\s*)/","{",$string);
        $string = preg_replace("/(\s*\;\s*\}\s*)/","}",$string);    //去掉反括号首位的空格和换行，和最后一个;
        $string = preg_replace("/(\s*\;\s*)/",";",$string);
        return $string;
    }
    
    function css_decompress($string){
        //解压
        $string = css_compress($string);    //为了效果更好，解压前，先压缩至最简状态
        $string = str_replace("{","\r\n{\r\n\t",$string);
        $string = str_replace("}","\r\n}\r\n\r\n",$string); 
        $string = str_replace(";",";\r\n\t",$string);
        $string = str_replace("*/","*/\r\n",$string);
        return $string;
    }
?>
<body>
  <div style="width:800px;height:500px;text-align:center">
  <p><strong>请将css代码粘贴到下面框中,然后选择压缩/解压缩</strong></p>
  <form action="" method="post" name="css_code">
    <textarea style="width:90%;height:460px;padding:5px;" name="code"><?php echo $string; ?></textarea>
    <br />
    <input type="submit" name="method" value="压缩" />
    <input type="submit" name="method" value="解压缩" />
  </form>
  </div>
</body>
</html>