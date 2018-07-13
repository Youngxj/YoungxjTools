<div class="row">

</div>
</div>
<div id="footer" class="col-xs-12">
      <a href="http://www.youngxj.cn">杨小杰博客</a>当前版本：<span id="version" version="<?php echo VERSION;?>"><?php echo VERSION;?></span><a href="javascript:update();">检查最新版</a>
</div>
<script type="text/javascript">
      function update(){
            layui.use('layer', function(){
                  layer.msg('正在链接，请稍等', {
                    icon: 16
                    ,shade: 0.01
              });
            });
            $.ajax({
                  url: 'https://api.yum6.cn/service/update.php',
                  type: 'GET',
                  success :function(res) {
                        if($('#version').attr("version") < res['data']['version']){
                              layui.use('layer', function(){
                                    layer.confirm('发现新版本，是否立即更新？'+res['data']['msg'], {
                                          btn: ['是', '否', '手动更新']
                                          ,btn3: function(index, layero){
                                                window.open(res['data']['my']);
                                          }}, function(index, layero){
                                                index = layer.msg('系统正在更新，请稍待片刻...',{icon: 16,time:false});
                                                $.ajax({
                                                      url: '../UpdateAction.php',
                                                      type: 'post',
                                                      data: {token:'<?php echo md5(md5((int)(time()/1200)).'YoungxjTools');?>'},
                                                      dataType: 'json',
                                                      success: function(res){
                                                            if (res.code=='0000') {
                                                                  layer.open({title: '更新成功',icon: 6,content: res.msg}); 
                                                            }else{
                                                                  layer.open({title: '更新失败',icon: 5,content: res.msg}); 
                                                            }
                                                      }
                                                })
                                          });
                              });
                        }else{
                              layui.use('layer', function(){
                                    layer.open({title: '消息',content: '当前使用的已经是最新版本!'+res['text']});  
                              });   
                        }
                  },
                  error : function(){
                        layui.use('layer', function(){
                              layer.msg('检查更新失败，可能是网络问题造成的原因!', {icon: 5});
                        });
                  }
            });

      }
</script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery-ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/unicorn.js"></script>
<script src="js/unicorn.dashboard.js"></script>
</body>
</html>
