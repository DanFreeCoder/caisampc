<?php
if (isset($_POST['message']) && isset($_POST['user_number'])) {

    $body = $_POST['message'];
    $to = $_POST['user_number'];

    $ch = curl_init();

    if ($ch === false) {
        die('Failed to initialize cURL');
    }

    $parameters = array(
        'apikey' => 'ad7b2742d42ec0cd804f680f656847f3', // Your API KEY
        'number' => $to,
        'message' => $body,
        'sendername' => 'CICCO'
    );

    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disabled SSL verifier

    $output = curl_exec($ch);

    if ($output === false) {
        echo 'cURL error: ' . curl_error($ch);
    }

    curl_close($ch);

    echo ($output) ? 1 : 0;
} else {
    echo 0;
}
