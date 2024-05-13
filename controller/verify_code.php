<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();
$verify = new Users($db);

$verify->mycode = $_POST['code'];
$verify->contact_no = $_POST['number'];
$res = $verify->verify_code();

echo ($res->rowcount() > 0) ? 1 : 0;
