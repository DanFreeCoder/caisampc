<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>New Loan | CIACO</title>
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
    <!-- pendingModal -->
    <?php include '../pending_prompt.php'; ?>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="row">
                <center>
                    <h2>Loan Application Details</h2>
                </center>
                <?php
                $loan->id = $_GET['id'];
                $get = $loan->view_submitted_by_id();
                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $gender = $row['gender'];
                    $occupation = $row['occupation'];
                    $dob = $row['date_of_birth'];
                    $civil_status = $row['civil_status'];
                    $dependents = $row['dependents'];
                    $address = $row['address'];
                    $contact = $row['contact'];
                    $spouse = $row['spouse'];
                    $spouse_occu = $row['spouse_occu'];
                    $gross = $row['gross'];
                    $expense = $row['expenses'];
                    $net = $row['net'];
                    $date_applied = $row['date_applied'];
                    $date_needed = $row['date_needed'];
                    $amount = $row['amount_applied'];
                    $purpose = $row['purpose'];
                    $type = $row['type'];
                    $mode = $row['mode'];
                    $others = $row['others'];
                    $kind = $row['kind'];
                    $tct = $row['tct'];
                    $area = $row['area'];
                    $co_maker1 = $row['co_maker1'];
                    $stock1 = $row['stock1'];
                    $co_maker2 = $row['co_maker2'];
                    $stock2 = $row['stock2'];
                    $status = $row['status'];
                    $reason = $row['reason'];
                    $submit_by = $row['submit_by'];
                }
                ?>
            </div><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>APPLICATION INFORMATION</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Applicant's Name</label>
                                <input id="name" class="form-control" type="text" placeholder="Name" value="<?php echo $name; ?>">
                                <input id="id" class="form-control" value="<?php echo $id; ?>" hidden>
                            </div>
                            <div class="col-lg-4">
                                <label for="gender" class=" form-control-label"> Gender</label>
                                <select id="gender" class="form-control" type="text">
                                    <option value="0">Select Gender</option>
                                    <?php
                                    echo ($gender == 'Male') ? '<option value="Male" selected>Male</option><option value="Female">Female</option>' : '<option value="Male">Male</option><option value="Female" selected>Female</option>'
                                    ?>

                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="occupation" class=" form-control-label">Occupation</label>
                                <input id="occupation" class="form-control" type="text" placeholder="Applicant's Occupation" value="<?php echo $occupation; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="date-of-birth" class=" form-control-label">Date of Birth</label>
                                <div class="input-group date">
                                    <input id="date-of-birth" type="text" class="form-control col-md-12 datepicker" name="datepicker" value="<?php echo date('m/d/Y', strtotime($dob)); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="status" class=" form-control-label">Civil Status</label>
                                <select id="status" class="form-control" type="text">
                                    <option value="0">Select Status</option>
                                    <?php
                                    if ($civil_status == 'Single') {
                                        echo '<option value="Single" selected>Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorce">Divorce</option>';
                                    } elseif ($civil_status == 'Married') {
                                        echo '<option value="Single">Single</option>
                                                <option value="Married" selected>Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorce">Divorce</option>';
                                    } elseif ($civil_status == 'Widowed') {
                                        echo '<option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed" selected>Widowed</option>
                                                <option value="Divorce">Divorce</option>';
                                    } else {
                                        echo '<option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorce" selected>Divorce</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="dependents" class=" form-control-label">No. of Dependents</label>
                                <input id="dependents" class="form-control" type="text" placeholder="Number of Dependents" value="<?php echo $dependents ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="address" class=" form-control-label">Residential Address</label>
                                <input id="address" type="text" class="form-control col-md-12" placeholder="Applicant's Address" value="<?php echo $address; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="contact-no" class=" form-control-label">Contact No.</label>
                                <input id="contact-no" type="text" class="form-control" placeholder="Cellphone number / Telephone number" value="<?php echo $contact; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="spouse" class=" form-control-label">Name of Spouse</label>
                                <input id="spouse" type="text" class="form-control col-md-12" placeholder="Name of Spouse" value="<?php echo $spouse; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="spouse-occu" class=" form-control-label">Spouse Occupation</label>
                                <input id="spouse-occu" type="text" class="form-control" placeholder="Spouse Occupation" value="<?php echo $spouse_occu; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">Gross Monthly Income</label>
                                <input id="gross" type="text" class="form-control col-md-12" placeholder="Estimated Monthly Income" value="<?php echo $gross; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Less Expenses</label>
                                <input id="expenses" type="text" class="form-control" placeholder="Estimated Expenses" value="<?php echo $expense; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Net Monthly Income</label>
                                <input id="net" type="text" class="form-control" placeholder="Estimated Net Monthly Income" value="<?php echo $net; ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>CREDIT INFORMATION</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">Date Applied</label>
                                <input id="date-applied" type="text" class="form-control col-md-12 datepicker" name="datepicker" value="<?php echo date('m/d/Y', strtotime($date_applied)); ?>">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Date Needed</label>
                                <input id="date-needed" type="text" class="form-control col-md-12 datepicker" name="datepicker" value="<?php echo date('m/d/Y', strtotime($date_needed)); ?>">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Amount Applied</label>
                                <input id="amount-applied" type="text" class="form-control" placeholder="PHP" value="<?php echo $amount; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class=" form-control-label">Purpose</label>
                                <input id="purpose" type="text" class="form-control" placeholder="Purpose" value="<?php echo $purpose; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="loan-type" class=" form-control-label">Loan Type</label>
                                <select id="loan-type" class="form-control" type="text">
                                    <option value="0">Select Loan Type</option>
                                    <?php
                                    echo ($type == 'Renewal' ? '<option value="Renewal" selected>Renewal</option><option value="New Loan">New Loan</option><option value="Re-Structuring">Re-Structuring</option>' : ($type == 'New Loan' ? '<option value="Renewal">Renewal</option><option value="New Loan" selected>New Loan</option><option value="Re-Structuring">Re-Structuring</option>' : ($type == 'Re-Structuring' ? '<option value="Renewal">Renewal</option><option value="New Loan">New Loan</option><option value="Re-Structuring" selected>Re-Structuring</option>' : '<option value="0" seelcted>Select Loan Type</option>')));
                                    ?>


                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="mode" class=" form-control-label">Desired Mode of Payment</label>
                                <select id="mode" class="form-control" type="text">
                                    <option value="0">Select Mode of Payment</option>
                                    <?php
                                    if ($mode == 'Quarterly') {
                                        echo '<option value="Quarterly" selected>Quarterly</option>
                                                      <option value="Daily">Daily</option>
                                                      <option value="Monthly Bi-Monthly">Monthly Bi-Monthly</option>
                                                      <option value="Others, Specify">Others, Specify</option>';
                                    } elseif ($mode == 'Daily') {
                                        echo '<option value="Quarterly">Quarterly</option>
                                                      <option value="Daily" selected>Daily</option>
                                                      <option value="Monthly Bi-Monthly">Monthly Bi-Monthly</option>
                                                      <option value="Others, Specify">Others, Specify</option>';
                                    } elseif ($mode == 'Monthly Bi-Monthly') {
                                        echo '<option value="Quarterly">Quarterly</option>
                                                      <option value="Daily">Daily</option>
                                                      <option value="Monthly Bi-Monthl" selected>Monthly Bi-Monthly</option>
                                                      <option value="Others, Specify">Others, Specify</option>';
                                    } else {
                                        echo '<option value="Quarterly">Quarterly</option>
                                                      <option value="Daily">Daily</option>
                                                      <option value="Monthly Bi-Monthly">Monthly Bi-Monthly</option>
                                                      <option value="Others, Specify" selected>Others, Specify</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div id="mode-option" class="col-lg-4">
                                <label for="mode" class=" form-control-label">Others, Please specify</label>
                                <input id="others" type="text" class="form-control" placeholder="Others, Please Specify" value="<?php echo $others; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="kind" class=" form-control-label">Kind of Loan</label>
                                <select id="kind" type="text" class="form-control">
                                <option value="0">Select Kind of Loan</option>
                                <?php
                                    echo ($kind == 'Micro' ? '<option value="Micro" selected>Micro</option>' : '<option value="Micro">Micro</option>');
                                    echo ($kind == 'Agri' ? '<option value="Agri" selected>Agri</option>' : '<option value="Agri">Agri</option>');
                                    echo ($kind == 'PPL' ? '<option value="PPL" selected>PPL</option>' : '<option value="PPL">PPL</option>');
                                    echo ($kind == 'Special' ? '<option value="Special" selected>Special</option>' : '<option value="Special">Special</option>');
                                ?>
                            </select>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">CTC No</label>
                                <input id="tct-no" type="text" class="form-control" placeholder="CTC Number" value="<?php echo $tct; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Area</label>
                                <input id="area" type="text" class="form-control" placeholder="Area" value="<?php echo $area; ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>CO-MAKERS</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">1 . Name</label>
                                <select name="" id="co-maker1" class="select2 form-control">
                                    <?php
                                    $users->id = $submit_by;
                                    $mem = $users->get_coworker();
                                    while ($row2 = $mem->fetch(PDO::FETCH_ASSOC)) {
                                        if ($row2['id'] == $co_maker1) {
                                            echo ' <option value="' . $row2['id'] . '" selected>' . $row2['fullname'] . '</option>';
                                        } else {
                                            echo ' <option value="' . $row2['id'] . '">' . $row2['fullname'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Stock / Share</label>
                                <input id="stock1" type="text" class="form-control" value="<?php echo $stock1; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">2 . Name</label>
                                <select name="" id="co-maker2" class="select2 form-control">
                                    <?php
                                    $users->id = $submit_by;
                                    $mem = $users->get_coworker();
                                    while ($row2 = $mem->fetch(PDO::FETCH_ASSOC)) {
                                        if ($row2['id'] == $co_maker2) {
                                            echo ' <option value="' . $row2['id'] . '" selected>' . $row2['fullname'] . '</option>';
                                        } else {
                                            echo ' <option value="' . $row2['id'] . '">' . $row2['fullname'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label">Stock / Share</label>
                                <input id="stock2" type="text" class="form-control" value="<?php echo $stock2; ?>">
                            </div>
                        </div>
                        <?php
                        if ($status == 2) {
                            echo '
                                <div class="row">
                                <div class="col-lg-12">
                                    <label for="" class="form-control-label">Reason of declined</label>
                                    <textarea name="" id="reasons" class="form-control" rows="3" disabled>' . $reason . '</textarea>
                                </div>
                            </div>
                                ';
                            }
                            ?>
                            <br><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    if ($status != 3 && $status != 2) {
                                        echo '
                                                <button id="btnApprove" class="btn btn-success m-t-n-xs" onclick="approve_loan()"><i class="fa-regular fa-thumbs-up"></i> Approve Loan</button>
                                                <button id="btnClear" class="btn btn-secondary float-right m-t-n-xs" type="submit" onclick="cleardata()"><i class="fa-duotone fa-trash"></i> Clear</button>
                                                <!-- hidden button -->
                                                <button id="btnUpdate" class="btn btn-success m-t-n-xs" onclick="update_loan()"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Update Details</button>
                                                <button id="btnCancel" class="btn btn-danger m-t-n-xs" onclick="cancel()"><i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Cancel Edit</button>
                                                ';
                                    }
    
                                    echo ($status != 3 && $status != 2) ? '     <button id="btnDecline" class="btn btn-danger m-t-n-xs" onclick="decline_loan()"><i class="fa-solid fa-rectangle-xmark"></i> Decline Loan</button>':'';
                                    ?>
                                </div>
                            </div>
                        <!-- Vertically centered modal -->
                        <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reasons for declining</h1>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="" id="reason" rows="5" class="form-control" placeholder="Reasons..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" id="declineSubmit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/newLoan.js"></script>
        <!-- disabled all fields -->
        <script>
            $(document).ready(function() {
                //hide btn
                $('#btnUpdate').hide();
                $('#btnCancel').hide();
                //disabled all input
                $('input[type=text]').prop('disabled', true);
                //disabled all select box
                $('select').prop('disabled', true);
            })
        </script>
</body>

</html>