<?php
function getspider($useragent=''){
	if(CC_Defender==2)return false;
	if(!$useragent){$useragent = $_SERVER['HTTP_USER_AGENT'];}
	$useragent=strtolower($useragent);
	if (strpos($useragent, 'baiduspider') !== false){return 'baiduspider';}
	if (strpos($useragent, 'googlebot') !== false){return 'googlebot';}
	if (strpos($useragent, 'soso') !== false){return 'soso';}
	if (strpos($useragent, 'bing') !== false){return 'bing';}
	if (strpos($useragent, 'yahoo') !== false){return 'yahoo';}
	if (strpos($useragent, 'sohu-search') !== false){return 'Sohubot';}
	if (strpos($useragent, 'sogou') !== false){return 'sogou';}
	if (strpos($useragent, 'youdaobot') !== false){return 'YoudaoBot';}
	if (strpos($useragent, 'yodaobot') !== false){return 'YodaoBot';}
	if (strpos($useragent, 'robozilla') !== false){return 'Robozilla';}
	if (strpos($useragent, 'msnbot') !== false){return 'msnbot';}
	if (strpos($useragent, 'lycos') !== false){return 'Lycos';}
	if (strpos($useragent, 'ia_archiver') !== false || strpos($useragent, 'iaarchiver') !== false){return 'alexa';}
	if (strpos($useragent, 'archive.org_bot') !== false){return 'Archive';} 
	if (strpos($useragent, 'robozilla') !== false){return 'Robozilla';} 
	if (strpos($useragent, 'sitebot') !== false){return 'SiteBot';} 
	if (strpos($useragent, 'mj12bot') !== false){return 'MJ12bot';} 
	if (strpos($useragent, 'gosospider') !== false){return 'gosospider';} 
	if (strpos($useragent, 'gigabot') !== false){return 'Gigabot';} 
	if (strpos($useragent, 'yrspider') !== false){return 'YRSpider';} 
	if (strpos($useragent, 'gigabot') !== false){return 'Gigabot';} 
	if (strpos($useragent, 'jikespider') !== false){return 'jikespider';} 
	if (strpos($useragent, 'addsugarspiderbot') !== false){return 'AddSugarSpiderBot';/*非常少*/} 
	if (strpos($useragent, 'testspider') !== false){return 'TestSpider';} 
	if (strpos($useragent, 'etaospider') !== false){return 'EtaoSpider';} 
	if (strpos($useragent, 'wangidspider') !== false){return 'WangIDSpider';} 
	if (strpos($useragent, 'foxspider') !== false){return 'FoxSpider';} 
	if (strpos($useragent, 'docomo') !== false){return 'DoCoMo';} 
	if (strpos($useragent, 'yandexbot') !== false){return 'YandexBot';} 
	if (strpos($useragent, 'ezooms') !== false){return 'Ezooms';/*个人*/} 
	if (strpos($useragent, 'sinaweibobot') !== false){return 'SinaWeiboBot';} 
	if (strpos($useragent, 'catchbot') !== false){return 'CatchBot';} 
	if (strpos($useragent, 'surveybot') !== false){return 'SurveyBot';} 
	if (strpos($useragent, 'dotbot') !== false){return 'DotBot';} 
	if (strpos($useragent, 'purebot') !== false){return 'Purebot';} 
	if (strpos($useragent, 'ccbot') !== false){return 'CCBot';} 
	if (strpos($useragent, 'mlbot') !== false){return 'MLBot';} 
	if (strpos($useragent, 'adsbot-google') !== false){return 'AdsBot-Google';}
	if (strpos($useragent, 'ahrefsbot') !== false){return 'AhrefsBot';}
	if (strpos($useragent, 'spbot') !== false){return 'spbot';}
	if (strpos($useragent, 'augustbot') !== false){return 'AugustBot';}
	return false;
}

if($_GET['rand'] && $_SESSION['cron_session']!=$_GET['rand']){
	@header('Content-Type: text/html; charset=UTF-8');
	exit('浏览器不支持COOKIE或者不正常访问！');
}
if(!$_SESSION['cron_session'] && $nosecu!=true){
	if(!getspider()){
		$cron_session=md5(uniqid().rand(1,1000));
      	session_start();
		$_SESSION['cron_session']=$cron_session;
		exit("<script language='javascript'>window.location.href='?{$_SERVER['QUERY_STRING']}&rand={$cron_session}';</script>");
	}
}
?>