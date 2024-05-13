<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$insert_user = new Users($db);
$pepper = 'ciaco@2023';

$secretKey = '6LfVYmUpAAAAABmoy9LmcvWDwk9hGWTypIN_lQdr'; //server-side secret key
$recaptchaResponse = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
$responseKeys = json_decode($response, true);

$insert_user->contact_no = $_POST['cnum'];
$checknum = $insert_user->check_reg_number();
if ($checknum->rowCount() == 0) {
    if ($responseKeys['success']) {
        // Concatenate pepper with plaintext password
        $hashedPassword = password_hash($pepper . $_POST['password'], PASSWORD_DEFAULT);
        $insert_user->firstname = $_POST['firstname'];
        $insert_user->middle_name = $_POST['middle_name'];
        $insert_user->lastname = $_POST['lastname'];
        $insert_user->username = $_POST['username'];
        $insert_user->password = $hashedPassword;
        $insert_user->contact_no = $_POST['cnum'];
        $insert_user->role = $_POST['role'];
        $insert_user->mycode = NULL;
        $insert_user->status = 1;

        $insert2 = $insert_user->Register();

        if ($insert2) {
            $res = $insert_user->last_reg(); // get last id of client after register
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $last_id = $row['maxId'];
            }
            $insert_user->user_id = $last_id;
            $res2 = $insert_user->insert_last_id();

            echo ($res2) ? 1 : 0; //this method is ternary operator shorthand of ifelse
        } else {
            'error';
        }
    } else {
        echo 2;
    }
} else {
    echo 5;
}
