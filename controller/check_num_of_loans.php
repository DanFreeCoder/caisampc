<?php
session_start();
include '../config/connection.php';
include '../objects/clsLoans.php';
$database = new Connection();
$db = $database->connect();

$loan = new clsLoanDetails($db);

$loan->submit_by = $_SESSION['id'];
$result = $loan->check_num_of_loans();
$difference = '';
$row = $result->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $lastLoanDate = DateTime::createFromFormat('Y-m-d', $row['last_loan_date']);
    if ($lastLoanDate !== false) {
        $currentDate = new DateTime();

        // Remove the time part to compare dates only
        $currentDate->setTime(0, 0, 0); // Set time to midnight
        $lastLoanDate->setTime(0, 0, 0); // Set time to midnight

        // Calculate the difference in days between the last loan date and current date
        $difference = $currentDate->diff($lastLoanDate)->format('%a');
    } else {
        $difference = 'new';
    }
}
echo $difference;
