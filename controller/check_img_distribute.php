<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';

$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

//uploading the attached image
$file = $_FILES['files']['name'];
$path = 'C:/wamp64/www/ciaco2.0/uploads/' . $file;

$distribute->image = $path;
$check = $distribute->check_image_exist();

echo ($check->rowcount() > 0) ? 1 : 0; //echo 1 if image is exist else zero
