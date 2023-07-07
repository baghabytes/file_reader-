
<?php

$remote_address = $_SERVER['REMOTE_ADDR'];
$c = curl_init();
echo 'http://ip-api.com/json/'.$remote_address;
curl_setopt($c,CURLOPT_URL,'http://ip-api.com/json/'.$remote_address);
curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($c);
echo"<b>Results: </b>";
echo $result;
$x = json_decode($result);
echo $x->country;

if($x->country === 'Pakistan'){
    header('Location: result.php?q='.$result);
}
?>