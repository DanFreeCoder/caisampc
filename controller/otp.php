<?php

$ch = curl_init();

$account_sid = 'AC216405f17cd769b02354e4ed92f5faa2';
$auth_token = '81b7560c6d49799604b1404d25acad64';
$twilio_number = '+16466795804';

$verification_code = rand(1000, 9999); // Generate a random 4-digit code

$recipient_number = '09565705461'; // The recipient's phone number

// Set up the data payload for the Twilio API request
$data = [
    'To' => $recipient_number,
    'From' => $twilio_number,
    'Body' => "Your OTP verification code is: $verification_code"
];

$url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Messages.json";

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//disabled SSL verifier

$response = curl_exec($ch);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Handle the Twilio API response
    echo 'OTP sent successfully!';
}

curl_close($ch);
