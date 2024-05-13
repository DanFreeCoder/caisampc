<?php
class Printer
{

    protected $con;

    public function __construct($db)
    {
        $this->con = $db;
    }

    function print_coop()
    {
        $sql = 'SELECT users.firstname, users.middle_name, users.lastname, members_data.age, members_data.phone_num, members_data.approved_date as date_joined, members_data.tin FROM members_data, users WHERE users.id = members_data.user_id AND status = ? AND role != 1';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->status);
        $sel->execute();
        return $sel;
    }

    function print_approved_loan()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ", users.lastname) as fullname, loan_details.occupation, loan_details.amount_applied, loan_details.kind, loan_details.date_needed, loan_details.approve_date, loan_details.contact FROM loan_details, users WHERE users.id = loan_details.submit_by AND loan_details.status = 3 AND loan_details.status != 0';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }
}
