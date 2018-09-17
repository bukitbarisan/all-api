<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
function uablock($USER_AGENT) {
	$crawlers_agents = 'Slurp|Google|GoogleBot|Googlebot|msnbot|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby|Twitterbot|Baiduspider|MetaURI|facebookexternalhit|FlipboardProxy|mediawords|DuckDuckBot|YandexBot|Sogou Pic Spider/3.0|Sogou head spider/3.0|Sogou web spider/4.0|Sogou Orion spider/3.0|Sogou-Test-Spider/4.0|Exabot/3.0|Konqueror/3.5|ia_archiver
|APIs-Google|Mediapartners-Google|AdsBot-Google-Mobile|AdsBot-Google-Mobile|AdsBot-Google|Googlebot-Image|Googlebot-News|Googlebot-Video|Mediapartners-Google|AdsBot-Google-Mobile-Apps|curl';
	$crawlers = explode("|", $crawlers_agents);
	foreach($crawlers as $crawler) {
		if ( strpos($USER_AGENT, $crawler) !== false)
		return true;
	}
	return false;
}
$jembud = uablock($_GET['agents']);
if($jembud){
	//for bot
	$array = array(
		'status' => 'Success',
		'uadetect' => $_GET['agents'],
		'uablocked' => 'Yes');
	$a = json_encode($array);
	echo $a;
}else{
	//for bot
	$array = array(
		'status' => 'Success',
		'uadetect' => $_GET['agents'],
		'uablocked' => 'No');
	$b = json_encode($array);
	echo $b;	
}
?>