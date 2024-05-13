<?php
session_start();
include '../config/connection.php';
include '../objects/clsMessages.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$get_convo = new Message($db);
$users = new Users($db);
$data = '';
//get message by message_id
$get_convo->message_id = $_POST['message_id'];
$res = $get_convo->get_convoBy_id();
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $message = $row['message'];
    $added_at = $row['added_at'];
    $message_id = $row['message_id'];

    $get_convo->id = $_POST['message_id'];
    $res2 = $get_convo->get_last_sender();
    while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
        $sender = $row2['sender'];
    }

    $users->id = ($row['reciever_id'] == $_SESSION['id']) ? $row['sender_id'] : $row['reciever_id'];
    $res4 = $users->get_all_userby_id();
    while($row5 = $res4->fetch(PDO::FETCH_ASSOC)){
        $name = $row5['firstname'].' '. $row5['lastname'];
    }
    // this attach in modal
    if ($row['reciever_id'] == $_SESSION['id']) {
        $data .= '
        <div class="">
                <input type="text" id="msg_id" value="' . $message_id . '" hidden/>
                <input type="text" id="sndr_id" value="' . $row['sender_id'] . '" hidden/>
                <input type="text" id="rsvr_id" value="' . $row['reciever_id'] . '" hidden/>
                <p class="rounded bg-secondary text-light" style="width:fit-content; padding:3px;">' . $message . '</p>
        </div>
        ';
    } elseif ($row['sender_id'] == $_SESSION['id']) {
        $data .= '
        <div class="d-flex flex-row-reverse">
                <input type="text" id="msg_id" value="' . $message_id . '" hidden/>
                <input type="text" id="sndr_id" value="' . $row['sender_id'] . '" hidden/>
                <input type="text" id="rsvr_id" value="' . $row['reciever_id'] . '" hidden/>
                <p class="rounded bg-primary text-light" style="width:fit-content; padding:3px;">' . $message . '</p>
        </div>

        ';
    }

    $array = array($data, $name);
}

echo json_encode($array);
