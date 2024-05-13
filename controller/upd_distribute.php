<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

$distribute->descriptions = $_POST['descriptions'];
$distribute->date_update = date('Y-m-d');
$distribute->id = $_POST['id'];
$result = $distribute->upd_distribute();

echo ($result) ? 1 : 0;
