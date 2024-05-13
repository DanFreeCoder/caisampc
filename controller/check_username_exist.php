<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);

$users->username = $_POST['username'];
$res = $users->check_username();

echo ($res->rowCount() > 0) ? 1 : 0;
