<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$edit = new Users($db);

$edit->id = $_POST['id']; //passed id user
$res = $edit->get_all_userby_id();
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $firstname = $row['firstname'];
    $middle_name = $row['middle_name'];
    $lastname = $row['lastname'];
    $username = $row['username'];
    $contact_no = $row['contact_no'];
    $role1 = ($row['role'] == 1) ? 'selected' : ''; //return admin as selected if role = 1
    $role2 = ($row['role'] == 2) ? 'selected' : ''; //return client as selected if role = 2


    // this for the modal 
    echo '
            <div class="form">
                        <div class="form-floating mb-3">
                            <input type="text" name="" id="upd_id" class="form-control" value="' . $id . '" hidden>
                            <input type="text" name="" id="upd_fname" class="form-control" value="' . $firstname . '" placeholder="First Name">
                            <label for="upd_fname">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="" id="upd_mname" class="form-control" value="' . $middle_name . '" placeholder="Enter Middle Name">
                            <label for="upd_mname">Middle Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="" id="upd_lname" class="form-control" value="' . $lastname . '" placeholder="Last Name">
                            <label for="upd_lname">Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="" id="upd_uname" class="form-control" value="' . $username . '" placeholder="Username">
                            <label for="upd_uname">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="" id="upd_cnum" class="form-control" value="' . $contact_no . '" placeholder="Contact Number">
                            <label for="upd_cnum">Contact Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="" id="upd_role" class="select form-control">
                                <option value="2" ' . $role2 . '>Client</option>
                                <option value="1" ' . $role1 . '>Admin</option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                     </div>
    ';
}
