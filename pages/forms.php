<?php
// fname,mname and lastname who are login and inherit in the form
$users->id = $_SESSION['id'];
$sel = $users->get_name_byid();
while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
    $firstname = $row['firstname'];
    $middle_name = $row['middle_name'];
    $lastname = $row['lastname'];
    $cp_num = $row['contact_no'];
}
?>

<!-- Modal -->
<div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #21232d;">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Membership Form</h1>
            </div>
            <div class="modal-body">
                <form class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="f_id" value="<?php echo $_SESSION['id']; ?>" hidden>
                                    <input type="text" class="form-control page1 stringOnly" id="f_fname" value="<?php echo $firstname; ?>" disabled>
                                    <label for="f_fname">First Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 stringOnly" id="f_mname" value="<?php echo $middle_name; ?>">
                                    <label for="f_mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 stringOnly" id="f_lname" value="<?php echo $lastname; ?>" disabled>
                                    <label for="f_lname">Last Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <select class="form-select page1" id="f_civil">
                                        <option selected disabled>Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorce">Divorce</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                    <label for="f_civil">Civil Status</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <select class="form-select page1" id="f_sex">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <label for="f_sex">Sex</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 numberOnly" id="f_height">
                                    <label for="f_height">Height/cm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 numberOnly" id="f_weight" placeholder="W">
                                    <label for="f_weight">Weight/kg</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 numberOnly" id="f_phone_no" value="<?php echo $cp_num ?>" disabled>
                                    <label for="f_phone_no">CP No.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1" id="f_residence">
                                    <label for="f_residence">Residence</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page1 stringOnly" id="f_place_of_birth">
                                    <label for="f_place_of_birth">Place of Birth</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page1 datetype" id="f_date_of_birth">
                                    <label for="f_date_of_birth">Date of Birth</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control page1 numberOnly" id="f_age" disabled>
                                    <label for="f_age">Age</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary" id="next">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #21232d;">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Membership Form</h1>
            </div>
            <div class="modal-body">
                <form class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 stringOnly" id="f_father_name">
                                    <label for="f_father_name">Father's Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page2 datetype" id="f_father_birth">
                                    <label for="f_father_birth">Date of Birth</label>
                                </div>
                            </div>
                            <hr style="border:1px solid black;">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2" id="f_educ_attain">
                                    <label for="f_educ_attain">Educational Attainment</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 stringOnly" id="f_school">
                                    <label for="f_school">School</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page2 datetype" id="f_date_grad">
                                    <label for="f_date_grad">Date Graduated</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 stringOnly" id="f_real_prop">
                                    <label for="f_real_prop">Real Properties Owned</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="ARB" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary" for="btnradio1">ARB</label>

                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="NON-ARB" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio2">NON-ARB</label>

                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="4P's" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio3">4P's</label>

                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" value="IP's" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio4">IP's</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 stringOnly" id="f_mother_name">
                                    <label for="f_mother_name">Mother's Maiden Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page2 datetype" id="f_mother_birth">
                                    <label for="f_mother_birth">Date of Birth</label>
                                </div>
                            </div>
                            <hr style="border:1px solid black;">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2" id="f_emp_business">
                                    <label for="f_emp_business">Employment/Private Business</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 numberOnly" id="f_tin">
                                    <label for="f_tin">TIN</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="tin_front" class="form-label">Upload TIN Front</label>
                                    <form name="form" method="post" enctype="multipart/form-data">
                                        <input class="form-control" type="file" id="tin_front">
                                    </form>
                                    <label class="text-danger fs-6" id="error1" hidden>Image must be 2MB or below</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="tin_back" class="form-label">Upload TIN Back</label>
                                    <form name="form" method="post" enctype="multipart/form-data">
                                        <input class="form-control" type="file" id="tin_back">
                                    </form>
                                    <label class="text-danger fs-6" id="error2" hidden>Image must be 2MB or below</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page2 numberOnly" id="f_ctc" placeholder="Sedula No..">
                                    <label for="f_ctc">TCT No.</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary" id="prev">Previous</button>
                    <button type="button" class="btn btn-outline-primary" id="next2">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="modal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #21232d;">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Membership Form</h1>
            </div>
            <div class="modal-body">
                <form class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control page3 numberOnly" id="f_no_of_dep">
                                    <label for="f_no_of_dep">Number of Dependents</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page3 numberOnly" id="f_elementary">
                                    <label for="f_elementary">Elementary</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page3 numberOnly" id="f_hs">
                                    <label for="f_hs">HS</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page3 numberOnly" id="f_college">
                                    <label for="f_college">College</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Name of Beneficiaries</p>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page3 stringOnly" id="f_primary">
                                    <label for="f_primary">Primary</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page3 datetype" id="f_primary_birth">
                                    <label for="f_primary_birth">Date of Birth</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control page3 stringOnly" id="f_secondary">
                                    <label for="f_secondary">Secondary</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control page3 datetype" id="f_secondary_birth">
                                    <label for="f_secondary_birth">Date of Birth</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary" id="prev2">Previous</button>
                    <button type="button" class="btn btn-outline-primary" id="next3">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal4 -->
<div class="modal fade" id="modal4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #21232d;">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Membership Form</h1>
            </div>
            <div class="modal-body">
                <form class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">Name of Spouse</div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control stringOnly" id="f_spouse_name">
                                    <label for="f_spouse_name">First Name, Middle Name, Last Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control stringOnly" id="f_reg_aff">
                                    <label for="f_reg_aff">Religious Affiliation</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-label">Have ever been accuse or convicted of any crime?</div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Yes" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" value="No" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="f_spouse_place">
                                    <label for="f_spouse_place">Place of Birth</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control datetype" id="f_spouse_birth">
                                    <label for="f_spouse_birth">Date of Birth</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control numberOnly" id="f_spouse_age">
                                    <label for="f_spouse_age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control stringOnly" id="f_spouse_father_name">
                                    <label for="f_spouse_father_name">Father's Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control stringOnly" id="f_spouse_mother_name">
                                    <label for="f_spouse_mother_name">Mother's Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Give names and addresses of two reliable persons who vouch for your character</div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="f_person1">
                                    <label for="f_person1">Name & Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="f_person2">
                                    <label for="f_person2">Name & Address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary" id="prev3">Previous</button>
                    <button type="button" class="btn btn-outline-success" id="form_submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>