<?php
class clsLoanDetails
{
	private $conn;
	private $table_name = 'loan_details';

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function save_new_loan()
	{
		$query = "INSERT INTO " . $this->table_name . " SET name=?, gender=?, occupation=?, date_of_birth=?, civil_status=?, dependents=?, address=?, contact=?, spouse=?, spouse_occu=?, gross=?, expenses=?, net=?, date_applied=?, date_needed=?, amount_applied=?, purpose=?, type=?, mode=?, others=?, kind=?, tct=?, area=?, co_maker1=?, stock1=?, co_maker2=?, stock2=?, date_submit=?, submit_by=?, status=1";
		$save = $this->conn->prepare($query);

		$save->bindParam(1, $this->name);
		$save->bindParam(2, $this->gender);
		$save->bindParam(3, $this->occupation);
		$save->bindParam(4, $this->date_of_birth);
		$save->bindParam(5, $this->civil_status);
		$save->bindParam(6, $this->dependents);
		$save->bindParam(7, $this->address);
		$save->bindParam(8, $this->contact);
		$save->bindParam(9, $this->spouse);
		$save->bindParam(10, $this->spouse_occu);
		$save->bindParam(11, $this->gross);
		$save->bindParam(12, $this->expenses);
		$save->bindParam(13, $this->net);
		$save->bindParam(14, $this->date_applied);
		$save->bindParam(15, $this->date_needed);
		$save->bindParam(16, $this->amount_applied);
		$save->bindParam(17, $this->purpose);
		$save->bindParam(18, $this->type);
		$save->bindParam(19, $this->mode);
		$save->bindParam(20, $this->others);
		$save->bindParam(21, $this->kind);
		$save->bindParam(22, $this->tct);
		$save->bindParam(23, $this->area);
		$save->bindParam(24, $this->co_maker1);
		$save->bindParam(25, $this->stock1);
		$save->bindParam(26, $this->co_maker2);
		$save->bindParam(27, $this->stock2);
		$save->bindParam(28, $this->date_submit);
		$save->bindParam(29, $this->submit_by);

		if ($save->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function check_loan()
	{
		$query = "SELECT * FROM " . $this->table_name . " WHERE name=? AND gender=? AND occupation=? AND date_of_birth=? AND civil_status=? AND dependents=? AND address=? AND contact=? AND spouse=? AND spouse_occu=? AND gross=? AND expenses=? AND net=? AND date_applied=? AND date_needed=? AND amount_applied=? AND purpose=? AND type=? AND mode=? AND others=? AND kind=? AND tct=? AND area=? AND co_maker1=? AND stock1=? AND co_maker2=? AND stock2=? AND submit_by=? AND status=1";
		$check = $this->conn->prepare($query);

		$check->bindParam(1, $this->name);
		$check->bindParam(2, $this->gender);
		$check->bindParam(3, $this->occupation);
		$check->bindParam(4, $this->date_of_birth);
		$check->bindParam(5, $this->civil_status);
		$check->bindParam(6, $this->dependents);
		$check->bindParam(7, $this->address);
		$check->bindParam(8, $this->contact);
		$check->bindParam(9, $this->spouse);
		$check->bindParam(10, $this->spouse_occu);
		$check->bindParam(11, $this->gross);
		$check->bindParam(12, $this->expenses);
		$check->bindParam(13, $this->net);
		$check->bindParam(14, $this->date_applied);
		$check->bindParam(15, $this->date_needed);
		$check->bindParam(16, $this->amount_applied);
		$check->bindParam(17, $this->purpose);
		$check->bindParam(18, $this->type);
		$check->bindParam(19, $this->mode);
		$check->bindParam(20, $this->others);
		$check->bindParam(21, $this->kind);
		$check->bindParam(22, $this->tct);
		$check->bindParam(23, $this->area);
		$check->bindParam(24, $this->co_maker1);
		$check->bindParam(25, $this->stock1);
		$check->bindParam(26, $this->co_maker2);
		$check->bindParam(27, $this->stock2);
		$check->bindParam(28, $this->submit_by);
		$check->execute();
		return $check;
	}



	public function update_new_loan()
	{
		$query = "UPDATE " . $this->table_name . " SET name=?, gender=?, occupation=?, date_of_birth=?, civil_status=?, dependents=?, address=?, contact=?, spouse=?, spouse_occu=?, gross=?, expenses=?, net=?, date_applied=?, date_needed=?, amount_applied=?, purpose=?, type=?, mode=?, others=?, kind=?, tct=?, area=?, co_maker1=?, stock1=?, co_maker2=?, stock2=?, date_update=?, update_by=?, reason=? WHERE id=?";
		$save = $this->conn->prepare($query);

		$save->bindParam(1, $this->name);
		$save->bindParam(2, $this->gender);
		$save->bindParam(3, $this->occupation);
		$save->bindParam(4, $this->date_of_birth);
		$save->bindParam(5, $this->civil_status);
		$save->bindParam(6, $this->dependents);
		$save->bindParam(7, $this->address);
		$save->bindParam(8, $this->contact);
		$save->bindParam(9, $this->spouse);
		$save->bindParam(10, $this->spouse_occu);
		$save->bindParam(11, $this->gross);
		$save->bindParam(12, $this->expenses);
		$save->bindParam(13, $this->net);
		$save->bindParam(14, $this->date_applied);
		$save->bindParam(15, $this->date_needed);
		$save->bindParam(16, $this->amount_applied);
		$save->bindParam(17, $this->purpose);
		$save->bindParam(18, $this->type);
		$save->bindParam(19, $this->mode);
		$save->bindParam(20, $this->others);
		$save->bindParam(21, $this->kind);
		$save->bindParam(22, $this->tct);
		$save->bindParam(23, $this->area);
		$save->bindParam(24, $this->co_maker1);
		$save->bindParam(25, $this->stock1);
		$save->bindParam(26, $this->co_maker2);
		$save->bindParam(27, $this->stock2);
		$save->bindParam(28, $this->date_update);
		$save->bindParam(29, $this->update_by);
		$save->bindParam(30, $this->reason);
		$save->bindParam(31, $this->id);

		if ($save->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function update_client_loan()
	{
		$query = "UPDATE " . $this->table_name . " SET name=?, gender=?, occupation=?, date_of_birth=?, civil_status=?, dependents=?, address=?, contact=?, spouse=?, spouse_occu=?, gross=?, expenses=?, net=?, date_applied=?, date_needed=?, amount_applied=?, purpose=?, type=?, mode=?, others=?, kind=?, tct=?, area=?, co_maker1=?, stock1=?, co_maker2=?, stock2=?, date_update=?, update_by=? WHERE id=?";
		$save = $this->conn->prepare($query);

		$save->bindParam(1, $this->name);
		$save->bindParam(2, $this->gender);
		$save->bindParam(3, $this->occupation);
		$save->bindParam(4, $this->date_of_birth);
		$save->bindParam(5, $this->civil_status);
		$save->bindParam(6, $this->dependents);
		$save->bindParam(7, $this->address);
		$save->bindParam(8, $this->contact);
		$save->bindParam(9, $this->spouse);
		$save->bindParam(10, $this->spouse_occu);
		$save->bindParam(11, $this->gross);
		$save->bindParam(12, $this->expenses);
		$save->bindParam(13, $this->net);
		$save->bindParam(14, $this->date_applied);
		$save->bindParam(15, $this->date_needed);
		$save->bindParam(16, $this->amount_applied);
		$save->bindParam(17, $this->purpose);
		$save->bindParam(18, $this->type);
		$save->bindParam(19, $this->mode);
		$save->bindParam(20, $this->others);
		$save->bindParam(21, $this->kind);
		$save->bindParam(22, $this->tct);
		$save->bindParam(23, $this->area);
		$save->bindParam(24, $this->co_maker1);
		$save->bindParam(25, $this->stock1);
		$save->bindParam(26, $this->co_maker2);
		$save->bindParam(27, $this->stock2);
		$save->bindParam(28, $this->date_update);
		$save->bindParam(29, $this->update_by);
		$save->bindParam(30, $this->id);

		if ($save->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function update_loan_stat()
	{
		$query = "UPDATE " . $this->table_name . " SET approve_date=?, approve_by=?, reason=?, status=? WHERE id=?";
		$save = $this->conn->prepare($query);

		$save->bindParam(1, $this->approve_date);
		$save->bindParam(2, $this->approve_by);
		$save->bindParam(3, $this->reason);
		$save->bindParam(4, $this->status);
		$save->bindParam(5, $this->id);

		return ($save->execute()) ? true : false;
	}

	public function view_submitted_loan_bystatus()
	{
		$query = 'SELECT * FROM ' . $this->table_name . ' WHERE status = ? ORDER BY status ASC';
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->status);
		$sel->execute();
		return $sel;
	}

	public function view_submitted_by_id()
	{
		$query = 'SELECT * FROM ' . $this->table_name . ' WHERE id=?';
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->id);

		$sel->execute();
		return $sel;
	}

	function count_loan()
	{
		$sql = 'SELECT count(id) as "count" FROM loan_details WHERE status=3';
		$sel = $this->conn->prepare($sql);

		$sel->execute();
		return $sel;
	}

	public function view_submitted_loan_by_user()
	{
		$sql = 'SELECT * FROM ' . $this->table_name . ' WHERE submit_by = ?';
		$sel = $this->conn->prepare($sql);

		$sel->bindParam(1, $this->submit_by);

		$sel->execute();
		return $sel;
	}

	function submitted_loan_report()
	{
		$sql = 'SELECT loan_details.*, CONCAT(users.firstname, " ", users.lastname) as submitby FROM loan_details, users WHERE loan_details.submit_by = users.id AND loan_details.status != 0';
		$sel = $this->conn->prepare($sql);

		$sel->execute();
		return $sel;
	}

	function report_loan()
	{
		$sql = 'SELECT loan_details.*, CONCAT(users.firstname, " ", users.lastname) as submitby FROM loan_details, users WHERE loan_details.submit_by = users.id AND loan_details.status != 0 AND loan_details.date_submit BETWEEN ? AND ?';
		$sel = $this->conn->prepare($sql);

		$sel->bindParam(1, $this->from);
		$sel->bindParam(2, $this->to);
		$sel->execute();
		return $sel;
	}

	//allow next loan if 10 days pass since the first loan
	function check_num_of_loans()
	{
		$sql = 'SELECT MAX(date_submit) AS last_loan_date FROM loan_details WHERE submit_by = ?';
		$sel = $this->conn->prepare($sql);

		$sel->bindParam(1, $this->submit_by);
		$sel->execute();
		return $sel;
	}
}
