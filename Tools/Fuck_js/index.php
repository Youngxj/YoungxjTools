<?php
$id="44";
include '../../header.php';
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">js编码</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<form class="ns">
					<p><b><span class="form_label" style="width: 300px;">贴入要加密混乱的Javascript代码</span></b></p>
					<p><textarea id="js_input" value="" class="form-control" rows="5">document.write('YoungxjTools tools.yum6.cn');</textarea></p>
					<p>
						<input  type="button" class="btn btn-primary" onclick="javascript:on_click(1);" value="转码1">
						<input  type="button" class="btn btn-success" onclick="javascript:on_click(2);" value="转码2">
						<input  type="button" class="btn btn-info" 	  onclick="javascript:on_click(3);" value="字符串转码">
						<input  type="button" class="btn btn-warning" onclick="javascript:on_click(4);" value="JS转码">
						<input  type="button" class="btn btn-default" onclick="javascript:on_click(5);" value="数字转码">
					</p>
					<p>
						<textarea id="js_output" value=""  class="form-control" rows="7"></textarea>
					</p>
					<div ><span id="stats" class="green" style="float:right;">&nbsp;</span></div>
				</form>

			</div>
		</div>
	</div>
	<script src="hieroglyphy.js"></script>
	<script src="jsfuck.js"></script>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">工具简介</h3>
		</div>
		<div class="panel-body">
			<li>6个字符[]()!+进行的转码加密</li>
			<li>建议只转码加密关键信息，代码过长转码加密时间会很长，甚至卡死。</li>
			<li style="color:red;">转码1 = 不直接执行</li>
			<li style="color:red;">转码2 = 直接执行</li>
			<li>工具可以把你的Javascript代码转化成只有6 个字符 []()!+ 的代码，并且完全可以正常执行。</li>
			<li>转换之后的Javascript代码非常难读，可以作为一些简单的保密措施，但是一般会增加文件大小，不建议采用。</li>
			<li>如果用作加密工具，请注意备份未加密的源代码。</li>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Js代码</th>
						<th>转码</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">
							<code>false</code>
						</th>
						<td>![]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>true</code>
						</th>
						<td>!![]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>undefined</code>
						</th>
						<td>[][[]]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>NaN</code>
						</th>
						<td>+[![]]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>0</code>
						</th>
						<td>+[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>1</code>
						</th>
						<td>+!+[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>2</code>
						</th>
						<td>!+[]+!+[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>10</code>
						</th>
						<td>[+!+[]]+[+[]]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>Array</code>
						</th>
						<td>[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>Number</code>
						</th>
						<td>+[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>String</code>
						</th>
						<td>[]+[]</td>
					</tr>
					<tr>
						<th scope="row">
							<code>Boolean</code>
						</th>
						<td>![]</td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function on_click(t) {
		if (t == 1) {
			var output = JSFuck.encode($("#js_input").val(), 0);
			$("#js_output").val(output);
			$("#stats").html(output.length + " 字符");
		}
		else if(t == 2) {
			var output = JSFuck.encode($("#js_input").val(), 1);
			$("#js_output").val(output);
			$("#stats").html(output.length + " 字符");
		}
		else if(t == 3) {
			var output = hieroglyphy.hieroglyphyString($("#js_input").val());
			$("#js_output").val(output);
			$("#stats").html(output.length + " 字符");
		}
		else if(t == 4) {
			var output = hieroglyphy.hieroglyphyScript($("#js_input").val());
			$("#js_output").val(output);
			$("#stats").html(output.length + " 字符");
		}
		else if(t == 5) {
			var output = hieroglyphy.hieroglyphyNumber(+($("#js_input").val()));
			$("#js_output").val(output);
			$("#stats").html(output.length + " 字符");
		}
	}
</script>
<?php include '../../footer.php';?>