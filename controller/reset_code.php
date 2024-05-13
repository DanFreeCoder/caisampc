<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();
$reset = new Users($db);

$reset->mycode = 0;
$reset->contact_no = ($_POST['number'] == 0) ? NULL : $_POST['number'];
$res = $reset->reset_code();

echo ($res) ? 1 : 0;
