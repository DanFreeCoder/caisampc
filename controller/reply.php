<?php
session_start();
include '../config/connection.php';
include '../objects/clsMessages.php';
$database = new Connection();
$db = $database->connect();

$reply = new Message($db);

// update last sent details
$reply->last_sent = date('Y-m-d H:i:s');
$reply->last_message = $_POST['message'];
$reply->sender = $_SESSION['id'];
$reply->reciever = ($_POST['sender_id'] != $_SESSION['id']) ? $_POST['sender_id'] : $_POST['reciever_id'];
$reply->id = $_POST['message_id'];
$update = $reply->update_date_last_convo();

// insert convo 
$reply->message_id = $_POST['message_id'];
$reply->sender_id = $_SESSION['id'];
$reply->reciever_id = ($_POST['sender_id'] != $_SESSION['id']) ? $_POST['sender_id'] : $_POST['reciever_id'];
$reply->message = $_POST['message'];
$reply->added_at = date('Y-m-d H:i:s');
$reply->status = 1;
$res = $reply->reply_convo();

echo ($res) ? 1 : 0;
