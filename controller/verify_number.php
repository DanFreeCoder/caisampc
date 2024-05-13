<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();
$verify = new Users($db);


if (isset($_POST['number'])) {

    $verify->contact_no = $_POST['number'];
    $res1 = $verify->verify_number();
    while ($row = $res1->fetch(PDO::FETCH_ASSOC)) {
        $number = $row['contact_no'];
    }

    if ($res1->rowcount() > 0) {
        $verify->mycode = $_POST['veri_code'];
        $verify->contact_no = $number;
        $res = $verify->setcode();

        if ($res) {
            $array = array($_POST['veri_code'], $number);
            echo json_encode($array);
        } else {
            echo json_encode(0);
        }
    }
}
