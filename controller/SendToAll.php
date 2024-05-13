<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);
$distribute = new Distribute($db);

$users->role = 1;
$res2 = $users->get_allValid_user();
while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {

    $distribute->id = $row2['id'];
    $res4 = $distribute->get_number();
    while ($row3 = $res4->fetch(PDO::FETCH_ASSOC)) {
        $contact_no = $row3['contact_no'];
    }

    $ch = curl_init();

    if ($ch === false) {
        die('Failed to initialize cURL');
    }
    $body = $_POST['message'];
    $to = $contact_no;

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
}
