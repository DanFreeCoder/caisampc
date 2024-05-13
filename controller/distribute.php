<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

$distribute->user_id = $_POST['user_id'];
$distribute->descriptions = $_POST['desc'];
$distribute->type = $_POST['type'];
date_default_timezone_set('Asia/Manila');
$distribute->date_added = date('Y-m-d');
$distribute->status = 1;
$res = $distribute->save_distribution();


$get_id = $distribute->get_last_id();
while ($row = $get_id->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
}

echo ($res) ? $id : 0;
