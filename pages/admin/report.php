<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title id="title">Report | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- select2 plugins -->
    <link rel="stylesheet" href="../../assets/select2/css/select2.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/datapicker/datepicker3.css">
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container mt-5">
                <h3>Summary</h3>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Loan Applicant</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Distribution</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <label>From: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="from" placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <div class="col-3">
                                <label>To: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="to" placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <div class="col-2">
                                <br>
                                <div class="btn btn-sm btn-success mt-2" id="btnreport">Generate Report</div>
                            </div>
                        </div>
                        <div class="btn btn-secondary btn-sm mt-2" id="download1" hidden>Print Report</div>
                        <h4>Loan Applicant</h4>
                        <div class="table-responsive m-1">
                            <table class="table" id="Tabledata1">
                                <thead>
                                    <tr>
                                        <th>Applicant's Name</th>
                                        <th>Address</th>
                                        <th>Occupation</th>
                                        <th>Kind of Loan</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="loan_body">
                                    <?php
                                    $res  = $loan->submitted_loan_report();
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
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <label>From: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="from2" placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <div class="col-3">
                                <label>To: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="to2" placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <div class="col-2">
                                <br>
                                <div class="btn btn-sm btn-success mt-2" id="btnreport2">Generate Report</div>
                            </div>
                        </div>
                        <div class="btn btn-secondary btn-sm mt-2" id="download2" hidden>Print Report</div>
                        <h4>Product Distributed</h4>
                        <div class="table-responsive m-1">
                            <table class="table" id="Tabledata2">
                                <thead>
                                    <tr>
                                        <th>DATE DISTRIBUTED</th>
                                        <th>DESCRIPTION</th>
                                        <th>DISTRIBUTED TO</th>
                                    </tr>
                                </thead>
                                <tbody id="distribution_body">
                                    <?php
                                    $distribute->user_id = $_SESSION['id'];
                                    $res = $distribute->distributions_report();
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $date_distributed = date('M-d-Y', strtotime($row['date_added']));
                                        $descriptions = $row['descriptions'];
                                        $dis_by = $row['user_id'];

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
                                                    <td><a href="#" value="' . $row['id'] . '" class="distributed_to">View</a></td>
                                                </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- distribute to -->
                        <div class="modal" id="distributeTo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body" id="distributeBody">
                                        <!-- distributeTo append here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/report.js"></script>
</body>

</html>