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
    <link rel="stylesheet" href="../../assets/datapicker/datepicker3.css">
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
    <link href="../../assets/select2/css/select2.min.css" rel="stylesheet">
</head>

<body>
    <!-- pendingModal -->
    <?php include '../pending_prompt.php'; ?>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/staff_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <?php $users->id = $_SESSION['id'];
            $users->user_id = $_SESSION['id'];
            $res = $users->get_inherit_value();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $applicant_name = $row['applicant_name'];
                $gender = $row['sex'];
                $date_of_birth = $row['date_of_birth'];
                $civil_status = $row['civil_status'];
                $num_of_dep = $row['num_of_dep'];
                $phone_num = $row['phone_num'];
                $residence = $row['residence'];
                $spouse_name = $row['spouse_name'];
                $phone_num = $row['phone_num'];
            }
            ?>
            <div class="row">
                <center>
                    <h2>Loan Applicant Details</h2>
                </center>
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
                                <input id="name" class="form-control" value="<?php echo $applicant_name; ?>" placeholder="Name" disabled>
                            </div>
                            <div class="col-lg-4">
                                <label for="gender" class=" form-control-label"> Gender</label>
                                <select id="gender" class="form-control select" disabled>
                                    <option value="0">Select Gender</option>
                                    <option value="Male" <?php echo ($gender == 'M') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($gender == 'F') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="occupation" class=" form-control-label">Occupation</label>
                                <input id="occupation" class="form-control" placeholder="Applicant's Occupation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="date-of-birth" class=" form-control-label">Date of Birth</label>
                                <div class="input-group date">
                                    <input id="date-of-birth" type="text" value="<?php echo $date_of_birth; ?>" class="form-control col-md-12 datepicker" name="datepicker" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="status" class=" form-control-label">Civil Status</label>
                                <select id="status" class="form-control select" disabled>
                                    <option value="0" <?php echo ($civil_status == 'Select Status') ? 'selected' : ''; ?>>Select Status</option>
                                    <option value="Single" <?php echo ($civil_status == 'Single') ? 'selected' : ''; ?>>Single</option>
                                    <option value="Married" <?php echo ($civil_status == 'Married') ? 'selected' : ''; ?>>Married</option>
                                    <option value="Widowed" <?php echo ($civil_status == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                    <option value="Divorce" <?php echo ($civil_status == 'Divorce') ? 'selected' : ''; ?>>Divorce</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="dependents" class=" form-control-label">No. of Dependents</label>
                                <input id="dependents" class="form-control" value="<?php echo $num_of_dep ?>" placeholder="Number of Dependents" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="address" class=" form-control-label">Residential Address</label>
                                <input id="address" type="text" value="<?php echo $residence; ?>" class="form-control col-md-12" placeholder="Applicant's Address" disabled>
                            </div>
                            <div class="col-lg-4">
                                <label for="contact-no" class=" form-control-label">Contact No.</label>
                                <input id="contact-no" class="form-control" value="<?php echo $phone_num ?>" placeholder="Cellphone number / Telephone number" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="spouse" class=" form-control-label">Name of Spouse</label>
                                <input id="spouse" type="text" value="<?php echo $spouse_name; ?>" class="form-control col-md-12" placeholder="Name of Spouse" disabled>
                            </div>
                            <div class="col-lg-4">
                                <label for="spouse-occu" class=" form-control-label">Spouse Occupation</label>
                                <input id="spouse-occu" class="form-control" placeholder="Spouse Occupation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">Gross Monthly Income</label>
                                <input id="gross" type="text" class="form-control col-md-12" placeholder="Estimated Monthly Income">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Less Expenses</label>
                                <input id="expenses" class="form-control" placeholder="Estimated Expenses">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Net Monthly Income</label>
                                <input id="net" class="form-control" placeholder="Estimated Net Monthly Income">
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
                                <input id="date-applied" type="text" class="form-control col-md-12" value="<?php echo date('m/d/Y'); ?>" name="datepicker" disabled>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Date Needed</label>
                                <input id="date-needed" type="text" class="form-control col-md-12 datepicker" name="datepicker">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Amount Applied</label>
                                <input id="amount-applied" class="form-control" placeholder="PHP">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class=" form-control-label">Purpose</label>
                                <input id="purpose" class="form-control" placeholder="Purpose">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="loan-type" class=" form-control-label">Loan Type</label>
                                <select id="loan-type" class="form-control select">
                                    <option value="0" selected disabled>Select Loan Type</option>
                                    <option value="Renewal">Renewal</option>
                                    <option value="New Loan">New Loan</option>
                                    <option value="Re-Structuring">Re-Structuring</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="mode" class=" form-control-label">Desired Mode of Payment</label>
                                <select id="mode" class="form-control select">
                                    <option value="0" selected disabled>Select Mode of Payment</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Monthly Bi-Monthly">Monthly Bi-Monthly</option>
                                    <option value="Others, Specify">Others, Specify</option>
                                </select>
                            </div>
                            <div id="mode-option" class="col-lg-4">
                                <label for="mode" class=" form-control-label">Others, Please specify</label>
                                <input id="others" class="form-control" placeholder="Others, Please Specify">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="kind" class=" form-control-label">Kind of Loan</label>
                                <select id="kind" class="form-control select">
                                    <option value="0" selected disabled>Select Kind of Loan</option>
                                    <option value="Micro">Micro</option>
                                    <option value="Agri">Agri</option>
                                    <option value="PPL">PPL</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">CTC No</label>
                                <input id="tct-no" class="form-control" placeholder="CTC Number">
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Area</label>
                                <input id="area" class="form-control" placeholder="Area">
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
                                    <option value="0" selected disabled>Select co-maker</option>
                                    <?php
                                    $users->id = $_SESSION['id'];
                                    $mem = $users->get_coworker();
                                    while ($row2 = $mem->fetch(PDO::FETCH_ASSOC)) {
                                        echo ' <option value="' . $row2['id'] . '">' . $row2['fullname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Stock / Share</label>
                                <input id="stock1" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class=" form-control-label">2 . Name</label>
                                <select name="" id="co-maker2" class="select2 form-control">
                                    <option value="0" selected disabled>Select co-maker</option>
                                    <?php
                                    $users->id = $_SESSION['id'];
                                    $mem = $users->get_coworker();
                                    while ($row2 = $mem->fetch(PDO::FETCH_ASSOC)) {
                                        echo ' <option value="' . $row2['id'] . '">' . $row2['fullname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class=" form-control-label">Stock / Share</label>
                                <input id="stock2" class="form-control">
                            </div>
                        </div><br><br>
                        <div class="row mt-5">
                            <div class="col-sm-12">
                                <button id="btnSubmit" class="btn btn-success m-t-n-xs" onclick="save_loan()"><i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> SAVE & SUBMIT</button>
                                <button id="clear" class="btn btn-secondary float-right m-t-n-xs" type="submit" onclick="clearData()"><i class="fa-duotone fa-trash"></i> Clear</button>
                            </div>
                        </div>
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
        <script src="js/newLoan.js"></script>
</body>

</html>