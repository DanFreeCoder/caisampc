<?php
include '../config/connection.php';
include '../objects/clsLoans.php';
include '../objects/clsUsers.php';
include '../objects/clsDistribution.php';

$database = new Connection();
$db = $database->connect();

$report = new clsLoanDetails($db);
$users = new Users($db);
$distribute = new Distribute($db);

$action = $_GET['action'];
if ($action == 'Loan') {
    $report->from = date('Y-m-d', strtotime($_POST['from']));
    $report->to = date('Y-m-d', strtotime($_POST['to']));
    $res = $report->report_loan();
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        if ($row['status'] == 1) {
            $status = 'For Approval';
        } elseif ($row['status'] == 2) {
            $status = 'Declined';
        } else {
            $status = 'Approved';
        }

        echo '
            <tr>
                <td>' . $row['name'] . '</td>
                <td>' . $row['address'] . '</td>
                <td>' . $row['occupation'] . '</td>
                <td>' . $row['kind'] . '</td>
                <td>' . $row['amount_applied'] . '</td>
                <td>' . $status . '</td>
            </tr>
        ';
    }
} else {
    $distribute->from = date('Y-m-d', strtotime($_POST['from2']));
    $distribute->to = date('Y-m-d', strtotime($_POST['to2']));
    $res3 = $distribute->report_distribution();
    while ($row3 = $res3->fetch(PDO::FETCH_ASSOC)) {
        $date_distributed = date('M-d-Y', strtotime($row3['date_added']));
        $descriptions = $row3['descriptions'];
        $dis_by = $row3['user_id'];

        //get the name of distributer name
        $users->id = $dis_by;
        $res2 = $users->get_all_userby_id();
        while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
            $distribute_by = $row2['firstname'] . ' ' . $row2['lastname'];
        }
        echo '
            <tr>
                <td>' . $date_distributed . '</td>
                <td style="word-wrap: break-word; word-break: break-all; white-space: normal; width:80%;">' . $descriptions . '</td>
                <td><a href="#" value="' . $row3['id'] . '" class="distributed_to">View</a></td>
            </tr>
    ';
    }
}
