<?php
session_start();
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$login = new Users($db);
$pepper = 'ciaco@2023';
$secretKey = '6LfVYmUpAAAAABmoy9LmcvWDwk9hGWTypIN_lQdr'; //server-side secret key
$recaptchaResponse = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
$responseKeys = json_decode($response, true);

// if captcha satisfy then check login 
if ($responseKeys['success']) {
    $login->username = $_POST['username'];
    $log = $login->Login();
    if ($log->rowcount() > 0) {
        while ($row = $log->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($pepper . $_POST['password'], $row['password'])) {
                // set user details to global variable as session variable
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['fullname'] = $row['firstname'] . ' ' . $row['lastname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['contact_no'] = $row['contact_no'];
                $_SESSION['reason'] = $row['reason'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['id'] = $row['id'];

                if ($row['role'] != $_POST['role']) { //check who is logging in
                    header('Location: ./logout.php');
                } else {
                    echo 1;
                }
            } else {
                echo 0;
            }
        }
    } else {
        echo 0;
    }
} else {
    echo 2;
}
