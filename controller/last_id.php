<?php
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$insert_user = new Users($db);

$res = $insert_user->last_reg(); // get last id of client after register
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $last_id = $row['maxId'];
}

$insert_user->id = $last_id;
$res2 = $insert_user->verify_codes();
while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
    $mycode = $row2['mycode'];
}
$array = array($mycode, $last_id);
echo json_encode($array);
