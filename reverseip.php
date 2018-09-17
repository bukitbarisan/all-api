<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$hihi = $_GET['look'];
$post = "remoteAddress=".$hihi."&key=&_=";
$socks = "socks5://149.56.23.5:64580";

$curl = curl_init();   
curl_setopt($curl, CURLOPT_URL, "https://domains.yougetsignal.com/domains.php");
$request_headers = array();
$request_headers[] = 'origin: https://www.yougetsignal.com';
$request_headers[] = 'user-agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36';
$request_headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
$request_headers[] = 'authority: domains.yougetsignal.com';
curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($curl, CURLOPT_PROXY, $socks);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
$dados = curl_exec($curl);
$deco = json_decode($dados);
$deci = $deco->status;
$deci1 = $deco->resultsMethod;
$deci2 = $deco->remoteAddress;
$deci3 = $deco->domainCount;
$deci4 = $deco->domainArray;
echo $dados;
?>