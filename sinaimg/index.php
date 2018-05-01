<?php 
$id="12";
include '../header.php';?>
<style type="text/css">
	/* Space out content a bit */
	body {
		padding-bottom: 20px;
	}

	/* Everything but the jumbotron gets side spacing for mobile first views */
	.header,
	.marketing,
	.footer {
		padding-right: 15px;
		padding-left: 15px;
	}
	/* Make the masthead heading the same height as the navigation */
	.header h3 {
		padding-bottom: 19px;
		margin-top: 0;
		margin-bottom: 0;
		line-height: 40px;
	}

	/* Custom page footer */
	.footer {
		padding-top: 19px;
		color: #777;
		border-top: 1px solid #e5e5e5;
	}

	/* Customize container */
	@media (min-width: 768px) {
		.container {
			max-width: 730px;
		}
	}
	.container-narrow > hr {
		margin: 30px 0;
	}

	/* Main marketing message and sign up button */
	.jumbotron {
		text-align: center;
		border-bottom: 1px solid #e5e5e5;
	}
	.jumbotron .btn {
		padding: 14px 24px;
		/*font-size: 21px;*/
	}

	/* Supporting marketing content */
	.marketing {
		margin: 40px 0;
	}
	.marketing p + h4 {
		margin-top: 28px;
	}

	/* Responsive: Portrait tablets and up */
	@media screen and (min-width: 768px) {
		/* Remove the padding we set earlier */
		.header,
		.marketing,
		.footer {
			padding-right: 0;
			padding-left: 0;
		}
		/* Space out the masthead */
		.header {
			margin-bottom: 30px;
		}
		/* Remove the bottom border on the jumbotron for visual effect */
		.jumbotron {
			border-bottom: 0;
		}
	}

	/*  其它 begin */
	.container {
		max-width: 1000px;
	}

	.picurl>input {
		height: 50px;
	}

	.picurl>input {
		font-size: 20px;
		text-align: center;
	}

	.picurl span {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		-webkit-touch-callout: none;
	}

	.mselector {
		display: inline-block;
	}

	.mselector>input {
		opacity: 0;
		width: 110px;
		height: 34px;
		position: absolute;
		display: inline-block;
	}

	.preview {
		display: none;
      	width:100%;
	}
	.preview p{
		word-break:break-all;
	}
	.preview>img {
		max-width: 100%;
		max-height: 450px;
	}

	textarea.form-control {
		resize: none;
		height: 188px;
	}
	/*  其它 end */


	div.message ul {
		float: left;
		padding: 0;
		width: 100%;
	}

	div.message li {
		border: solid 1px #fff;
		text-align: center;
		list-style: none;
		float: left;
		width: 22%;
		height: 200px;
		margin: 3px;
		position: relative;
	}
	.imgPreview {
		margin-top: 5%;
		max-width: 90%;
		max-height: 80%;
	}
	img {
		vertical-align: middle;
	}
	.progress {
		position: absolute;
		left: 5%;
		bottom: 5%;
		width: 90%;
		padding: 1px;
		border-radius: 3px;
		float: center;
		margin-bottom: 5px;
	}
	.bar {
		background-color: #428bca;
		display: block;
		width: 0%;
		height: 36px;
		border-radius: 3px;
		float: left;
	}
	.percent {
		position: absolute;
		height: 36px;
		display: inline-block;
		left: 2%;
		color: #fff;
	}
</style>
<div class="container clearfix">
  <div class="row row-xs">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
      <div class="page-header">
        <h3 class="text-center h3-xs"><?php echo $title;?><small class="text-capitalize"><?php echo $subtitle;?></small></h3>
      </div>
      <h5 class="text-right"><small><?php echo $explains;?></small></h5>
			<div class="page-header text-center">
				<div class="mselector">
					<input type="file" accept="image/*" multiple="">
					<button type="button" class="btn btn-primary">选择本地图片</button>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#url_upload_model">上传远程图片</button>
				</div>
				<hr/>
              	<p>图片尺寸可供选择:square、thumb150、orj360、orj480、mw690、mw1024、mw2048、small、bmiddle、large 默认为:large,请自行替换</p>
				<textarea id="url-res-txt" class="form-control" rows="5" placeholder="上传后的图片外链地址将显示在此处哦、下方会同时显示外链地址和预览图。" ></textarea>
				<div class="preview">
					<hr/>
				</div>
				<div id="url_upload_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myModalLabel">上传远程图片</h4>
							</div>
							<div class="modal-body">
								<p class="lead">请在下方输入远程图片地址~每行一个~</p>
								<textarea class="form-control" name="urls" rows="3" id="urls"></textarea>
								<p id="urlUploadNotice"></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
								<button type="button" class="btn btn-primary" onclick="url_upload();">上传</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="sinaimg.php"></script>
<?php include '../footer.php';?>