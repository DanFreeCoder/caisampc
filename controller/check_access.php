<?php
session_start();
// check role of user
switch (true) {
    case $_SESSION['role'] == 1:
        header("Location: ../pages/admin/dashboard.php");
        break;
    case $_SESSION['role'] == 2:
        header("Location: ../pages/client/home.php");
        break;
    default:
        header("Location: ../login.php");
}
