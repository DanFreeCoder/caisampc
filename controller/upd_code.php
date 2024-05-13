<?php
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$user = new Users($db);


$user->mycode = $_POST['mycode'];
$user->contact_no = $_POST['number'];
$res = $user->upd_code();

echo ($res) ? 1 : 0;
