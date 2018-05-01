<?php
include 'header.php';
?>
			<div id="content">
				<div id="content-header" class="mini">
					<h1>主页</h1>
				</div>
				<div id="breadcrumb">
					<a href="index.php" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
				</div>
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="widget-box">
								<div class="widget-title"><span class="icon"><i class="fa fa-file"></i></span><h5>服务器信息</h5><span title="total posts" class="label label-info tip-left">0</span></div>
								<div class="widget-content nopadding">
									<ul class="recent-posts">
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av2.jpg">
											</div>
											<div class="article-post">
                                              <span class="user-info">当前IP:<p><?php echo real_ip();?></p></span>
											</div>
										</li>
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av3.jpg">
											</div>
											<div class="article-post">
                                              <span class="user-info">PHP版本:<p><?php echo PHP_VERSION;?></p></span>
											</div>
										</li>
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av1.jpg">
											</div>
											<div class="article-post">
                                              <span class="user-info">WEB版本:<p><?php echo $_SERVER["SERVER_SOFTWARE"];?></p></span>
											</div>
										</li>
                                      	<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av1.jpg">
											</div>
											<div class="article-post">
												<span class="user-info">上传支持:<p><?php echo  ini_get("allow_url_fopen") ? "支持" : "不支持"; ?></p></span>
											</div>
										</li>
										
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="widget-box">
								<div class="widget-title"><span class="icon"><i class="fa fa-comment"></i></span><h5>问候语</h5><span title="total comments" class="label label-info tip-left">0</span></div>
								<div class="widget-content nopadding">
									<ul class="recent-comments">
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av1.jpg">
											</div>
											<div class="comments">
												<span class="user-info">主人寄语:<p>愿你是那只刺猬，我予你柔软的环怀抱。</p></span>
											</div>
										</li>
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av3.jpg">
											</div>
											<div class="comments">
												<span class="user-info">主人寄语:<p>沉默是一个女孩最大的哭声。</p></span>
											</div>
										</li>
										<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av2.jpg">
											</div>
											<div class="comments">
												<span class="user-info">主人寄语:<p>总有一个人，一直住在心底，却消失在生活在生活里。</p></span>
											</div>
										</li>
                                      	<li>
											<div class="user-thumb">
												<img width="40" height="40" alt="User" src="img/demo/av2.jpg">
											</div>
											<div class="comments">
												<span class="user-info">主人寄语:<p>爱一个人，就是在漫长的时光了和他一起成长。</p></span>
											</div>
										</li>
										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
					</div>
				</div>

			</div>
<?php include 'footer.php';?>