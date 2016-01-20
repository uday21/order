<?php

$message = $_REQUEST['message'];

$APPLICATION_ID = "DR56Bh7MHRwspVPV9bPDd0W9eJKgpefuLX1qv7sG";
$REST_API_KEY = "St1B2rIs1utA3THHidRxy0sVqapKTDt6Z43pktYu";

$url = 'https://api.parse.com/1/push';

$data = array(
		  "channels" => ["SampleChannel"],
		  "data" => array("alert" => $message)
		);

$_data = json_encode($data);

$headers = array(
    'X-Parse-Application-Id: ' . $APPLICATION_ID,
    'X-Parse-REST-API-Key: ' . $REST_API_KEY,
    'Content-Type: application/json',
    'Content-Length: ' . strlen($_data),
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($curl);
echo $result;
print_r($result);
die('finished!');
?>