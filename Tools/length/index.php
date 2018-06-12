<?php
$id = '41';
include '../../header.php';
?>
<script language="javascript" type="text/javascript">
	function LENGTH_MEASURES() {
		this.mKilometer = 1000;
		this.mMeter = 1;
		this.mDecimeter = 0.1;
		this.mCentimeter = 0.01;
		this.mMillimeter = 0.001;
		this.mDecimillimetre = 0.00001;
		this.mMicronmeter = 0.000001;
		this.nMicronmeter = 0.000000001;
		this.mLimeter = 500;
		this.mZhangmeter = 10 / 3;
		this.mChimeter = 1 / 3;
		this.mCunmeter = 1 / 30;
		this.mFenmeter = 1 / 300;
		this.mmLimeter = 1 / 3000;
		this.engFoot = 0.3048;
		this.engMile = 5280 * this.engFoot;
		this.engFurlong = 660 * this.engFoot;
		this.engYard = 3 * this.engFoot;
		this.engInch = this.engFoot / 12;
		this.nautMile = 1852;
		this.nautFathom = 6 * this.engFoot;
	}
	var length_data = new LENGTH_MEASURES();
	function checkNum(str) {
		for (var i = 0; i < str.length; i++) {
			var ch = str.substring(i, i + 1);
			if (ch != "." && ch != "+" && ch != "-" && ch != "e" && ch != "E" && (ch < "0" || ch > "9")) {
				alert("请输入有效的数字");
				return false;
			}
		}
		return true;
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
		resetValues(form, length_data);
	}
</script>
<style>
tr td{padding: 0px 5px 0px 5px;}
</style>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">在线长度换算器</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<form action="">
					<div class="form-group">
						<label class="col-sm-3 control-label">公里(km)</label>
						<div class="col-sm-5">
							<input name=mKilometer size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mKilometer.value)) compute(this.form,mKilometer.name,length_data)" type=button value="换算" class="btn btn-default" name=mKilometer_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">米(m)</label>
						<div class="col-sm-5">
							<input name=mMeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mMeter.value)) compute(this.form,mMeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mMeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">分米(dm)</label>
						<div class="col-sm-5">
							<input name=mDecimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mDecimeter.value)) compute(this.form,mDecimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mDecimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">厘米(cm)</label>
						<div class="col-sm-5">
							<input name=mCentimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mCentimeter.value)) compute(this.form,mCentimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mCentimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">毫米(mm)</label>
						<div class="col-sm-5">
							<input name=mMillimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mMillimeter.value)) compute(this.form,mMillimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mMillimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">丝(dmm)</label>
						<div class="col-sm-5">
							<input name=mDecimillimetre size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mDecimillimetre.value)) compute(this.form,mDecimillimetre.name,length_data)" type=button value="换算" class="btn btn-default" name=mDecimillimetre_bt>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">微米(um)</label>
						<div class="col-sm-5">
							<input name=mMicronmeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mMicronmeter.value)) compute(this.form,mMicronmeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mMicronmeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">里</label>
						<div class="col-sm-5">
							<input name=mLimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mLimeter.value)) compute(this.form,mLimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mLimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">丈</label>
						<div class="col-sm-5">
							<input name=mZhangmeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mZhangmeter.value)) compute(this.form,mZhangmeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mZhangmeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">尺</label>
						<div class="col-sm-5">
							<input name=mChimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mChimeter.value)) compute(this.form,mChimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mChimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">寸</label>
						<div class="col-sm-5">
							<input name=mCunmeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mCunmeter.value)) compute(this.form,mCunmeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mCunmeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">分</label>
						<div class="col-sm-5">
							<input name=mFenmeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mFenmeter.value)) compute(this.form,mFenmeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mFenmeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">厘</label>
						<div class="col-sm-5">
							<input name=mmLimeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(mmLimeter.value)) compute(this.form,mmLimeter.name,length_data)" type=button value="换算" class="btn btn-default" name=mmLimeter_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">海里(nmi)</label>
						<div class="col-sm-5">
							<input name=nautMile size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(nautMile.value)) compute(this.form,nautMile.name,length_data)" type=button value="换算" class="btn btn-default" name=nautMile_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">英寻</label>
						<div class="col-sm-5">
							<input name=nautFathom size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(nautFathom.value)) compute(this.form,nautFathom.name,length_data)" type=button value="换算" class="btn btn-default" name=nautFathom_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">英里(mi)</label>
						<div class="col-sm-5">
							<input name=engMile size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(engMile.value)) compute(this.form,engMile.name,length_data)" type=button value="换算" class="btn btn-default" name=engMile_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">弗隆(fur)</label>
						<div class="col-sm-5">
							<input name=engFurlong size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(engFurlong.value)) compute(this.form,engFurlong.name,length_data)" type=button value="换算" class="btn btn-default" name=engFurlong_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">码(yd)</label>
						<div class="col-sm-5">
							<input name=engYard size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(engYard.value)) compute(this.form,engYard.name,length_data)" type=button value="换算" class="btn btn-default" name=engYard_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">英尺(ft)</label>
						<div class="col-sm-5">
							<input name=engFoot size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(engFoot.value)) compute(this.form,engFoot.name,length_data)" type=button value="换算" class="btn btn-default" name=engFoot_bt>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">英寸(in)</label>
						<div class="col-sm-5">
							<input name=engInch size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(engInch.value)) compute(this.form,engInch.name,length_data)" type=button value="换算" class="btn btn-default" name=engInch_bt>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">纳米(nm)</label>
						<div class="col-sm-5">
							<input name=nMicronmeter size="15" class="form-control">
						</div>
						<div class="col-sm-4">
							<input onClick="if (checkNum(nMicronmeter.value)) compute(this.form,nMicronmeter.name,length_data)" type=button value="换算" class="btn btn-default" name=nMicronmeter_bt>
						</div>
					</div>

					<div align="right"><input onClick=resetAll(this.form) type=button value="数据重置" name=res7 class="btn btn-success"></div>
				</form>
			</div>
		</div>
	</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">工具简介</h3>
	</div>
	<div class="panel-body">
		<p>长度换算器：可实现在线公里(km)、米(m)、分米(dm)、厘米(cm)、里、丈、尺、寸、分、厘、海里(nmi)、英寻、英里、弗隆(fur)、码(yd)、英尺(ft)、英寸(in)、毫米(mm)、微米(um)间的互转互换。</p>
	</div>
</div>
</div>

<?php include '../../footer.php';?>