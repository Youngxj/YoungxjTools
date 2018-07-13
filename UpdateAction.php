<?php
include 'function.base.php';
$CONF = require('function.config.php');
define('VERSION', $CONF['config']['VERSION']);
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');

function UpdateAction(){
    include 'Autoupdate.class.php';

    $update = new Autoupdate(APP_PATH,false);
    $update->currentVersion = VERSION;
    $update->updateUrl = 'https://api.yum6.cn/service/';
    $latest = $update->checkUpdate();
    if ($latest !== false) {
        if ($latest > $update->currentVersion) {
            if ($update->update()) {
                if($update->replaceupdate()){
                    $res=['code'=>'0000','msg'=>'更新成功，欢迎体验最新的YoungxjTools系统^_^'];
                }else{
                    $res=['code'=>'0004','msg'=>'更新文件效验失败！'];
                }
            }else {
                $res=['code'=>'0002','msg'=>'在线更新失败，请尝试手动更新！信息：'.$update->getLastError()];
            }
        }else {
            $res=['code'=>'0001','msg'=>'没有发现可用的新版本！'];
        }
    } else {
        $res=['code'=>'0003','msg'=>$update->getLastError()];
    }
    echo json_encode($res);
}
if($_POST['token']==md5(md5((int)(time()/1200)).'YoungxjTools')){
    UpdateAction();
}else{
    exit('非法请求');
}
