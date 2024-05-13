<?php
include '../config/Connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$users = new Users($db);

//uploading the attached image
$file = $_FILES['files']['name'];
$path = '../upload/' . $file;
$temp = $_FILES['files']['tmp_name'];
$name = $_FILES['files']['name'];
$uploadStat = 1;

//if file is ready for upload
if ($uploadStat == 1) {
    if (move_uploaded_file($temp, $path)) {
        $id = $_GET['id'];
        $users->image = "../upload/" . $file;
        $users->id = $id;
        $save = $users->insert_image();

        if ($save) //update the database 
        {
            echo 1;
        } else {
            echo 0;
        }
    }  
}
