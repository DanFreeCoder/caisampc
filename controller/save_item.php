<?php
session_start();
include '../config/connection.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

$distribute->user_id = $_SESSION['id'];
$distribute->dist_id = $_POST['lastId'];
$distribute->user_to = $_POST['user_to'];
$distribute->status = 1;
$res = $distribute->save_item();
if ($res) {


    $distribute->id = $_POST['user_to'];
    $res2 = $distribute->get_number();
    while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
        $contact_no = $row2['contact_no'];
        $firstname = $row2['firstname'];
    }

    $array = array($contact_no, $firstname);
    echo json_encode($array);
}
