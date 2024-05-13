<?php
session_start();
include '../config/connection.php';
include '../objects/clsLoans.php';

$database = new Connection();
$db = $database->connect();

$loan = new clsLoanDetails($db);

if ($_POST['action'] == 1) { //APPROVED
    $loan->id = $_POST['id'];
    $loan->approve_date = date('Y-m-d');
    $loan->approve_by = $_SESSION['id'];
    $loan->reason = NULL;
    $loan->status = 3;
    $save = $loan->update_loan_stat();
    if ($save) {
        echo 1;
    } else {
        echo 0;
    }
} else { //DECLINE
    $loan->id = $_POST['id'];
    $loan->approve_date = date('Y-m-d');
    $loan->approve_by = $_SESSION['id'];
    $loan->reason = $_POST['reason'];
    $loan->status = 2;
    $save = $loan->update_loan_stat();
    if ($save) {
        echo 2;
    } else {
        echo 0;
    }
}
