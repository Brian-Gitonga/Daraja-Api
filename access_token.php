<?php

$consumerKey = 'bAoiO0bYMLsAHDgzGSGVMnpSAxSUuCMEfWkrrAOK1MZJNAcA';
$consumerSecret = '2idZFLPp26Du8JdF9SB3nLpKrOJO67qDIkvICkkVl7OhADTQCb0Oga5wNgzu1xQx';


$credentials = base64_encode($consumerKey . ':' . $consumerSecret);


$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

// Initialize call
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

//errors cheking
if ($response === false) {
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}

// response
$response = json_decode($response);

// Get the access token
if (isset($response->access_token)) {
    $accessToken = $response->access_token;
    echo "Access Token: " . $accessToken;
} else {
    echo "Failed to generate access token. Response: " . json_encode($response);
}

// Close call
curl_close($curl);
?>
