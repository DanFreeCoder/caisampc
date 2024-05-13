<?php
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$user = new Users($db);


$user->status = 1;
$user->id = $_POST['id'];
$res = $user->upd_stat();

echo ($res) ? 1 : 0;
