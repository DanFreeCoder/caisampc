<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

//update distribution status to zero
$distribute->status = 0;
$distribute->id = $_POST['id'];
$remove = $distribute->remove_distribution();

echo ($remove) ? 1 : 0;
