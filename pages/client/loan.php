<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Loan | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
    <style>
        .container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>

<body>
    <!-- pendingModal -->
    <?php include '../pending_prompt.php'; ?>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/staff_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container-fluid mt-5">
                <h1>Application Form</h1>
                <div class="content" style="width: 80%;">
                    <div class="row">
                        <div class="col-9"><a href="newloan.php" class="card m-2" style="background-color: #44bd32; text-decoration:none;">
                                <div class="card-body text-light">
                                    <h4><i class="fa-solid fa-plus"></i> Request new loan application</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-3">
                            <a class="btn btn-success rounded-pill px-4 mt-4 mb-0" type="button" href="../../documents/LOAN-APPLICATION-FORM.docx"><i class="fa-solid fa-download"></i> Download Form</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card p-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive" id="loanTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Occupation</th>
                                    <th>Loan Kind</th>
                                    <th>Amount</th>
                                    <th>Date Needed</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // request loan of user who are logined
                                $loan->submit_by = $_SESSION['id'];
                                $res = $loan->view_submitted_loan_by_user();
                                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['status'] == 1) {
                                        $status = '<label style="color:green;"><b>For Approval</b></label>';
                                    } elseif ($row['status'] == 2) {
                                        $status = '<label style="color:red;"><b>Declined</b></label>';
                                    } else {
                                        $status = '<label style="color:green;"><b>Approved</b></label>';
                                    }
                                    $action = '<a class="btn btn-info m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-expand"></i> View Details</a>';
                                    echo '<td>' . $row['name'] . '</td>
                                          <td>' . $row['occupation'] . '</td>
                                          <td style="text-align:center">' . $row['kind'] . '</td>
                                          <td style="text-align:center">' . $row['amount_applied'] . '</td>
                                          <td style="text-align:center">' . date('Y-m-d', strtotime($row['date_needed'])) . '</td>
                                          <td style="text-align:center">' . $status . '</td>
                                          <td style="text-align:center">' . $action . '</td>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- forms -->
            <?php
            if ($_SESSION['status'] == 1) {
                include '../forms.php';
            }
            ?>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/loan.js"></script>
</body>

</html>