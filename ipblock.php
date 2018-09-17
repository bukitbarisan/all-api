<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$url = "http://proxy.mind-media.com/block/proxycheck.php?ip=".$_GET['ip'];
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($ch);
curl_close($ch);
$result = $resp;

$ana = file_get_contents('https://ipapi.co/'.$_GET['ip'].'/json');
$ini = json_decode($ana);
$dia = $ini->country_name;
$nakal = $ini->org;

if(isset($_GET['ip'])){
	$array = array(
		'status' => 'success',
		'proxy' => $result,
		'vpn' => $result,
		'country' => $dia,
		'isp' => $nakal);
	$a = json_encode($array);
	echo $a;
}
?>