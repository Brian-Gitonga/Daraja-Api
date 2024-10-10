<?php
require_once ('access_token.php');

//$accessToken = 'PXUIAmYcOEBLAA54EGI5KNGYr9fd'; // 

// M-PESA credentials
$shortcode = '174379';
$passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2b89b5b4b5675b5bd5e0e12c79857da1'; //
$timestamp = date('YmdHis'); // Current timestamp

// Generate password
$password = base64_encode($shortcode . $passkey . $timestamp);

// STK Push request data
$stkPushData = array(
    'BusinessShortCode' => $shortcode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => '1', // Amount to be paid
    'PartyA' => '254114669532',
    'PartyB' => $shortcode,
    'PhoneNumber' => '254114669532',
    'CallBackURL' => 'https://mydomain.com/path',
    'AccountReference' => 'Test',
    'TransactionDesc' => 'Test'
);


$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accessToken
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($stkPushData));


$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}

// Print response
echo $response;
/*
curl_close($curl);
?>
*/
