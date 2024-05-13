<?php
// if (isset($_POST['message']) && isset($_POST['user_number'])) {
//     $TWILIO_ACCOUNT_SID = 'AC216405f17cd769b02354e4ed92f5faa2';
//     $TWILIO_AUTH_TOKEN = '81b7560c6d49799604b1404d25acad64';
//     $from = '+16466795804';
//     $body = $_POST['message'];
//     $to = '+63' . substr($_POST['user_number'], 1);

//     // Create cURL resource
//     $ch = curl_init();

//     // Set cURL options
//     curl_setopt($ch, CURLOPT_URL, "https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID/Messages.json");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
//         'From' => $from,
//         'Body' => $body,
//         'To' => $to
//     ]));
//     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//     curl_setopt($ch, CURLOPT_USERPWD, "$TWILIO_ACCOUNT_SID:$TWILIO_AUTH_TOKEN");
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disabled SSL verifier
//     // Set the user-agent or sender name in the request headers
//     $headers = array(
//         'User-Agent: CIACO Msg'
//     );
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     // Execute cURL session and get the response
//     $response = curl_exec($ch);

//     // Check for cURL errors
//     if (curl_errno($ch)) {
//         echo 'cURL error: ' . curl_error($ch);
//     }

//     // Close cURL session
//     curl_close($ch);

//     echo 1;
// } else {
//     echo 0;