<?php

class Users
{
    protected $con;
    private $tbl_name = 'users';

    public function __construct($db)
    {
        $this->con = $db;
    }


    function Register()
    {
        $sql = 'INSERT INTO '.$this->tbl_name.' SET firstname =?, middle_name =?, lastname =?, username =?, password =?, salt = ?, contact_no=?, role=?, mycode=?, status =?';
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->firstname);
        $ins->bindParam(2, $this->middle_name);
        $ins->bindParam(3, $this->lastname);
        $ins->bindParam(4, $this->username);
        $ins->bindParam(5, $this->password);
        $ins->bindParam(6, $this->salt);
        $ins->bindParam(7, $this->contact_no);
        $ins->bindParam(8, $this->role);
        $ins->bindParam(9, $this->mycode);
        $ins->bindParam(10, $this->status);

        return ($ins->execute()) ? true : false;
    }

    function Login()
    {
        $sql = 'SELECT * FROM '.$this->tbl_name.' WHERE username = ? AND status != 0';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->username);

        $sel->execute();
        return $sel;
    }

    function get_all_user()
    {
        $sql = 'SELECT * FROM '.$this->tbl_name.' WHERE status != 0 AND role != ?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->role);
        $sel->execute();
        return $sel;
    }
    function get_allValid_user()
    {
        $sql = 'SELECT * FROM '.$this->tbl_name.' WHERE status != 0 AND role != ? AND status = 3';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->role);
        $sel->execute();
        return $sel;
    }
    function get_all_userby_id()
    {
        $sql = 'SELECT * FROM '.$this->tbl_name.' WHERE id = ? AND status != 0';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);
        $sel->execute();
        return $sel;
    }
    function logout()
    {
        session_start();
        if (session_destroy()) {
            return true;
            unset($_SESSION['username']);
        } else {
            return false;
        }
    }

    function update_account_withPass()
    {
        $sql = 'UPDATE '.$this->tbl_name.' SET firstname =?, middle_name = ?, lastname = ?, username = ?, password = ?, salt= ?, contact_no = ?, role = ? WHERE id =?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->middle_name);
        $upd->bindParam(3, $this->lastname);
        $upd->bindParam(4, $this->username);
        $upd->bindParam(5, $this->password);
        $upd->bindParam(6, $this->salt);
        $upd->bindParam(7, $this->contact_no);
        $upd->bindParam(8, $this->role);
        $upd->bindParam(9, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function update_account_withoutPass()
    {
        $sql = 'UPDATE '.$this->tbl_name.' SET firstname =?, middle_name = ?, lastname = ?, username = ?, contact_no = ?, role = ? WHERE id =?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->middle_name);
        $upd->bindParam(3, $this->lastname);
        $upd->bindParam(4, $this->username);
        $upd->bindParam(5, $this->contact_no);
        $upd->bindParam(6, $this->role);
        $upd->bindParam(7, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function check_image_exist()
    {
        $query = "SELECT * FROM '.$this->tbl_name.' WHERE image = ?";
        $sel = $this->con->prepare($query);

        $sel->bindParam(1, $this->image);

        $sel->execute();
        return $sel;
    }
    function get_last_id()
    {
        $query = "SELECT max(id) as 'id' FROM users";
        $sel = $this->con->prepare($query);

        $sel->execute();
        return $sel;
    }

    function insert_image()
    {
        $query = "UPDATE " . $this->tbl_name . " SET image = ? WHERE id = ?";
        $upd = $this->con->prepare($query);

        $upd->bindParam(1, $this->image);
        $upd->bindParam(2, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function tin_image_front()
    {
        $sql = 'UPDATE members_data SET tin_front = ? WHERE id = ?';
        $ins = $this->con->prepare($sql);
        $ins->bindParam(1, $this->tin_front);
        $ins->bindParam(2, $this->id);

        return ($ins->execute()) ? true : false;
    }
    function tin_image_back()
    {
        $sql = 'UPDATE members_data SET tin_back = ? WHERE id = ?';
        $ins = $this->con->prepare($sql);
        $ins->bindParam(1, $this->tin_back);
        $ins->bindParam(2, $this->id);

        return ($ins->execute()) ? true : false;
    }

    function remove_user()
    {
        $sql = 'UPDATE '.$this->tbl_name.' SET status = ? WHERE id = ?';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->id);

        return ($upd->execute()) ? true : false;
    }

    function last_reg()
    {
        $sql = 'SELECT MAX(id) as maxId FROM users';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    function verify_codes()
    {
        $sql = 'SELECT mycode FROM ' . $this->tbl_name . ' WHERE id = ?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function insert_last_id()
    {
        $sql = 'INSERT INTO members_data SET user_id = ?';
        $ins = $this->con->prepare($sql);
        $ins->bindParam(1, $this->user_id);

        return ($ins->execute()) ? true : false;
    }


    function get_name_byid()
    {
        $sql = 'SELECT firstname, middle_name, lastname, contact_no, image FROM '.$this->tbl_name.' WHERE id = ? AND status != 0';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);
        $sel->execute();
        return $sel;
    }

    function save_member_details()
    {
        $sql = 'UPDATE members_data, users SET users.firstname = ?, users.middle_name = ?, users.lastname = ?, members_data.civil_status = ?, members_data.sex = ?, members_data.height = ?, members_data.weight = ?, members_data.phone_num = ?, members_data.residence = ?, members_data.place_of_birth = ?, members_data.date_of_birth = ?, members_data.age =?, members_data.father_name = ?, members_data.father_birth = ?, members_data.mother_name = ?, members_data.mother_birth = ?, members_data.educ_attain = ?, members_data.school = ?, members_data.date_grad = ?, members_data.properties = ?, members_data.emp_business = ?, members_data.tin = ?, members_data.ctc = ?, members_data.arb = ?, members_data.num_of_dep = ?, members_data.elementary = ?, members_data.hs = ?, members_data.college = ?, members_data.benifi_primary = ?, members_data.benifi_primary_birth =?, members_data.benifi_secondary = ?, members_data.benifi_secondary_birth = ?, members_data.spouse_name = ?, members_data.relig_aff = ?, members_data.crime = ?, members_data.spouse_placeof_birth = ?, members_data.spouse_birth = ?, members_data.spouse_age = ?, members_data.spouse_father_name = ?, members_data.spouse_mother_name = ?, members_data.p1_name_add = ?, members_data.p2_name_add = ?, users.status = ? WHERE members_data.user_id = ? AND users.id = ? AND users.status != 0';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->middle_name);
        $upd->bindParam(3, $this->lastname);
        $upd->bindParam(4, $this->civil_status);
        $upd->bindParam(5, $this->sex);
        $upd->bindParam(6, $this->height);
        $upd->bindParam(7, $this->weight);
        $upd->bindParam(8, $this->phone_num);
        $upd->bindParam(9, $this->residence);
        $upd->bindParam(10, $this->place_of_birth);
        $upd->bindParam(11, $this->date_of_birth);
        $upd->bindParam(12, $this->age);
        $upd->bindParam(13, $this->father_name);
        $upd->bindParam(14, $this->father_birth);
        $upd->bindParam(15, $this->mother_name);
        $upd->bindParam(16, $this->mother_birth);
        $upd->bindParam(17, $this->educ_attain);
        $upd->bindParam(18, $this->school);
        $upd->bindParam(19, $this->date_grad);
        $upd->bindParam(20, $this->properties);
        $upd->bindParam(21, $this->emp_business);
        $upd->bindParam(22, $this->tin);
        $upd->bindParam(23, $this->ctc);
        $upd->bindParam(24, $this->arb);
        $upd->bindParam(25, $this->num_of_dep);
        $upd->bindParam(26, $this->elementary);
        $upd->bindParam(27, $this->hs);
        $upd->bindParam(28, $this->college);
        $upd->bindParam(29, $this->benifi_primary);
        $upd->bindParam(30, $this->benifi_primary_birth);
        $upd->bindParam(31, $this->benifi_secondary);
        $upd->bindParam(32, $this->benifi_secondary_birth);
        $upd->bindParam(33, $this->spouse_name);
        $upd->bindParam(34, $this->relig_aff);
        $upd->bindParam(35, $this->crime);
        $upd->bindParam(36, $this->spouse_placeof_birth);
        $upd->bindParam(37, $this->spouse_birth);
        $upd->bindParam(38, $this->spouse_age);
        $upd->bindParam(39, $this->spouse_father_name);
        $upd->bindParam(40, $this->spouse_mother_name);
        $upd->bindParam(41, $this->p1_name_add);
        $upd->bindParam(42, $this->p2_name_add);
        $upd->bindParam(43, $this->status);
        $upd->bindParam(44, $this->user_id);
        $upd->bindParam(45, $this->id);

        return ($upd->execute()) ? true : false;
    }

    function get_inherit_value()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ",users.lastname) as applicant_name, members_data.* FROM users, members_data WHERE users.id = ? AND members_data.user_id = ?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);
        $sel->bindParam(2, $this->user_id);
        $sel->execute();
        return $sel;
    }
    function get_member_pending()
    {
        $sql = 'SELECT users.*, members_data.date_apply, members_data.tin FROM users, members_data WHERE users.role = 2 AND members_data.user_id = users.id AND users.status = 1 ORDER BY members_data.date_apply DESC';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    function get_member_pending_forApproval()
    {
        $sql = 'SELECT users.*, members_data.date_apply, members_data.tin FROM users, members_data WHERE users.role=2 AND members_data.user_id = users.id AND users.status = 2 ORDER BY members_data.date_apply DESC';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    function get_member_registered()
    {
        $sql = 'SELECT users.*, members_data.date_apply, members_data.tin FROM users, members_data WHERE users.role= 2 AND members_data.user_id = users.id AND users.status = 3 ORDER BY members_data.date_apply DESC';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    function get_member_declined()
    {
        $sql = 'SELECT users.*, members_data.date_apply, members_data.tin FROM users, members_data WHERE users.role=2 AND members_data.user_id = users.id AND users.status = 4 ORDER BY members_data.date_apply DESC';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    function get_member_inactive()
    {
        $sql = 'SELECT users.*, members_data.date_apply, members_data.tin FROM users, members_data WHERE users.role=2 AND members_data.user_id = users.id AND users.status = 0 ORDER BY members_data.date_apply DESC';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    function upd_user_status()
    {
        $sql = 'UPDATE users SET status = ?, reason = ? WHERE id = ?';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->reason);
        $upd->bindParam(3, $this->id);

        return ($upd->execute()) ? true : false;
    }

    function upd_member_status()
    {
        $sql = 'UPDATE members_data SET approved_by = ?, approved_date = ? WHERE id = ?';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->approved_by);
        $upd->bindParam(2, $this->approved_date);
        $upd->bindParam(3, $this->id);

        return ($upd->execute()) ? true : false;
    }

    function count_member()
    {
        $sql = 'SELECT count(id) as "count" FROM users WHERE role=2 AND status=3';
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    function get_member_details()
    {
        $query = "SELECT members_data.*, users.status, users.reason, users.firstname, users.middle_name, users.lastname FROM members_data, users WHERE users.id = members_data.user_id AND users.id = ?";
        $sel = $this->con->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function count_user_by_month()
    {
        $sql = 'SELECT MONTH(added_at) AS month, COUNT(added_at) AS count FROM users WHERE role = 2 AND status = 3 GROUP BY month';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }

    function count_active()
    {
        $sql = 'SELECT COUNT(status) AS active FROM users WHERE status = 3 AND role = 2';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }
    function count_inactive()
    {
        $sql = 'SELECT COUNT(status) AS inactive FROM users WHERE status = 0 AND role = 2';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }

    function verify_number()
    {
        $sql = 'SELECT contact_no FROM users WHERE contact_no = ?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->contact_no);

        return ($sel->execute()) ? $sel : 0;
    }

    function setcode()
    {
        $sql = 'UPDATE users SET mycode = ? WHERE contact_no = ?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->mycode);
        $upd->bindParam(2, $this->contact_no);

        return ($upd->execute()) ? true : false;
    }

    function reset_password()
    {
        $sql = 'UPDATE users SET password = ?, salt = ? WHERE mycode = ?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->password);
        $upd->bindParam(2, $this->salt);
        $upd->bindParam(3, $this->mycode);

        return ($upd->execute()) ? true : false;
    }

    function reset_code()
    {
        $sql = 'UPDATE users SET mycode = ? WHERE contact_no = ?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->mycode);
        $upd->bindParam(2, $this->contact_no);

        return ($upd->execute()) ? true : false;
    }


    function verify_code()
    {
        $sql = 'SELECT mycode, contact_no FROM users WHERE contact_no = ? AND mycode = ?';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->contact_no);
        $sel->bindParam(2, $this->mycode);

        return ($sel->execute()) ? $sel : 0;
    }

    function get_client_no()
    {
        $sql = 'SELECT members_data.phone_num FROM members_data WHERE members_data.user_id = ?';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->user_id);

        return ($sel->execute()) ? $sel : false;
    }

    function upd_stat()
    {
        $sql = 'UPDATE ' . $this->tbl_name . ' SET status = ? WHERE id =?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function upd_code()
    {
        $sql = 'UPDATE ' . $this->tbl_name . ' SET mycode = ? WHERE contact_no =?';
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->mycode);
        $upd->bindParam(2, $this->contact_no);

        return ($upd->execute()) ? true : false;
    }

    function registered_mem()
    {
        $sql = 'SELECT id, CONCAT(firstname, " ",lastname) as fullname FROM ' . $this->tbl_name . ' WHERE status = 3';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }

    function check_reg_number()
    {
        $sql = 'SELECT * FROM ' . $this->tbl_name . ' WHERE contact_no = ?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->contact_no);
        $sel->execute();
        return $sel;
    }

    function get_coworker()
    {
        $sql = 'SELECT id, CONCAT(firstname, " ",lastname) AS fullname FROM ' . $this->tbl_name . ' WHERE status = 3 AND role != 1 AND id != ?';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->id);
        $sel->execute();
        return $sel;
    }

    function check_fullname()
    {
        $sql = 'SELECT id FROM ' . $this->tbl_name . ' WHERE firstname = ? AND middle_name = ? AND lastname = ? AND status != 0 OR status != NULL';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->firstname);
        $sel->bindParam(2, $this->middle_name);
        $sel->bindParam(3, $this->lastname);
        $sel->execute();
        return $sel;
    }

    function check_username()
    {
        $sql = 'SELECT username FROM ' . $this->tbl_name . ' WHERE username = ?';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->username);
        $sel->execute();
        return $sel;
    }
}
