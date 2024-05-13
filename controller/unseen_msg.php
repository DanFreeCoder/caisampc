<?php
include '../config/connection.php';
include '../objects/clsMessages.php';
$database = new Connection();
$db = $database->connect();

$unseen = new Message($db);

// get total unseen message 
$unseen->reciever_id = $_POST['id'];
$res = $unseen->unseen_msg();
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $total = $row['total'];
}

echo $total;
