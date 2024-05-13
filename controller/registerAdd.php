
<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$insert_user = new Users($db);
$pepper = 'ciaco@2023';
// Concatenate pepper with plaintext password
$hashedPassword = password_hash($pepper . $_POST['password'], PASSWORD_DEFAULT);

$insert_user->firstname = $_POST['firstname'];
$insert_user->middle_name = $_POST['middle_name'];
$insert_user->lastname = $_POST['lastname'];
$insert_user->username = $_POST['username'];
$insert_user->password =  $hashedPassword;
$insert_user->contact_no = $_POST['cnum'];
$insert_user->role = $_POST['role'];
$insert_user->mycode = 0;
$insert_user->status = 1;

$insert = $insert_user->Register();

if ($insert) {
    $res = $insert_user->last_reg(); // get last id of client after register
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $last_id = $row['maxId'];
    }
    $insert_user->user_id = $last_id;
    $res2 = $insert_user->insert_last_id();

    echo ($res2) ? 1 : 0; //this method is ternary operator shorthand of ifelse
}
