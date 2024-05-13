<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);

$users->firstname = $_POST['firstname'];
$users->middle_name = $_POST['middle_name'];
$users->lastname = $_POST['lastname'];
$res = $users->check_fullname();

echo ($res->rowCount() > 0) ? 1 : 0;
