<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Details | CIACO</title>
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
            <div class="row">
                <?php
                $users->id = $_GET['id'];
                $get = $users->get_member_details();
                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                    $firstname = $row['firstname'];
                    $middlename = $row['middle_name'];
                    $lastname = $row['lastname'];
                    $civil_status = $row['civil_status'];
                    $sex = ($row['sex'] == 'F') ? 'Female' : 'Male';
                    $height = $row['height'];
                    $weight = $row['weight'];
                    $phone_num = $row['phone_num'];
                    $residence = $row['residence'];
                    $place_dob = $row['place_of_birth'];
                    $dob = $row['date_of_birth'];
                    $age = $row['age'];
                    $father_name = $row['father_name'];
                    $father_birth = $row['father_birth'];
                    $mother_name = $row['mother_name'];
                    $mother_birth = $row['mother_birth'];
                    $educ = $row['educ_attain'];
                    $school = $row['school'];
                    $date_grad = $row['date_grad'];
                    $properties = $row['properties'];
                    $emp_business = $row['emp_business'];
                    $tin = $row['tin'];
                    $ctc = $row['ctc'];
                    $arb = $row['arb'];
                    $dependents = $row['num_of_dep'];
                    $elementary = $row['elementary'];
                    $hs = $row['hs'];
                    $college = $row['college'];
                    $benifi_primary = $row['benifi_primary'];
                    $benifi_primary_birth = $row['benifi_primary_birth'];
                    $benifi_secondary = $row['benifi_secondary'];
                    $benifi_secondary_birth = $row['benifi_secondary_birth'];
                    $spouse = $row['spouse_name'];
                    $relig_aff = $row['relig_aff'];
                    $crime = $row['crime'];
                    $spouse_placeof_birth = $row['spouse_placeof_birth'];
                    $spouse_birth = $row['spouse_birth'];
                    $spouse_age = $row['spouse_age'];
                    $spouse_father_name = $row['spouse_father_name'];
                    $spouse_mother_name = $row['spouse_mother_name'];
                    $p1_name_add = $row['p1_name_add'];
                    $p2_name_add = $row['p2_name_add'];
                    $tin_front = $row['tin_front'];
                    $tin_back = $row['tin_back'];
                    $reason = $row['reason'];
                    $status = $row['status'];
                }
                ?>
            </div><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>COOPERATIVE MEMBERS INFORMATION</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Firstname</label>
                                <input class="form-control" type="text" placeholder="Firstname" value="<?php echo $firstname; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Middlename</label>
                                <input class="form-control" type="text" placeholder="Firstname" value="<?php echo $middlename; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Lastname</label>
                                <input class="form-control" type="text" placeholder="Firstname" value="<?php echo $lastname; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Civil Status</label>
                                <input class="form-control" type="text" placeholder="Civil Status" value="<?php echo $civil_status; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> Sex</label>
                                <input class="form-control" type="text" placeholder="Sex" value="<?php echo $sex; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> Height</label>
                                <input class="form-control" type="text" placeholder="Height" value="<?php echo $height; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label">Weight</label>
                                <input class="form-control" type="text" placeholder="Weight" value="<?php echo $weight; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label">CP No.</label>
                                <input class="form-control" type="text" placeholder="Weight" value="<?php echo $phone_num; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="name" class=" form-control-label"> Residence</label>
                                <input class="form-control" type="text" placeholder="Residence / Addresss" value="<?php echo $residence; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class=" form-control-label"> Place of Birth</label>
                                <input class="form-control" type="text" placeholder="Place of Birth" value="<?php echo $place_dob; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Date of Birth</label>
                                <input class="form-control" type="text" placeholder="Place of Birth" value="<?php echo ($dob != null) ? date('F j, Y', strtotime($dob)) : '-'; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Age</label>
                                <input class="form-control" type="text" placeholder="Age" value="<?php echo $age; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class=" form-control-label"> Father's Name</label>
                                <input class="form-control" type="text" placeholder="Father's Name" value="<?php echo $father_name; ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="name" class=" form-control-label"> Mother's Maiden Name</label>
                                <input class="form-control" type="text" placeholder="Mother's Maiden Name" value="<?php echo $mother_name; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class=" form-control-label"> Date of Birth</label>
                                <input class="form-control" type="text" placeholder="Father's Name" value="<?php echo ($father_birth != null) ? date('F j, Y', strtotime($father_birth)) : '-'; ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="name" class=" form-control-label"> Date of Birth</label>
                                <input class="form-control" type="text" placeholder="Father's Name" value="<?php echo ($mother_birth != null) ? date('F j, Y', strtotime($mother_birth)) : '-'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <label for="name" class=" form-control-label"> Educational Attainment</label>
                                <input class="form-control" type="text" placeholder="Highest Educational Attainment" value="<?php echo $educ; ?>">
                            </div>
                            <div class="col-lg-5">
                                <label for="name" class=" form-control-label"> School</label>
                                <input class="form-control" type="text" placeholder="School" value="<?php echo $school; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> Year Graduated</label>
                                <input class="form-control" type="text" placeholder="Year Graduated" value="<?php echo $date_grad; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="name" class=" form-control-label"> Employer / Private Business</label>
                                <input class="form-control" type="text" placeholder="Employer / Private Business" value="<?php echo $emp_business; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> TIN </label>
                                <input class="form-control" type="text" placeholder="TIN" value="<?php echo $tin; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> CTC No.</label>
                                <input class="form-control" type="text" placeholder="CTC Number" value="<?php echo $ctc; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <label for="name" class=" form-control-label"> Real Properties Owned</label>
                                <input class="form-control" type="text" placeholder="Real Properties Owned" value="<?php echo $properties; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label for="name" class=" form-control-label"> ARB </label>
                                <input class="form-control" type="text" placeholder="ARB" value="<?php echo $arb; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Number of Dependents</label>
                                <input class="form-control" type="text" placeholder="Number of Dependents" value="<?php echo $dependents; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Elementary </label>
                                <input class="form-control" type="text" placeholder="Elementary" value="<?php echo $elementary; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> Highschool </label>
                                <input class="form-control" type="text" placeholder="Highschool" value="<?php echo $hs; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="name" class=" form-control-label"> College </label>
                                <input class="form-control" type="text" placeholder="College" value="<?php echo $college; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>NAME OF BENEFICIARIES</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="name" class=" form-control-label"> Primary</label>
                                <input class="form-control" type="text" placeholder="Name" value="<?php echo $benifi_primary; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Date of Birth </label>
                                <input class="form-control" type="text" placeholder="Date of Birth" value="<?php echo ($benifi_primary_birth != null) ? date('F j, Y', strtotime($benifi_primary_birth)) : '-'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="name" class=" form-control-label"> Secondary</label>
                                <input class="form-control" type="text" placeholder="Name" value="<?php echo $benifi_secondary; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Date of Birth </label>
                                <input class="form-control" type="text" placeholder="Date of Birth" value="<?php echo ($benifi_secondary_birth != null) ? date('F j, Y', strtotime($benifi_secondary_birth)) : '-'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Religous Affiliation</label>
                                <input class="form-control" type="text" placeholder="Religion" value="<?php echo $relig_aff; ?>">
                            </div>
                            <div class="col-lg-8">
                                <label for="name" class=" form-control-label"> Have you ever been accuse or convicted of any crime? </label>
                                <input class="form-control" type="text" placeholder="Y / N, Please specify" value="<?php echo $crime; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="name" class=" form-control-label"> Name of Spouse</label>
                                <input class="form-control" type="text" placeholder="Firstname , Middlename, Lastname" value="<?php echo $spouse; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Place of Birth </label>
                                <input class="form-control" type="text" placeholder="Place of Birth" value="<?php echo ($spouse_placeof_birth != null) ? date('F j, Y', strtotime($spouse_placeof_birth)) : '-'; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Date of Birth </label>
                                <input class="form-control" type="text" placeholder="Date of Birth" value="<?php echo ($spouse_birth != null) ? date('F j, Y', strtotime($spouse_birth)) : '-'; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="name" class=" form-control-label"> Age</label>
                                <input class="form-control" type="text" placeholder="Age" value="<?php echo $spouse_age; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="name" class=" form-control-label"> Give names and addresses of two reliable persons who vouch for your character</label>
                                <input class="form-control" type="text" placeholder="Name - Address" value="<?php echo $p1_name_add; ?>"><br>
                                <input class="form-control" type="text" placeholder="Name - Address" value="<?php echo $p2_name_add; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <br>
                                <label for=""><mark>TIN Front Side</mark></label>
                                <img class="img-thumbnail img-fluid" src="<?php echo '../' . $tin_front ?>" alt="front">
                            </div>
                            <div class="col-lg-6">
                                <br>
                                <label for=""><mark>TIN Back Side</mark></label>
                                <img class="img-thumbnail img-fluid" src="<?php echo '../' . $tin_back ?>" alt="front">
                            </div>
                        </div>
                        <?php
                        if ($status == 4) {
                            echo '
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <label for="reason">Reason of declined</label>
                                        <textarea name="" id="reason" class="form-control" rows="3" disabled>' . $reason . '</textarea>
                                    </div>
                                </div>
                                    ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- dont remove this is content-page-wrapper -->
    <?php include '../../partials/footer.php'; ?>
    <script src="js/member.js"></script>
</body>

</html>