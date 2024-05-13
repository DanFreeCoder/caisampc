<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);
$users = new Users($db);


$distribute->user_id = $_POST['user_id'];
$distribute->descriptions = $_POST['desc'];
$distribute->type = $_POST['type'];
date_default_timezone_set('Asia/Manila');
$distribute->date_added = date('Y-m-d');
$distribute->status = 1;
$res = $distribute->save_distribution();


$get_id = $distribute->get_last_id();
while ($row = $get_id->fetch(PDO::FETCH_ASSOC)) {
    $lastid = $row['id'];
}
$res3 = '';
if ($res) {
    $users->role = 1;
    $res2 = $users->get_allValid_user();
    while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
        $distribute->user_id = $_POST['user_id'];
        $distribute->dist_id = $lastid;
        $distribute->user_to = $row2['id'];
        $distribute->status = 1;
        $res3 = $distribute->save_item();

        if ($res3) {
            $distribute->id = $row2['id'];
            $res4 = $distribute->get_number();
            while ($row3 = $res4->fetch(PDO::FETCH_ASSOC)) {
                $contact_no = $row3['contact_no'];
                $firstname = $row3['firstname'];
            }

            ///////////////////////////
            $ch = curl_init();

            if ($ch === false) {
                die('Failed to initialize cURL');
            }
            $body = 'Dear ' . $firstname . ', We wanted to inform you that our administrator has just distributed a new update or information. Please take a moment to review the details as it may contain important announcements, documents, or other relevant information.<br>
            Best Regards,<br>
            CIACO';
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
            ///////////////////////////////////////////////

        }
    }

    echo ($res3) ? $lastid : 0;
}
