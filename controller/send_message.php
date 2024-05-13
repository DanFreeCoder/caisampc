<?php
session_start();
include '../config/connection.php';
include '../objects/clsMessages.php';
$database = new Connection();
$db = $database->connect();

$message = new Message($db);

//check if this sender have convo with this reciever
$message->sender = $_SESSION['id'];
$message->reciever = $_POST['user_to'];
$check = $message->get_msg_detail();

while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
}


// if no convo then send for new 
if ($check->rowcount() == 0) {
    $message->sender = $_SESSION['id'];
    $message->reciever = $_POST['user_to'];
    $message->last_message = $_POST['message'];
    $message->last_sent = date('Y-m-d H:i:s');
    $message->status = 1;

    $detail = $message->send_to();

    $message->sender = $_SESSION['id'];
    $message->reciever = $_POST['user_to'];
    $res = $message->msg_id();
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $message_id = $row['id'];
    }

    $message->message_id = $message_id;
    $message->sender_id = $_SESSION['id'];
    $message->reciever_id = $_POST['user_to'];
    $message->message = $_POST['message'];
    $message->status = 1;
    $send = $message->send_message();

    echo ($send) ? 1 : 0;
} else {
    // if already have a convo then add this message to a convo

    // update last sent message
    $message->last_sent = date('Y-m-d H:i:s');
    $message->last_message = $_POST['message'];
    $message->sender = $_POST['user_from'];
    $message->reciever = $_POST['user_to'];
    $message->id = $id;
    $update = $message->update_date_last_convo();

    if ($update) {
        $message->message_id = $id;
        $message->sender_id = $_POST['user_from'];
        $message->reciever_id = $_POST['user_to'];
        $message->message = $_POST['message'];
        $message->status = 1;
        $send = $message->send_message();

        echo ($send) ? 1 : 0;
    }
}
