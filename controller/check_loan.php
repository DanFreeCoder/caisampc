<?php
session_start();
include '../config/connection.php';
include '../objects/clsLoans.php';
$database = new Connection();
$db = $database->connect();

$loan = new clsLoanDetails($db);


$loan->name = $_POST['name'];
$loan->gender = $_POST['gender'];
$loan->occupation = $_POST['occupation'];
$loan->date_of_birth = date('Y-m-d', strtotime($_POST['date_of_birth']));
$loan->civil_status = $_POST['status'];
$loan->dependents = $_POST['dependents'];
$loan->address = $_POST['address'];
$loan->contact = $_POST['contact'];
$loan->spouse = $_POST['spouse'];
$loan->spouse_occu = $_POST['spouse_occu'];
$loan->gross = $_POST['gross'];
$loan->expenses = $_POST['expenses'];
$loan->net = $_POST['net'];
$loan->date_applied = date('Y-m-d', strtotime($_POST['date_applied']));
$loan->date_needed = date('Y-m-d', strtotime($_POST['date_needed']));
$loan->amount_applied = $_POST['amount_applied'];
$loan->purpose = $_POST['purpose'];
$loan->type = $_POST['type'];
$loan->mode = $_POST['mode'];
$loan->others = $_POST['others'];
$loan->kind = $_POST['kind'];
$loan->tct = $_POST['tct'];
$loan->area = $_POST['area'];
$loan->co_maker1 = $_POST['co_maker1'];
$loan->stock1 = $_POST['stock1'];
$loan->co_maker2 = $_POST['co_maker2'];
$loan->stock2 = $_POST['stock2'];
$loan->submit_by = $_SESSION['id'];
$check = $loan->check_loan();

if ($check->rowCount() > 0) {
    echo 1;
} else {
    echo 0;
}
