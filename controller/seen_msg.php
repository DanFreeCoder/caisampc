<?php
include '../config/connection.php';
include '../objects/clsMessages.php';
$database = new Connection();
$db = $database->connect();

$seen = new Message($db);

$seen->status = 2; //seen message status
$seen->reciever_id = $_POST['id'];
$res = $seen->update_message_status();

echo ($res) ? 1 : 0; //return 1 if execution is true, 0 if false
