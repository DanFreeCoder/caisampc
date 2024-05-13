<?php
session_start();
// logout if not admin
if ($_SESSION['role'] != 2) {
    header("Location: ../../controller/logout.php");
}
include '../../config/connection.php';
include '../../objects/clsLoans.php';
include '../../objects/clsUsers.php';
include '../../objects/clsMessages.php';
include '../../objects/clsDistribution.php';

$database = new Connection();
$db = $database->connect();

$loan = new clsLoanDetails($db);
$users = new Users($db);
$message = new Message($db);
$distribute = new Distribute($db);
?>
<!-- Sidebar-->
<input type="text" id="user_status" value="<?php echo $_SESSION['status']; ?>" hidden>
<input type="text" id="user_reason" value="<?php echo $_SESSION['reason']; ?>" hidden>
<input type="text" id="session_id" value="<?php echo $_SESSION['id']; ?>" hidden>
<div class="border-end" id="sidebar-wrapper">
    <div class="sidebar-heading"><span><img src="../../ciaco.jpg" style="width:60px; border-radius:50%;"></span> <span class="text-light"><?php echo $_SESSION['firstname']; ?></span></div>
    <div class="list-group">
        <a class="list-group-item-action p-3 text-light" href="home.php" style=" text-decoration: none;"><i class="fa-solid fa-gauge-high fa-beat-fade"></i> Home</a>
        <a class="list-group-item list-group-item-action p-3 text-light" href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        <a class="list-group-item list-group-item-action p-3 text-light" href="loan.php"><i class="fa-solid fa-money-check-dollar"></i> Loan Applicant</a>
        <a class="list-group-item list-group-item-action p-3 text-light" href="message.php"><i class="fa-solid fa-message"></i> Messages <span id="msg_notif" class="position-absolute top-3 start-90 translate-middle badge rounded-pill bg-danger">

                <span class="visually-hidden">unread messages</span>
            </span></a>
        <a class=" p-3 text-light" href="#!">
            <div class="btn btn-danger" style="border-radius: 50px;" onclick="confirmLogout()"><i class="fa-solid fa-power-off"></i> Logout</div>
        </a>
    </div>
</div>
<!-- Page content wrapper-->
<div id="page-content-wrapper">
    <!-- Top navigation-->
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container-fluid mt-2 mb-2">
            <a href="#" class="btn btn-light" id="sidebarToggle">
                <h4><i class="fa-solid fa-bars" style="color:#ced6e0;"></i></h4>
            </a>
        </div>
    </nav>