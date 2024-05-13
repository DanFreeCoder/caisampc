<?php
session_start();
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);

$module = $_GET['module'];

switch ($module) {
    case 'with_pass':
        $salt = random_bytes(16);
        $combinedPassword = $_POST['upd_password'] . $salt;
        $hashPassword = hash('sha256', $combinedPassword);

        $users->firstname = $_POST['upd_firstname'];
        $users->middle_name = $_POST['upd_middle_name'];
        $users->lastname = $_POST['upd_lastname'];
        // $users->email = $_POST['upd_email'];
        $users->username = $_POST['upd_username'];
        $users->password =  $hashPassword;
        $users->salt =  $salt;
        $users->contact_no = $_POST['upd_contact_no'];
        $users->role = $_POST['role'];
        $users->id = $_POST['id'];
        $res = $users->update_account_withPass();
        echo ($res) ? 1 : 0;
        break;
    case 'without_pass':
        $users->firstname = $_POST['upd_firstname'];
        $users->middle_name = $_POST['upd_middle_name'];
        $users->lastname = $_POST['upd_lastname'];
        // $users->email = $_POST['upd_email'];
        $users->username = $_POST['upd_username'];
        $users->contact_no = $_POST['upd_contact_no'];
        $users->role = $_POST['role'];
        $users->id = $_POST['id'];
        $res = $users->update_account_withoutPass();

        echo ($res) ? 1 : 0;
        break;
    default:
        echo 0;
}
