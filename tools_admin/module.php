<?php
function ToolsList(){
  $tools_up = new Model("tools_list");
  $tools_list = $tools_up->findall(array(),"priority desc","*");//查询多条数据
  if($tools_list){
    echo '<thead><tr><th>Id</th><th>标题</th><th>简介</th><th>关键词</th><th>地址</th><th>图片</th><th>类型</th><th>排行</th><th>更新</th></tr></thead><tbody>';
    foreach ($tools_list as $age) {
      echo '<tr class="gradeA"><td>'.$age['id'].'</td><td>'.$age['title'].'</td><td>'.$age['subtitle'].'</td><td>'.$age['keyword'].'</td><td>'.$age['tools_url'].'</td><td>'.$age['tools_img'].'</td><td>'.$age['tools_type'].'</td><td>'.$age['priority'].'</td><td><a href="tools_up.php?id='.$age['id'].'">编辑</a>/<a href="tools_list.php?domain=delete&id='.$age['id'].'">删除</a></td></tr>';
    }
    echo '</tbody>';
  }else{echo '暂时没有工具哦！';}
  if(getParam('domain') == 'delete'){
    $id = getParam('id');
	$tools_delete = $tools_up->delete(array('id'=>$id));
    if($tools_delete){
    echo '<script type="text/javascript">alert("删除成功");window.location.href="tools_list.php";</script>'; }
  } 
}

function inc(){
  $tools_up = new Model("tools_list");
  if(getParam('domain') == 'update'){
    $config = array(
      "title" => getParam('title'),
      "explains" => getParam('explains'),
      "subtitle" => getParam('subtitle'),
      "keyword" => getParam('keyword'),
      "tools_url" => getParam('tools_url'),
      "tools_img" => getParam('tools_img'),
      "tools_type" => getParam('tools_type'),
      "tools_number" => getParam('tools_number'),
      "tools_love" => getParam('tools_love'),
      "priority" => getParam('priority'),
      "type" => getParam('type'),
      "state" => getParam('state'),
    );
    $tools_ups = $tools_up->create($config);
    if($tools_ups){echo '<script type="text/javascript">alert("增加成功");window.location.href="tools_list.php";</script>'; 
                  }else{
      echo '<script type="text/javascript">alert("失败");</script>'; 
    }
  }
}

function TalkList(){
  $talk = new Model("tools_talk");
  $talk_list = $talk->findall(array(),"","*");
  if($talk_list){
    echo '<thead><tr><th>Id</th><th>name</th><th>内容</th><th>邮箱</th><th>时间</th><th>ip</th><th>审核</th></tr></thead><tbody>';
    foreach ($talk_list as $age) {
      if($age['state']){$state = '<a href="talk_list.php?domain=hide&id='.$age['id'].'">隐藏</a>';}else{$state = '<a href="talk_list.php?domain=show&id='.$age['id'].'">显示</a>';}
      echo '<tr class="gradeA"><td>'.$age['id'].'</td><td>'.$age['name'].'</td><td>'.$age['content'].'</td><td>'.$age['emails'].'</td><td>'.$age['times'].'</td><td>'.$age['ip'].'</td><td>'.$state.'/<a href="talk_list.php?domain=delete&id='.$age['id'].'">删除</a>/<a href="talk_reply.php?id='.$age['id'].'">回复</a></td></tr>';
    }
    echo '</tbody>';
  }else{echo '暂时没有留言哦！';}
  if(getParam('domain') == 'show'){
    $id = getParam('id');
	$talk_show = $talk->update(array('id'=>$id),array('state'=>'1'));
    if($talk_show){
    echo '<script type="text/javascript">alert("显示成功");window.location.href="talk_list.php";</script>'; }
  }
  if(getParam('domain') == 'hide'){
    $id = getParam('id');
	$talk_hide = $talk->update(array('id'=>$id),array('state'=>'0'));
    if($talk_hide){
    echo '<script type="text/javascript">alert("隐藏成功");window.location.href="talk_list.php";</script>'; }
  }
  if(getParam('domain') == 'delete'){
    $id = getParam('id');
	$talk_delete = $talk->delete(array('id'=>$id));
    if($talk_delete){
    echo '<script type="text/javascript">alert("删除成功");window.location.href="talk_list.php";</script>'; }
  } 
}

function LogList(){
  $time_log = new Model("tools_log");
  $log_list = $time_log->findall(array(),"id desc","*");//查询多条数据
  if($log_list){
    echo '<thead><tr><th>Id</th><th>用户</th><th>内容</th><th>时间</th><th>操作</th></tr></thead><tbody>';
    foreach ($log_list as $age) {
      echo '<tr class="gradeA"><td>'.$age['id'].'</td><td>'.$age['user'].'</td><td>'.$age['content'].'</td><td>'.$age['time'].'</td><td><a href="log_up.php?id='.$age['id'].'">编辑</a>/<a href="log_list.php?domain=delete&id='.$age['id'].'">删除</a></td></tr>';
    }
    echo '</tbody>';
  }else{echo '暂时没有时间轴哦！';}
  if(getParam('domain') == 'delete'){
    $id = getParam('id');
	$log_delete = $time_log->delete(array('id'=>$id));
    if($log_delete){
    echo '<script type="text/javascript">alert("删除成功");window.location.href="log_list.php";</script>'; }
  }
}

function log_inc(){
  $log_up = new Model("tools_log");
  if(getParam('domain') == 'update'){
    $config = array(
      "user" => getParam('user'),
      "content" => getParam('content'),
      "time" => date('Y-m-d H:i:s'),
      "state" => getParam('state'),
    );
    $log_ups = $log_up->create($config);
    if($log_ups){echo '<script type="text/javascript">alert("增加成功");window.location.href="log_list.php";</script>'; 
                  }else{
      echo '<script type="text/javascript">alert("失败");</script>'; 
    }
  }
}

function LinksList(){
  $links_up = new Model("tools_links");
  $links_list = $links_up->findall(array(),"priority desc","*");//查询多条数据
  if($links_list){
    echo '<thead><tr><th>Id</th><th>标题</th><th>地址</th><th>描述</th><th>状态</th><th>排行</th><th>类型</th></tr></thead><tbody>';
    foreach ($links_list as $age) {
      if($age['type']=='1'){
      	$type = '导航';
      }else{
      	$type = "友链";
      }
      echo '<tr class="gradeA"><td>'.$age['id'].'</td><td>'.$age['name'].'</td><td>'.$age['url'].'</td><td>'.$age['description'].'</td><td>'.$age['state'].'</td><td>'.$age['priority'].'</td><td>'.$type.'</td><td><a href="links_up.php?id='.$age['id'].'">编辑</a>/<a href="links_list.php?domain=delete&id='.$age['id'].'">删除</a></td></tr>';
    }
    echo '</tbody>';
  }else{echo '暂时没有友链哦！';}
  if(getParam('domain') == 'delete'){
    $id = getParam('id');
	$links_delete = $links_up->delete(array('id'=>$id));
    if($links_delete){
    echo '<script type="text/javascript">alert("删除成功");window.location.href="links_list.php";</script>'; }
  } 
}

function links_inc(){
  $links_up = new Model("tools_links");
  if(getParam('domain') == 'update'){
    $config = array(
      "name" => getParam('name'),
      "description" => getParam('description'),
      "url" => getParam('url'),
      "priority" => getParam('priority'),
      "state" => getParam('state'),
      "type" => getParam('type'),
    );
    $links_ups = $links_up->create($config);
    if($links_ups){echo '<script type="text/javascript">alert("增加成功");window.location.href="links_list.php";</script>'; 
                  }else{
      echo '<script type="text/javascript">alert("失败,有可能是你的内容未更改");</script>'; 
    }
  }
}