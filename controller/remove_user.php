<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);

//update user status to zero
$users->status = 0;
$users->id = $_POST['id'];
$remove = $users->remove_user();

echo ($remove) ? 1 : 0;
