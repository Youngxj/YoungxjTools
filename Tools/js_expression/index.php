<?php
$id="43";
include '../../header.php';
?>
<!--该工具由ITool.Club提供-->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div id="compiler" class="panel-heading">
					<form class="form-inline" role="form">
						<label><strong style="font-size: 16px"><i class="fa fa-cogs"></i> 正则表达式在线测试</strong></label>
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="submitBTN"><i class="fa fa-send-o"></i> 生成代码</button>
					</form>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger" style="display: none;"></div>
						</div>
						<div class="col-md-12">
							<textarea rows="6" id="textSour" placeholder="在此输入待匹配文本" class="form-control"></textarea>
						</div>

						<div class="col-md-12" style="font-size:14px;padding-top: 12px;"> 

							<form class="form-inline"> 

								<div class="form-group">
									<label for="email">正则表达式:</label>
									<input type="text" id="textPattern" placeholder="在此输入正则表达式" class="form-control">
								</div>
								<div class="checkbox"><label><input type="checkbox" value="global" checked="checked" id="optionGlobal" name="optionGlobl">全局搜索</label></div>
								<div class="checkbox"><label><input type="checkbox" value="ignoreCase" id="optionIgnoreCase" name="optionIgnoreCase">忽略大小写</label></div>
								<div class="form-group"><label><a class="btn btn-success" onclick="return onMatch();">测试匹配</a></label></div>

							</form>
						</div>

						<div class="col-md-12"  style="font-size:14px;padding-top: 12px;" >
							<textarea rows="6" readonly="readonly" placeholder="匹配结果..." id="textMatchResult" class="form-control"></textarea>
						</div>
						<div class="col-md-12"  style="font-size:14px;padding-top: 12px;">
							<form class="form-inline">
								<div class="form-group">
									<label for="email">替换文本：</lable>
										<input type="text" id="textReplace" name="textReplace" class="form-control" placeholder="在此输入替换文本">
									</div>
									<div class="form-group">
										<label>
											<a onclick="return onReplace()" class="btn btn-warning"><i class="icon-chevron-down icon-white"></i>替换</a>
										</label>
									</div>
								</form>
							</div>
							<div class="col-md-12"  style="font-size:14px;padding-top: 12px;">
								<textarea rows="6" readonly="readonly" id="textReplaceResult" class="form-control" placeholder="替换结果..." ></textarea>
							</div>
						</div>

					</div>
				</div>
			</div>
      <style>.panel-body{word-wrap: break-word;}</style>
			<div class="col-md-12">
				<div id="about" class="panel panel-default">
					<div class="panel-heading">常用正则表达式</div>
					<div class="panel-body">
						<h2>一、校验数字的表达式</h2>
						<ul>
							<li>数字：<strong>^[0-9]*$</strong></li>
							<li>n位的数字：<strong>^\d{n}$</strong></li>
							<li>至少n位的数字<strong>：^\d{n,}$</strong></li>
							<li>m-n位的数字：<strong>^\d{m,n}$</strong></li>
							<li>零和非零开头的数字：<strong>^(0|[1-9][0-9]*)$</strong></li>
							<li>非零开头的最多带两位小数的数字：<strong>^([1-9][0-9]*)+(\.[0-9]{1,2})?$</strong></li>
							<li>带1-2位小数的正数或负数：<strong>^(\-)?\d+(\.\d{1,2})$</strong></li>
							<li>正数、负数、和小数：<strong>^(\-|\+)?\d+(\.\d+)?$</strong></li>
							<li>有两位小数的正实数：<strong>^[0-9]+(\.[0-9]{2})?$</strong></li>
							<li>有1~3位小数的正实数：<strong>^[0-9]+(\.[0-9]{1,3})?$</strong></li>
							<li>非零的正整数：<strong>^[1-9]\d*$ 或 ^([1-9][0-9]*){1,3}$ 或 ^\+?[1-9][0-9]*$</strong></li>
							<li>非零的负整数：<strong>^\-[1-9][]0-9"*$ 或 ^-[1-9]\d*$</strong></li>
							<li>非负整数：<strong>^\d+$ 或 ^[1-9]\d*|0$</strong></li>
							<li>非正整数：<strong>^-[1-9]\d*|0$ 或 ^((-\d+)|(0+))$</strong></li>
							<li>非负浮点数：<strong>^\d+(\.\d+)?$ 或 ^[1-9]\d*\.\d*|0\.\d*[1-9]\d*|0?\.0+|0$</strong></li>
							<li>非正浮点数：<strong>^((-\d+(\.\d+)?)|(0+(\.0+)?))$ 或 ^(-([1-9]\d*\.\d*|0\.\d*[1-9]\d*))|0?\.0+|0$</strong></li>
							<li>正浮点数：<strong>^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$ 或 ^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$</strong></li>
							<li>负浮点数：<strong>^-([1-9]\d*\.\d*|0\.\d*[1-9]\d*)$ 或 ^(-(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*)))$</strong></li>
							<li>浮点数：<strong>^(-?\d+)(\.\d+)?$ 或 ^-?([1-9]\d*\.\d*|0\.\d*[1-9]\d*|0?\.0+|0)$</strong></li>
						</ul>

						<hr>
						<h2>二、校验字符的表达式</h2>
						<ul>
							<li>汉字：<strong>^[\u4e00-\u9fa5]{0,}$</strong></li>
							<li>英文和数字：<strong>^[A-Za-z0-9]+$ 或 ^[A-Za-z0-9]{4,40}$</strong></li>
							<li>长度为3-20的所有字符：<strong>^.{3,20}$</strong></li>
							<li>由26个英文字母组成的字符串：<strong>^[A-Za-z]+$</strong></li>
							<li>由26个大写英文字母组成的字符串：<strong>^[A-Z]+$</strong></li>
							<li>由26个小写英文字母组成的字符串：<strong>^[a-z]+$</strong></li>
							<li>由数字和26个英文字母组成的字符串：<strong>^[A-Za-z0-9]+$</strong></li>
							<li>由数字、26个英文字母或者下划线组成的字符串：<strong>^\w+$ 或 ^\w{3,20}$</strong></li>
							<li>中文、英文、数字包括下划线：<strong>^[\u4E00-\u9FA5A-Za-z0-9_]+$</strong></li>
							<li>中文、英文、数字但不包括下划线等符号：<strong>^[\u4E00-\u9FA5A-Za-z0-9]+$ 或 ^[\u4E00-\u9FA5A-Za-z0-9]{2,20}$</strong></li>
							<li>可以输入含有^%&',;=?$\"等字符：<strong>[^%&',;=?$\x22]+</strong></li>
							<li>禁止输入含有~的字符：<strong>[^~\x22]+</strong></li>
						</ul>
						<hr>
						<h2>三、特殊需求表达式</h2>
						<ul>
							<li>Email地址：<strong>^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$</strong></li>
							<li>域名：<strong>[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(/.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+/.?</strong></li>
							<li>InternetURL：<strong>[a-zA-z]+://[^\s]* 或 ^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$</strong></li>
							<li>手机号码：<strong>^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$</strong></li>
							<li>电话号码("XXX-XXXXXXX"、"XXXX-XXXXXXXX"、"XXX-XXXXXXX"、"XXX-XXXXXXXX"、"XXXXXXX"和"XXXXXXXX)：<strong>^(\(\d{3,4}-)|\d{3.4}-)?\d{7,8}$ </strong></li>
							<li>国内电话号码(0511-4405222、021-87888822)：<strong>\d{3}-\d{8}|\d{4}-\d{7}</strong>
							</li>
							<li>电话号码正则表达式（支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号）: <strong>((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)</strong></li>
							<li>身份证号(15位、18位数字)，最后一位是校验位，可能为数字或字符X：<strong>(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)</strong></li>
							<li>帐号是否合法(字母开头，允许5-16字节，允许字母数字下划线)：<strong>^[a-zA-Z][a-zA-Z0-9_]{4,15}$</strong></li>
							<li>密码(以字母开头，长度在6~18之间，只能包含字母、数字和下划线)：<strong>^[a-zA-Z]\w{5,17}$</strong></li>
							<li>强密码(必须包含大小写字母和数字的组合，不能使用特殊字符，长度在8-10之间)：<strong>^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$  </strong></li>
							<li>日期格式：<strong>^\d{4}-\d{1,2}-\d{1,2}</strong></li>
							<li>一年的12个月(01～09和1～12)：<strong>^(0?[1-9]|1[0-2])$</strong></li>
							<li>一个月的31天(01～09和1～31)：<strong>^((0?[1-9])|((1|2)[0-9])|30|31)$ </strong></li>
							<li>钱的输入格式：
								<ol>
									<li>有四种钱的表示形式我们可以接受:"10000.00" 和 "10,000.00", 和没有 "分" 的 "10000" 和 "10,000"：<strong>^[1-9][0-9]*$ </strong></li>
									<li>这表示任意一个不以0开头的数字,但是,这也意味着一个字符"0"不通过,所以我们采用下面的形式：<strong>^(0|[1-9][0-9]*)$ </strong></li><li>
										一个0或者一个不以0开头的数字.我们还可以允许开头有一个负号：<strong>^(0|-?[1-9][0-9]*)$ </strong></li>
										<li>这表示一个0或者一个可能为负的开头不为0的数字.让用户以0开头好了.把负号的也去掉,因为钱总不能是负的吧。下面我们要加的是说明可能的小数部分：<strong>^[0-9]+(.[0-9]+)?$ </strong></li>
										<li>必须说明的是,小数点后面至少应该有1位数,所以"10."是不通过的,但是 "10" 和 "10.2" 是通过的：<strong>^[0-9]+(.[0-9]{2})?$ </strong></li>
										<li>这样我们规定小数点后面必须有两位,如果你认为太苛刻了,可以这样：<strong>^[0-9]+(.[0-9]{1,2})?$ </strong></li>
										<li>这样就允许用户只写一位小数.下面我们该考虑数字中的逗号了,我们可以这样：<strong>^[0-9]{1,3}(,[0-9]{3})*(.[0-9]{1,2})?$ </strong></li>
										<li>1到3个数字,后面跟着任意个 逗号+3个数字,逗号成为可选,而不是必须：<strong>^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$ </strong></li>
										<li>备注：这就是最终结果了,别忘了"+"可以用"*"替代如果你觉得空字符串也可以接受的话(奇怪,为什么?)最后,别忘了在用函数时去掉去掉那个反斜杠,一般的错误都在这里</li></ol></li>
										<li>xml文件：<strong>^([a-zA-Z]+-?)+[a-zA-Z0-9]+\\.[x|X][m|M][l|L]$</strong></li>
										<li>中文字符的正则表达式：<strong>[\u4e00-\u9fa5]</strong></li>
										<li>双字节字符：<strong>[^\x00-\xff]    (包括汉字在内，可以用来计算字符串的长度(一个双字节字符长度计2，ASCII字符计1))</strong></li>
										<li>空白行的正则表达式：<strong>\n\s*\r    (可以用来删除空白行)</strong></li>
										<li>HTML标记的正则表达式：<strong><(\S*?)[^>]*>.*?</\1>|<.*? />    (
										首尾空白字符的正则表达式：^\s*|\s*$或(^\s*)|(\s*$)    (可以用来删除行首行尾的空白字符(包括空格、制表符、换页符等等)，非常有用的表达式)</strong></li>
										<li>腾讯QQ号：<strong>[1-9][0-9]{4,}    (腾讯QQ号从10000开始)</strong></li>
										<li>中国邮政编码：<strong>[1-9]\d{5}(?!\d)    (中国邮政编码为6位数字)</strong></li>
										<li>IP地址：<strong>((?:(?:25[0-5]|2[0-4]\\d|[01]?\\d?\\d)\\.){3}(?:25[0-5]|2[0-4]\\d|[01]?\\d?\\d)) </strong></li>
									</ul>
								</div>
							</div>
						</div>

					</div>

					<!-- 模态框（Modal） -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title" id="myModalLabel">各语言代码参考</h4>
								</div>
								<div class="modal-body">
									<div class="alert alert-danger" id="alert-message"></div>
									<div id="languagelist">
										<h4>JavaScript - JavaScript 正则表达式</a></h4>
										<pre id="js"></pre>

										<h4>PHP</h4>
										<pre id="php"></pre>

										<h4>Go</h4>
										<pre id="go"></pre>

										<h4>JAVA - Java 正则表达式</a></h4>
										<pre id="java"></pre>

										<h4>Ruby - Ruby 正则表达式</a></h4>
										<pre  id="rb"></pre>

										<h4>Python - Python 正则表达式</a></h4>
										<pre id="py"></pre>

									</div>
								</div>

							</div><!-- /.modal-content -->
						</div><!-- /.modal -->
					</div>
				</label>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">

	function setVisible(idElement, visible) {
		var obj = document.getElementById(idElement);
		obj.style.visibility = visible ? "visible" : "hidden";
	}
	function isValidFields() {
		var textSour = document.getElementById("textSour");
		if (null==textSour.value || textSour.value.length<1) {
			textSour.focus();
			$(".alert-danger").html("请输入待匹配文本").show().delay(5000).fadeOut();
			return false;
		}
		var textPattern = document.getElementById("textPattern");
		if (null==textPattern.value || textPattern.value.length<1) {
			textPattern.focus();
			$(".alert-danger").html("请输入正则表达式").show().delay(5000).fadeOut();
			return false;
		}
		$(".alert-danger").hide();
		return true;
	}
	function buildRegex() {
		var op = "";
		if (document.getElementById("optionGlobal").checked)op = "g";
		if (document.getElementById("optionIgnoreCase").checked)op = op + "i";
		return new RegExp(document.getElementById("textPattern").value, op);
	}
	function onMatch() {
		if (!isValidFields())
			return false;
		document.getElementById("textMatchResult").value = "";
		var regex = buildRegex();
		var result = document.getElementById("textSour").value.match(regex);
		if (null==result || 0==result.length) {
			document.getElementById("textMatchResult").value = "（没有匹配）";
			return false;
		}
		if (document.getElementById("optionGlobal").checked) {
			var strResult = "共找到 " + result.length + " 处匹配：\r\n";
			for (var i=0;i < result.length;++i)strResult = strResult + result[i] + "\r\n";
				document.getElementById("textMatchResult").value = strResult;
		}
		else {
			document.getElementById("textMatchResult").value= "匹配位置：" + regex.lastIndex + "\r\n匹配结果：" + result[0];
		}
		return true;
	}
	function onReplace() {
		var str = document.getElementById("textSour").value;
		var regex = buildRegex();
		document.getElementById("textReplaceResult").value= str.replace(regex, document.getElementById("textReplace").value);
	}
	function reset(){
		$("#textSour").val("");
		$("#textPattern").val("");
		$("#textMatchResult").val("");
		$("#textReplace").val("");
		$("#textReplaceResult").val("");
	}
	String.prototype.format = function (args) {
		if (arguments.length > 0) {
			var result = this;
			if (arguments.length == 1 && typeof (args) == "object") {
				for (var key in args) {
					var reg = new RegExp("({" + key + "})", "g");
					result = result.replace(reg, args[key]);
				}
			}
			else {
				for (var i = 0; i < arguments.length; i++) {
					if (arguments[i] == undefined) {
						result = result.replace(reg, arguments[i]);
					}
					else {
						var reg = new RegExp('\\{' + i + '\\}', 'gm'); ;
						result = result.replace(reg, arguments[i]);
					}
				}
			}
			return result;
		}
		else {
			return this;
		}
	}  
	var languageCode = {
		js: "var pattern = /{0}/,\n\tstr = '{1}';\nconsole.log(pattern.test(str));",
		php: "$str = '{1}';\n$isMatched = preg_match('/{0}/', $str, $matches);\nvar_dump($isMatched, $matches);",
		py: "import re\npattern = re.compile(ur'{0}')\nstr = u'{1}'\nprint(pattern.search(str))",
		java: "import java.util.regex.Matcher;\nimport java.util.regex.Pattern;\n\npublic class RegexMatches {\n\t\n\tpublic static void main(String args[]) {\n\t\tString str = \"{1}\";\n\t\tString pattern = \"{0}\";\n\n\t\tPattern r = Pattern.compile(pattern);\n\t\tMatcher m = r.matcher(str);\n\t\tSystem.out.println(m.matches());\n\t}\n\n}",
		go: "package main\n\nimport (\n\t\"fmt\"\n\t\"regexp\"\n)\n\nfunc main() {\n\tstr := \"{1}\"\n\tmatched, err := regexp.MatchString(\"{0}\", str)\n\tfmt.Println(matched, err)\n}",
		rb: "pattern = /{0}/\nstr = '{1}'\np pattern.match(str)"
	};
	$(document).ready(function (){
		$("#right_area li a").click(function (){
			$("#textPattern").val($(this).attr("title"));
			onMatch();
		});
		$('#myModal').on('show.bs.modal', function () {


			var pattern = $("#textPattern").val();
			if (!pattern) {
				$("#alert-message").html("你还没输入正则表达式").show();
			} else {
				$("#alert-message").hide();
			}
			var prelist = $("#languagelist pre");
			for (var i = 0; i < prelist.length; i++) { 
				var pre = $(prelist[i]);
				var language = pre.attr("id");
				if (language == 'go' || language == 'java') {
					pattern2 = pattern.replace(/\\/gi, "\\\\");
					pre.html(languageCode[language].format(pattern2, ""));
				} else {
					pre.html(languageCode[language].format(pattern, ""));
				}

			}
		});
	});
</script>
<?php include '../../footer.php';?>
