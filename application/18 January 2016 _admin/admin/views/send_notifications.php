<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$APPLICATION_ID = "DR56Bh7MHRwspVPV9bPDd0W9eJKgpefuLX1qv7sG";
$REST_API_KEY = "St1B2rIs1utA3THHidRxy0sVqapKTDt6Z43pktYu";


$url = 'https://api.parse.com/1/push';
$data = '{"channel":"","data":{ "alert":"Red Sox win 7-0!"}}';
 
$opts = array('http' =>
 array(
  'method'  => 'POST',
  'header'  => "X-Parse-Application-Id: '$APPLICATION_ID'\r\n
      X-Parse-REST-API-Key: '$REST_API_KEY'\r\n
      Content-Type: application/json\r\n
      Content-Length: " . strlen($data) . "\r\n",
  'content' => $data
 )
);
 
$context  = stream_context_create($opts); 
$result = file_get_contents($url, false, $context);
echo $result;


/*$url = 'https://api.parse.com/1/push';

$data = array(
    'data' => array(
        'alert' => 'Test Push'
    ),
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
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($curl);

  var_dump($response); */
?>