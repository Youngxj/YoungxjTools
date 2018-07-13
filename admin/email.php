<?PHP
//邮件发送
$emails = new Model("tools_smtp");
$emails_val = $emails->find(array("id"=>1),"","*");
require '../function/class.smtp.php';
require '../function/class.phpmailer.php';
date_default_timezone_set('PRC');//设置邮件发送的时间，如果不设置，则会显示其他区的时间

$mail = new PHPMailer(); 

//是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
$mail->SMTPDebug = 3;

//使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
//可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
$mail->isSMTP();

//smtp需要鉴权 这个必须是true
$mail->SMTPAuth=true;

//链接qq域名邮箱的服务器地址
$mail->Host = $emails_val['host'];

//设置使用ssl加密方式登录鉴权
$mail->SMTPSecure = 'ssl';

//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
$mail->Port = $emails_val['port'];

//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名,这里为默认localhost
$mail->Hostname = 'localhost';

//设置发送的邮件的编码 可选GB2312 
$mail->CharSet = 'UTF-8';

//设置发件人姓名（昵称）可为任意内容，不影响回复(设置为qq昵称即可)
$mail->FromName = $emails_val['fromname'];

//smtp登录的账号 这里填入qq号即可
$mail->Username = $emails_val['username'];

//smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
$mail->Password = $emails_val['password'];

//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”

$mail->From = $emails_val['username'];

//邮件正文是否以html方式发送  
$mail->isHTML(true); 

//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大

