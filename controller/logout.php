<?php

include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new Connection();
$db = $database->connect();

$logout = new Users($db);

// unset session and logout
$logout->logout();
if ($logout) {
    header("Location:../index.php");
}
