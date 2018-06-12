<?php
$id = '49';
include '../../header.php';
?>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">在线进制转换</div>
    <div class="panel-body">
      <div class="form-horizontal">
        <div class="form-group">
          <label for="input_num" class="col-sm-2 control-label">原始进制</label>
          <div class="col-sm-10">
            <label class="radio-inline">
              <input type="radio" name="input_" value="2">2进制</label>
            <label class="radio-inline">
              <input type="radio" name="input_" value="4">4进制</label>
            <label class="radio-inline">
              <input type="radio" name="input_" value="8">8进制</label>
            <label class="radio-inline">
              <input type="radio" name="input_" value="10" checked="checked">10进制</label>
            <label class="radio-inline">
              <input type="radio" name="input_" value="16">16进制</label>
            <label class="radio-inline">
              <input type="radio" name="input_" value="32">32进制</label>
            <select id="input_num" class="input-small form-control" style="width: 100px; float:right;">
              <option value="2">2进制</option>
              <option value="3">3进制</option>
              <option value="4">4进制</option>
              <option value="5">5进制</option>
              <option value="6">6进制</option>
              <option value="7">7进制</option>
              <option value="8">8进制</option>
              <option value="9">9进制</option>
              <option value="10" selected="">10进制</option>
              <option value="11">11进制</option>
              <option value="12">12进制</option>
              <option value="13">13进制</option>
              <option value="14">14进制</option>
              <option value="15">15进制</option>
              <option value="16">16进制</option>
              <option value="17">17进制</option>
              <option value="18">18进制</option>
              <option value="19">19进制</option>
              <option value="20">20进制</option>
              <option value="21">21进制</option>
              <option value="22">22进制</option>
              <option value="23">23进制</option>
              <option value="24">24进制</option>
              <option value="25">25进制</option>
              <option value="26">26进制</option>
              <option value="27">27进制</option>
              <option value="28">28进制</option>
              <option value="29">29进制</option>
              <option value="30">30进制</option>
              <option value="31">31进制</option>
              <option value="32">32进制</option>
              <option value="33">33进制</option>
              <option value="34">34进制</option>
              <option value="35">35进制</option>
              <option value="36">36进制</option></select>
          </div>
        </div>
        <div class="form-group">
          <label for="input_value" class="col-sm-2 control-label">转换数字</label>
          <div class="col-sm-10">
            <input id="input_value" type="text" value="" onpropertychange="px()" onchange="px()" oninput="px()" class="toolInput num_value form-control" placeholder="在此输入待转换数字"></div>
        </div>
        <div class="form-group">
          <label for="output_num" class="col-sm-2 control-label">目标进制</label>
          <div class="col-sm-10">
            <label class="radio-inline">
              <input type="radio" name="output_" value="2">2进制</label>
            <label class="radio-inline">
              <input type="radio" name="output_" value="4">4进制</label>
            <label class="radio-inline">
              <input type="radio" name="output_" value="8">8进制</label>
            <label class="radio-inline">
              <input type="radio" name="output_" value="10">10进制</label>
            <label class="radio-inline">
              <input type="radio" name="output_" value="16" checked="checked">16进制</label>
            <label class="radio-inline">
              <input type="radio" name="output_" value="32">32进制</label>
            <select id="output_num" onchange="px(1);" class="input-small form-control" style="width: 100px; float:right;">
              <option value="2">2进制</option>
              <option value="3">3进制</option>
              <option value="4">4进制</option>
              <option value="5">5进制</option>
              <option value="6">6进制</option>
              <option value="7">7进制</option>
              <option value="8">8进制</option>
              <option value="9">9进制</option>
              <option value="10">10进制</option>
              <option value="11">11进制</option>
              <option value="12">12进制</option>
              <option value="13">13进制</option>
              <option value="14">14进制</option>
              <option value="15">15进制</option>
              <option value="16" selected="">16进制</option>
              <option value="17">17进制</option>
              <option value="18">18进制</option>
              <option value="19">19进制</option>
              <option value="20">20进制</option>
              <option value="21">21进制</option>
              <option value="22">22进制</option>
              <option value="23">23进制</option>
              <option value="24">24进制</option>
              <option value="25">25进制</option>
              <option value="26">26进制</option>
              <option value="27">27进制</option>
              <option value="28">28进制</option>
              <option value="29">29进制</option>
              <option value="30">30进制</option>
              <option value="31">31进制</option>
              <option value="32">32进制</option>
              <option value="33">33进制</option>
              <option value="34">34进制</option>
              <option value="35">35进制</option>
              <option value="36">36进制</option></select>
          </div>
        </div>
        <div class="form-group">
          <label for="output_value" class="col-sm-2 control-label">转换结果</label>
          <div class="col-sm-10">
            <input type="text" id="output_value" class="toolInput num_value form-control" placeholder="转换结果"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">工具简介</div>
    <div class="panel-body">
      <p>支持在2~36进制之间进行任意转换，支持浮点型。</p>
    </div>
  </div>
</div>
<script src="hex.js"></script>
<?php include '../../footer.php';?>