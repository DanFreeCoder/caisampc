<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cooperative | CIACO</title>
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
            <div class="container mt-5">
                <h3 class="mb-3">Cooperative Members List</h3>
                <div class="btn btn-secondary btn-sm mb-3 text-light" id="print"><i class="fa-solid fa-print"></i> Print</div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="true"><i class="fa-regular fa-clock"></i> Pending</button>
                        <button class="nav-link" id="nav-pendingForApp-tab" data-bs-toggle="tab" data-bs-target="#nav-pendingForApp" type="button" role="tab" aria-controls="nav-pendingForApp" aria-selected="true"><i class="fa-regular fa-clock"></i> Pending for approval</button>
                        <button class="nav-link" id="nav-registered-tab" data-bs-toggle="tab" data-bs-target="#nav-registered" type="button" role="tab" aria-controls="nav-registered" aria-selected="false"><i class="fa-sharp fa-light fa-registered"></i> Registered</button>
                        <button class="nav-link" id="nav-declined-tab" data-bs-toggle="tab" data-bs-target="#nav-declined" type="button" role="tab" aria-controls="nav-declined" aria-selected="false"><i class="fa-regular fa-circle-xmark"></i> Declined</button>
                        <button class="nav-link" id="nav-inactive-tab" data-bs-toggle="tab" data-bs-target="#nav-inactive" type="button" role="tab" aria-controls="nav-inactive" aria-selected="false"><i class="fa-regular fa-circle-xmark"></i> Deactivated</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab" tabindex="0">
                        <div class="card p-2 mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover TableData">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Apply</th>
                                            <th>TIN No.</th>
                                            <th>Contact No.</th>
                                            <th style="width: 30%; text-align:center">Action</th>
                                        </tr>
                                    <tbody>
                                        <?php
                                        // get all aprroved or coop members
                                        $get_member = $users->get_member_pending();
                                        while ($row = $get_member->fetch(PDO::FETCH_ASSOC)) {
                                            $action = '<a class="btn btn-sm btn-primary m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-maximize"></i> View</a>';
                                            $createDate = new DateTime($row['date_apply']);
                                            $date = $createDate->format('Y-m-d');
                                            echo '<tr>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $date . '</td>
                                                <td>' . $row['tin'] . '</td>
                                                <td>' . $row['contact_no'] . '</td>
                                                <td><center>' . $action . '</center></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- pending for approval -->
                    <div class="tab-pane fade" id="nav-pendingForApp" role="tabpanel" aria-labelledby="nav-pendingForApp-tab" tabindex="0">
                        <div class="card p-2 mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover TableData">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Apply</th>
                                            <th>TIN No.</th>
                                            <th>Contact No.</th>
                                            <th style="width: 30%; text-align:center">Action</th>
                                        </tr>
                                    <tbody>
                                        <?php
                                        // get all aprroved or coop members
                                        $get_member = $users->get_member_pending_forApproval();
                                        while ($row = $get_member->fetch(PDO::FETCH_ASSOC)) {
                                            $action = '<a class="btn btn-sm btn-primary m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-maximize"></i> View</a> <a class="btn btn-success m-t-n-xs btnApprove" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-circle-check"></i> Approve</a> <a class="btn btn-sm btn-danger m-t-n-xs btnDecline" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-circle-xmark"></i> Decline</a>';
                                            $createDate = new DateTime($row['date_apply']);
                                            $date = $createDate->format('Y-m-d');
                                            echo '<tr>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $date . '</td>
                                                <td>' . $row['tin'] . '</td>
                                                <td>' . $row['contact_no'] . '</td>
                                                <td><center>' . $action . '</center></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- registered -->
                    <div class="tab-pane fade" id="nav-registered" role="tabpanel" aria-labelledby="nav-registered-tab" tabindex="0">
                        <div class="card p-2 mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover TableData">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Apply</th>
                                            <th>TIN No.</th>
                                            <th>Contact No.</th>
                                            <th style="width: 30%; text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // get all aprroved or coop members
                                        $get_member = $users->get_member_registered();
                                        while ($row = $get_member->fetch(PDO::FETCH_ASSOC)) {
                                            $action = '<a class="btn btn-sm btn-primary m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-maximize"></i> View</a> <a class="btn btn-sm btn-danger m-t-n-xs btnInActive" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-user-slash"></i> Deactivate</a>';
                                            $createDate = new DateTime($row['date_apply']);
                                            $date = $createDate->format('Y-m-d');
                                            echo '<tr>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $date . '</td>
                                                <td>' . $row['tin'] . '</td>
                                                <td>' . $row['contact_no'] . '</td>
                                                <td><center>' . $action . '</center></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- declined -->
                    <div class="tab-pane fade" id="nav-declined" role="tabpanel" aria-labelledby="nav-declined-tab" tabindex="0">
                        <div class="card p-2 mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover TableData">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Apply</th>
                                            <th>TIN No.</th>
                                            <th>Contact No.</th>
                                            <th style="width: 30%; text-align:center">Action</th>
                                        </tr>
                                    <tbody>
                                        <?php
                                        // get all aprroved or coop members
                                        $get_member = $users->get_member_declined();
                                        while ($row = $get_member->fetch(PDO::FETCH_ASSOC)) {
                                            $action = '<a class="btn btn-sm btn-primary m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-maximize"></i> View</a> <a class="btn btn-info m-t-n-xs btnApply" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-rotate"></i> Re-Apply</a> <a class="btn btn-sm btn-danger m-t-n-xs btnRemove" href="#" value="' . $row['id'] . '"><i class="fa-sharp fa-solid fa-trash"></i> Remove</a>';
                                            $createDate = new DateTime($row['date_apply']);
                                            $date = $createDate->format('Y-m-d');
                                            echo '<tr>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $date . '</td>
                                                <td>' . $row['tin'] . '</td>
                                                <td>' . $row['contact_no'] . '</td>
                                                <td><center>' . $action . '</center></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- inactive -->
                    <div class="tab-pane fade" id="nav-inactive" role="tabpanel" aria-labelledby="nav-inactive-tab" tabindex="0">
                        <div class="card p-2 mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover TableData">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Apply</th>
                                            <th>TIN No.</th>
                                            <th>Contact No.</th>
                                            <th style="width: 30%; text-align:center">Action</th>
                                        </tr>
                                    <tbody>
                                        <?php
                                        $get_member = $users->get_member_inactive();
                                        while ($row = $get_member->fetch(PDO::FETCH_ASSOC)) {

                                            $action = '<a class="btn btn-sm btn-primary m-t-n-xs btnView" href="#" value="' . $row['id'] . '"><i class="fa-solid fa-arrows-maximize"></i> View</a> <a class="btn btn-sm btn-success m-t-n-xs btnActive" href="#" value="' . $row['id'] . '"><i class="fas fa-user-tag"></i> Activate</a>';
                                            $createDate = new DateTime($row['date_apply']);
                                            $date = $createDate->format('Y-m-d');
                                            echo '<tr>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $date . '</td>
                                                <td>' . $row['tin'] . '</td>
                                                <td>' . $row['contact_no'] . '</td>
                                                <td><center>' . $action . '</center></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="declinedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reasons for declining</h1>
                            </div>
                            <div class="modal-body m-0">
                                <textarea name="" id="reason" rows="5" class="form-control" placeholder="Reasons..."></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="DeclineSubmit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/member.js"></script>
</body>

</html>