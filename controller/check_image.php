<?php
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$users = new Users($db);

//uploading the attached image
$file = $_FILES['files']['name'];
$path = 'home/caisampccapstone/caisampc/upload' . $file;

$users->image = $path;
$check = $users->check_image_exist();

echo ($check->rowcount() > 0) ? 1 : 0; //echo 1 if image is exist else zero
