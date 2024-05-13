<?php
include '../config/connection.php';
include '../objects/clsDistribution.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$distribute = new Distribute($db);
$users = new Users($db);

// get distribute to
$distribute->dist_id = $_POST['id'];
$res = $distribute->get_distributer();
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <ul class="list-group"><li class="list-group-item">' . $row['fullname'] . '</li></ul>
    ';
}
