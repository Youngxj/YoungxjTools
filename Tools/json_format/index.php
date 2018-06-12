<?php 
$id = '45';
include '../../header.php';
?>
<link href="res/base.css" rel="stylesheet">

<header class="header">
    
</header>

<main class="row-fluid">
    <div class="col-md-5" style="padding:0;">
        <textarea id="json-src" placeholder="在此输入json字符串或XML字符串..."   class="form-control adapter_height form-control"  style="padding:20px;border:0;border-right:solid 1px #ddd;border-bottom:solid 1px #ddd;border-radius:0;resize: none; outline:none;">
{"code":"1","state":200}</textarea>
    </div>
    <div class="col-md-7" style="padding:0;">
        <div style="padding:7px;font-size:16px;border-bottom:solid 1px #ddd;" class="navi">
            <a href="#" class="zip" title="压缩"  data-placement="bottom"><i class="fa fa-database"></i></a>
            <a href="#" class="xml" title="转XML"  data-placement="bottom"><i class="fa fa-file-excel-o"></i></a>
            <a href="#" class="" style="color:#15b374;cursor:no-drop;" title="染色"  data-placement="bottom"><i class="fa fa-flask"></i></a>
            <a href="#" class="clear" title="清空"  data-placement="bottom"><i class="fa fa-trash"></i></a>
        </div>
        <div id="json-target" class="adapter_height form-control" style="padding:20px;border-right:solid 1px #ddd;border-bottom:solid 1px #ddd;border-radius:0;resize: none;overflow-y:scroll; outline:none;">
        </div>
        <form id="form-save" method="POST"><input type="hidden" value="" id="txt-content" name="content"></form>
    </div>
</main>
<script src="res/jquery.json.js"></script>
<script src="res/jquery.xml2json.js"></script>
<script src="res/jquery.json2xml.js"></script>
<script src="http://cdn.bootcss.com/json2/20150503/json2.min.js"></script>
<script src="http://cdn.bootcss.com/jsonlint/1.6.0/jsonlint.min.js"></script>
<script type="text/javascript">
var current_json = '';
var current_json_str = '';
var xml_flag = false;
var zip_flag = false;
function init(){
    xml_flag = false;
    zip_flag = false;
    $('.xml').attr('style','color:#999;');
    $('.zip').attr('style','color:#999;');
}
$('#json-src').keyup(function(){
    init();
    var content = $.trim($(this).val());
    var result = '';
    if (content!='') {
        //如果是xml,那么转换为json
        if (content.substr(0,1) === '<' && content.substr(-1,1) === '>') {
            try{
                var json_obj = $.xml2json(content);
                content = JSON.stringify(json_obj);
            }catch(e){
                result = '解析错误：<span style="color: #f1592a;font-weight:bold;">' + e.message + '</span>';
                current_json_str = result;
                $('#json-target').html(result);
                return false;
            }

        }
        try{
            current_json = jsonlint.parse(content);
            current_json_str = JSON.stringify(current_json);
            //current_json = JSON.parse(content);
            result = new JSONFormat(content,4).toString();
        }catch(e){
            result = '<span style="color: #f1592a;font-weight:bold;">' + e + '</span>';
            current_json_str = result;
        }

        $('#json-target').html(result);
    }else{
        $('#json-target').html('');
    }

});
$('.xml').click(function(){
    if (xml_flag) {
        $('#json-src').keyup();
    }else{
        var result = $.json2xml(current_json);
        $('#json-target').html('<textarea style="width:100%;height:100%;border:0;resize:none;">'+result+'</textarea>');
        xml_flag = true;
        $(this).attr('style','color:#15b374;');
    }

});
$('.zip').click(function(){
    if (zip_flag) {
        $('#json-src').keyup();
    }else{
        $('#json-target').html(current_json_str);
        zip_flag = true;
        $(this).attr('style','color:#15b374;');
    }

});
$('.clear').click(function(){
     $('#json-src').val('');
     $('#json-target').html('');
});
$('.save').click(function(){
    var content = JSON.stringify(current_json);
    $('#txt-content').val(content);
    $("#form-save").submit();
});
$('#json-src').keyup();

function getWinHeight() {
    var winHeight = 0;
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
    return winHeight;
}
$(window).resize(function() {
    $('#json-src').css('height', getWinHeight() - 117);
    $('#json-target').css('height', getWinHeight() - 160);
});
$(window).resize();
</script>
<?php include '../../footer.php';?>
