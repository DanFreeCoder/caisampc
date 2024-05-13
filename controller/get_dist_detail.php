<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);

$distribute->id = $_POST['id'];
$result = $distribute->distribution_detail();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $image = $row['image'];
    $description = $row['descriptions'];
    $id = $row['id'];
    $status = $row['status'];

    $array = array($image, $description, $id, $status);
}
echo json_encode($array);
