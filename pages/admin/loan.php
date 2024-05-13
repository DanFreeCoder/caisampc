<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Loan Applicant | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <a id="print" type="button" class="btn btn-secondary" href="#"><i class="fa-solid fa-print"></i> Print Approved Loan</a>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="forApproval-tab" data-bs-toggle="tab" data-bs-target="#forApproval-tab-pane" type="button" role="tab" aria-controls="forApproval-tab-pane" aria-selected="true">For Approval</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved-tab-pane" type="button" role="tab" aria-controls="approved-tab-pane" aria-selected="false">Approved</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="declined-tab" data-bs-toggle="tab" data-bs-target="#declined-tab-pane" type="button" role="tab" aria-controls="declined-tab-pane" aria-selected="false">Disapproved</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="forApproval-tab-pane" role="tabpanel" aria-labelledby="forApproval-tab" tabindex="0">
                                <div class="card p-3">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-striped table-hover TableData">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Name</th>
                                                    <th style="text-align:center">Occupation</th>
                                                    <th style="text-align:center">Loan Kind</th>
                                                    <th style="text-align:center">Amount</th>
                                                    <th style="text-align:center">Date Needed</th>
                                                    <th style="width: 15%; text-align:center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get all the loan request
                                                $loan->status = 1; //FOR APPROVAL
                                                $get = $loan->view_submitted_loan_bystatus();
                                                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                                    $action = '<a class="btn btn-info m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-expand"></i> View Details</a>';
                                                    echo '
                                            <tr>  
                                                    <td>' . $row['name'] . '</td>
                                                      <td>' . $row['occupation'] . '</td>
                                                      <td style="text-align:center">' . $row['kind'] . '</td>
                                                      <td style="text-align:center">' . $row['amount_applied'] . '</td>
                                                      <td style="text-align:center">' . date('Y-m-d', strtotime($row['date_needed'])) . '</td>
                                                      <td style="text-align:center">' . $action . '</td>
                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="approved-tab-pane" role="tabpanel" aria-labelledby="approved-tab" tabindex="0">
                                <div class="card p-3">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-striped table-hover TableData">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Name</th>
                                                    <th style="text-align:center">Occupation</th>
                                                    <th style="text-align:center">Loan Kind</th>
                                                    <th style="text-align:center">Amount</th>
                                                    <th style="text-align:center">Date Needed</th>
                                                    <th style="width: 15%; text-align:center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get all the loan request
                                                $loan->status = 3; // APPROVED
                                                $get = $loan->view_submitted_loan_bystatus();
                                                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                                    $action = '<a class="btn btn-info m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-expand"></i> View Details</a>';
                                                    echo '
                                            <tr>
                                                    <td>' . $row['name'] . '</td>
                                                      <td>' . $row['occupation'] . '</td>
                                                      <td style="text-align:center">' . $row['kind'] . '</td>
                                                      <td style="text-align:center">' . $row['amount_applied'] . '</td>
                                                      <td style="text-align:center">' . date('Y-m-d', strtotime($row['date_needed'])) . '</td>
                                                      <td style="text-align:center">' . $action . '</td>
                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="declined-tab-pane" role="tabpanel" aria-labelledby="declined-tab" tabindex="0">
                                <div class="card p-3">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-striped table-hover TableData">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Name</th>
                                                    <th style="text-align:center">Occupation</th>
                                                    <th style="text-align:center">Loan Kind</th>
                                                    <th style="text-align:center">Amount</th>
                                                    <th style="text-align:center">Date Needed</th>
                                                    <th style="width: 15%; text-align:center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get all the loan request
                                                $loan->status = 2; //DECLINED
                                                $get = $loan->view_submitted_loan_bystatus();
                                                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                                    $action = '<a class="btn btn-info m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-expand"></i> View Details</a>';
                                                    echo '
                                            <tr>
                                                    <td>' . $row['name'] . '</td>
                                                      <td>' . $row['occupation'] . '</td>
                                                      <td style="text-align:center">' . $row['kind'] . '</td>
                                                      <td style="text-align:center">' . $row['amount_applied'] . '</td>
                                                      <td style="text-align:center">' . date('Y-m-d', strtotime($row['date_needed'])) . '</td>
                                                      <td style="text-align:center">' . $action . '</td>
                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/loan.js"></script>
</body>

</html>