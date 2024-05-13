<?php
session_start();
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$user = new Users($db);

if ($_POST['action'] == 1) { //APPROVED
    $user->status = 3;
    $user->reason = '';
    $user->id = $_POST['id'];
    $upd = $user->upd_user_status();
    //update members_data
    $user->approved_by = $_SESSION['id'];
    $user->approved_date = date('Y-m-d');
    $upd_member = $user->upd_member_status();
    echo ($upd && $upd_member) ? 1 : 0;
} elseif ($_POST['action'] == 2) { //DECLINE
    $user->status = 4;
    $user->reason = $_POST['reason'];
    $user->id = $_POST['id'];
    $upd = $user->upd_user_status();
    echo ($upd) ? 2 : 0;
} elseif ($_POST['action'] == 3) { //RE-APPLY
    $user->status = 1;
    $user->reason = '';
    $user->id = $_POST['id'];
    $upd = $user->upd_user_status();
    echo ($upd) ? 2 : 0;
} elseif ($_POST['action'] == 4) { //REMOVE
    $user->status = 0;
    $user->reason = '';
    $user->id = $_POST['id'];
    $upd = $user->upd_user_status();
    echo ($upd) ? 2 : 0;
} else { //active
    $user->status = 3;
    $user->reason = '';
    $user->id = $_POST['id'];
    $upd = $user->upd_user_status();
    echo ($upd) ? 2 : 0;
}
