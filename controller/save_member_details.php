<?php
include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$member = new Users($db);


//form details for restration of coop member
$member->firstname = $_POST['firstname'];
$member->middle_name = $_POST['middle_name'];
$member->lastname = $_POST['lastname'];
$member->civil_status = $_POST['civil'];
$member->sex = $_POST['sex'];
$member->height = $_POST['height'];
$member->weight = $_POST['weight'];
$member->phone_num = $_POST['phone_no'];
$member->residence = $_POST['residence'];
$member->place_of_birth = $_POST['place_of_birth'];
$member->date_of_birth = $_POST['date_of_birth'];
$member->age = $_POST['age'];
$member->father_name = $_POST['father_name'];
$member->father_birth = $_POST['father_birth'];
$member->mother_name = $_POST['mother_name'];
$member->mother_birth = $_POST['mother_birth'];
$member->educ_attain = $_POST['educ_attain'];
$member->school = $_POST['school'];
$member->date_grad = $_POST['date_grad'];
$member->properties = $_POST['real_prop'];
$member->emp_business = $_POST['emp_business'];
$member->tin = $_POST['tin'];
$member->ctc = $_POST['ctc'];
$member->arb = $_POST['arb'];
$member->num_of_dep = $_POST['no_of_dep'];
$member->elementary = $_POST['elementary'];
$member->hs = $_POST['hs'];
$member->college = $_POST['college'];
$member->benifi_primary = $_POST['primary'];
$member->benifi_primary_birth = $_POST['primary_birth'];
$member->benifi_secondary = $_POST['secondary'];
$member->benifi_secondary_birth = $_POST['secondary_birth'];
$member->spouse_name = $_POST['spouse_name'];
$member->relig_aff = $_POST['reg_aff'];
$member->crime = $_POST['crime'];
$member->spouse_placeof_birth = $_POST['spouse_place'];
$member->spouse_birth = $_POST['spouse_birth'];
$member->spouse_age = $_POST['spouse_age'];
$member->spouse_father_name = $_POST['spouse_father_name'];
$member->spouse_mother_name = $_POST['spouse_mother_name'];
$member->p1_name_add = $_POST['person1'];
$member->p2_name_add = $_POST['person2'];
$member->status = 2; //pending
$member->user_id = $_POST['id'];
$member->id = $_POST['id'];

$update = $member->save_member_details();

echo ($update) ? 1 : 0;
