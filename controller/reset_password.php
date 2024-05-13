<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$reset = new Users($db);

$salt = random_bytes(16);
$combinedPassword = $_POST['password'] . $salt;
$hashPassword = hash('sha256', $combinedPassword);


$reset->password = $hashPassword;
$reset->salt = $salt;
$reset->mycode = $_POST['code'];
$res = $reset->reset_password();

echo ($res) ? 1 : 0;
