<?php
$id = '42';
include '../../header.php';
?>
<script>
	function WEIGHT_MEASURES() {
		this.mTon = 1000;
		this.mKilogram = 1;
		this.mGram = 0.001;
		this.mMilligram = 0.000001;
		this.cJin = 0.5;
		this.cDan = 50;
		this.cLiang = 0.05;
		this.cQian = 0.005;
		this.avdpPound = 0.45359237;
		this.briTon = 2240 * this.avdpPound;
		this.usTon = 2000 * this.avdpPound;
		this.briCWT = 112 * this.avdpPound;
		this.usCWT = 100 * this.avdpPound;
		this.briStone = 14 * this.avdpPound;
		this.avdpOunce = this.avdpPound / 16;
		this.avdpDram = this.avdpPound / 256;
		this.avdpGrain = this.avdpPound / 7000;
		this.troyPound = 5760 * this.avdpGrain;
		this.troyOunce = 480 * this.avdpGrain;
		this.troyDWT = 24 * this.avdpGrain;
		this.troyGrain = this.avdpGrain;
	}
	var weight_data = new WEIGHT_MEASURES();
	function checkNum(str) {
		for (var i = 0; i < str.length; i++) {
			var ch = str.substring(i, i + 1);
			if (ch != "." && ch != "+" && ch != "-" && ch != "e" && ch != "E" && (ch < "0" || ch > "9")) {
				alert("请输入有效的数字");
				return false;
			}
		}
		return true
	}
	function normalize(what, digits) {
		var str = "" + what;
		var pp = Math.max(str.lastIndexOf("+"), str.lastIndexOf("-"));
		var idot = str.indexOf(".");
		if (idot >= 1) {
			var ee = (pp > 0) ? str.substring(pp - 1, str.length) : "";
			digits += idot;
			if (digits >= str.length) {
				return str;
			}
			if (pp > 0 && digits >= pp) {
				digits -= pp;
			}
			var c = eval(str.charAt(digits));
			var ipos = digits - 1;
			if (c >= 5) {
				while (str.charAt(ipos) == "9") {
					ipos--;
				}
				if (str.charAt(ipos) == ".") {
					var nc = eval(str.substring(0, idot)) + 1;
					if (nc == 10 && ee.length > 0) {
						nc = 1;
						ee = "e" + (eval(ee.substring(1, ee.length)) + 1);
					}
					return "" + nc + ee;
				}
				return str.substring(0, ipos) + (eval(str.charAt(ipos)) + 1) + ee;
			} else {
				var ret = str.substring(0, digits) + ee;
			}
			for (var i = 0; i < ret.length; i++) {
				if (ret.charAt(i) > "0" && ret.charAt(i) <= "9") {
					return ret;
				}
			}
			return str;
		}
		return str;
	}
	function compute(obj, val, data) {
		if (obj[val].value) {
			var uval = 0;
			uval = obj[val].value * data[val];
			if ((uval >= 0) && (obj[val].value.indexOf("-") != -1)) {
				uval = -uval;
			}
			for (var i in data) {
				obj[i].value = normalize(uval / data[i], 8);
			}
		}
	}
	function resetValues(form, data) {
		for (var i in data) {
			form[i].value = "";
		}
	}
	function resetAll(form) {
		resetValues(form, weight_data);
	}
</script>
<style>
@media screen and (min-width: 500px) {
	tr td{padding: 10px 5px 10px 5px;}
}
</style>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">重量计量计算换算</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<table>
					<tbody>
						<form action="">
							<tr>
								<td align=center colspan=6><b>公制</b><hr style="border-style: dotted;" color=#cccccc size=1 /></td>
							</tr>
							<tr>
								<td>吨</td>
								<td ><input name=mTon size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(mTon.value)) compute(this.form,mTon.name,weight_data)" type=button value="换算" class="btn btn-default" name=mTon_bt></td>
							
								<td>公斤<font style="font-size=9px;">(kg)</font></td>
								<td ><input name=mKilogram size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(mKilogram.value)) compute(this.form,mKilogram.name,weight_data)" type=button value="换算" class="btn btn-default" name=mKilogram_bt></td>
							</tr>
							<tr> 
								<td>克<font style="font-size=9px;">(g)</font></td>
								<td ><input name=mGram size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(mGram.value)) compute(this.form,mGram.name,weight_data)" type=button value="换算" class="btn btn-default" name=mGram_bt></td>
							
								<td>毫克<font style="font-size=9px;">(mg)</font></td>
								<td ><input name=mMilligram size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(mMilligram.value)) compute(this.form,mMilligram.name,weight_data)" type=button value="换算" class="btn btn-default" name=mMilligram_bt></td>
							</tr>
							<tr>
								<td align=center colspan=6><b>市制</b><hr style="border-style: dotted;" color=#cccccc size=1 /></td>
							</tr>
							<tr> 
								<td>市斤</td>
								<td ><input name=cJin size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(cJin.value)) compute(this.form,cJin.name,weight_data)" type=button value="换算" class="btn btn-default" name=cJin_bt></td>
							
								<td>担</td>
								<td ><input name=cDan size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(cDan.value)) compute(this.form,cDan.name,weight_data)" type=button value="换算" class="btn btn-default" name=cDan_bt></td>
							</tr>
							<tr> 
								<td>两</td>
								<td ><input name=cLiang size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(cLiang.value)) compute(this.form,cLiang.name,weight_data)" type=button value="换算" class="btn btn-default" name=cLiang_bt></td>
							
								<td>钱</td>
								<td ><input name=cQian size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(cQian.value)) compute(this.form,cQian.name,weight_data)" type=button value="换算" class="btn btn-default" name=cQian_bt></td>
							</tr>
							<tr>
								<td align=center colspan=6><b>金衡制</b><hr style="border-style: dotted;" color=#cccccc size=1 /></td>
							</tr>
							<tr> 
								<td>金衡磅<font style="font-size=9px;">(lb&nbsp;t)</font></td>
								<td ><input name=troyPound size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(troyPound.value)) compute(this.form,troyPound.name,weight_data)" type=button value="换算" class="btn btn-default" name=troyPound_bt></td>
							
								<td>金衡盎司<font style="font-size=9px;">(oz&nbsp;t)</font></td>
								<td ><input name=troyOunce size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(troyOunce.value)) compute(this.form,troyOunce.name,weight_data)" type=button value="换算" class="btn btn-default" name=troyOunce_bt></td>
							</tr>
							<tr> 
								<td>英钱<font style="font-size=9px;">(dwt)</font></td>
								<td ><input name=troyDWT size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(troyDWT.value)) compute(this.form,troyDWT.name,weight_data)" type=button value="换算" class="btn btn-default" name=troyDWT_bt></td>
							
								<td>金衡格令</td>
								<td ><input name=troyGrain size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(troyGrain.value)) compute(this.form,troyGrain.name,weight_data)" type=button value="换算" class="btn btn-default" name=troyGrain_bt></td>
							</tr>
							<tr>
								<td align=center colspan=6><b>常衡制</b><hr style="border-style: dotted;" color=#cccccc size=1 /></td>
							</tr>
							<tr> 
								<td>(英制)长吨</td>
								<td ><input name=briTon size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(briTon.value)) compute(this.form,briTon.name,weight_data)" type=button value="换算" class="btn btn-default" name=briTon_bt></td>
							
								<td>(美制)短吨</td>
								<td ><input name=usTon size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(usTon.value)) compute(this.form,usTon.name,weight_data)" type=button value="换算" class="btn btn-default" name=usTon_bt></td>
							</tr>
							<tr> 
								<td>英担<font style="font-size=9px;">(cwt)</font></td>
								<td ><input name=briCWT size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(briCWT.value)) compute(this.form,briCWT.name,weight_data)" type=button value="换算" class="btn btn-default" name=briCWT_bt></td>
							
								<td>美担<font style="font-size=9px;">(cwt)</font></td>
								<td ><input name=usCWT size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(usCWT.value)) compute(this.form,usCWT.name,weight_data)" type=button value="换算" class="btn btn-default" name=usCWT_bt></td>
							</tr>
							<tr> 
								<td>英石</td>
								<td ><input name=briStone size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(briStone.value)) compute(this.form,briStone.name,weight_data)" type=button value="换算" class="btn btn-default" name=briStone_bt></td>
							
								<td>磅<font style="font-size=9px;">(lb)</font></td>
								<td ><input name=avdpPound size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(avdpPound.value)) compute(this.form,avdpPound.name,weight_data)" type=button value="换算" class="btn btn-default" name=avdpPound_bt></td>
							</tr>
							<tr> 
								<td>盎司<font style="font-size=9px;">(oz)</font></td>
								<td ><input name=avdpOunce size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(avdpOunce.value)) compute(this.form,avdpOunce.name,weight_data)" type=button value="换算" class="btn btn-default" name=avdpOunce_bt></td>
							
								<td>打兰<font style="font-size=9px;">(dr)</font></td>
								<td ><input name=avdpDram size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(avdpDram.value)) compute(this.form,avdpDram.name,weight_data)" type=button value="换算" class="btn btn-default" name=avdpDram_bt></td>
							</tr>
							<tr> 
								<td>格令</td>
								<td ><input name=avdpGrain size="12" class="form-control"></td>
								<td ><input onClick="if (checkNum(avdpGrain.value)) compute(this.form,avdpGrain.name,weight_data)" type=button value="换算" class="btn btn-default" name=avdpGrain_bt></td>
								<td colspan=3 align=right><div><input onClick=resetAll(this.form) type=button value="数据重置" name=res7 class="btn btn-success"></div></td>
							</tr>
							<tr height=10><td colspan=6></td></tr>
						</form>
					</tbody> 
				</table>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">工具简介</h3>
		</div>
		<div class="panel-body">
          <li style="color:red">手机显示效果不佳，请使用电脑使用</li>
			<p>重量计量单位换算：可实现在线吨(Tonne)、公斤(Kilogram)、克(Gram)、毫克(Milligram)、市斤、担、两、钱、磅(Pound)、盎司(Ounce)、英钱(PennyWeight)、格令(Grain)、长吨(British long ton)、短吨(US short ton)、英担(British long hundredweight)、美担(US short hundredweight)、英石(Stone)、打兰(Dram)间的互转互换。</p>
		</div>
	</div>
</div>

<?php include '..footer.php';?>