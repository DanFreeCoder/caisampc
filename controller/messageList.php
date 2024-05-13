<?php
session_start();
include '../config/connection.php';
include '../objects/clsUsers.php';
include '../objects/clsMessages.php';

$database = new connection();
$db = $database->connect();

$message = new Message($db);
$users = new Users($db);


// get the convo of who logined
$res = $message->get_convo_with();
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

    $last_message = $row['last_message'];

    $message_id = $row['id'];
    $sender_name = '';
    $image = '';
    $users->id = ($row['sender'] != $_SESSION['id']) ? $row['sender'] : $row['reciever'];
    $res2 = $users->get_all_userby_id();
    while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
        $sender_name = $row2['firstname'] . ' ' . $row2['lastname'];
        $image = $row2['image'];
    }

    // get only the message who logined are envolved
    if ($row['sender'] == $_SESSION['id'] || $row['reciever'] == $_SESSION['id']) {
        echo '
            <div class="content">
            <a href="#" class="row g-0 mt-3 mb-0 card" style=" margin:auto; height: 80px; width:90%; text-decoration:none;">
                    <div class="input-group">
                        <span class="input-group-text"><img src="' . $image . '" alt="" style="height: 60px; width:60px;" class="rounded-circle"></span>
                        <textarea class="form-control textarea" aria-label="With textarea" disabled>' . $last_message . '</textarea>
                    </div>
            </a>
            <span class="text-secondary" style="margin-left:60px;">' . $sender_name . '</span> <a href="#" value="' . $message_id . '" class="msg_id">' . date('M-d-Y ', strtotime($row['last_sent'])) . '</a>
            </div>
            ';
    }
}
