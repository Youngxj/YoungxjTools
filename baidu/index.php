<?php
$id="20";
include '../header.php';?>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
  /*针对排版做的一点调整*/
  .title img{vertical-align:0;}
  h1{margin:20px !important;}
</style>
<img src="arrow.png" id="arrow">
    <div class="about" title="点我点我！" onclick="showAbout()">?</div>
    <div id="msgbox" class="pop-box">
        <span class="caption">专治各种疑问党</span>
        <div class="thanks copyBaidu">
            *本站与百度公司没有任何联系，baidu以及本站出现的百度公司Logo是百度公司的商标。
        </div>
        <div class="readit" onclick="hideAbout();">我知道了</div>
        
    </div>
	<div id="mask" class="mask"></div>

    <div class="containerss">
        <div>
            <h1 class="title">需要我帮你<img src="baidu_logo.png" class="baidulogo">么</h1>
            <span class="search-box">
                <input type="text" class="search-text" id="kw">
                <button class="btn" id="search">百度一下</button>
            </span>
        </div>
        <div id="instructions">
            输入你的问题，然后按百度一下
        </div>
        <div class="link" style="display: none" id="link">
            <input type="text" id="lmbtfyLink" class="copyable">
            <div>
                <a class="link_button" href="javascript:copyUrl2();" id="copy">复制</a>
                <a class="link_button" href="javascript:void(0);" id="go" target="_blank">预览</a>
            </div>
        </div>
    </div>
<script type="text/javascript" src="lmbtfy.php"></script>
<?php include '../footer.php';?>