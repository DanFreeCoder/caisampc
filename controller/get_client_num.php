<?php
include '../config/connection.php';
include '../objects/clsUsers.php';

$database = new connection();
$db = $database->connect();

$users = new Users($db);

$users->user_id = $_POST['client_id'];
$result = $users->get_client_no();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo $row['phone_num'];
}
