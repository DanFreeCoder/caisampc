<?php

class Distribute
{
    private $tbl_name = 'distribution';
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    function save_distribution()
    {
        $sql = 'INSERT INTO ' . $this->tbl_name . ' SET user_id =?, descriptions =?, type=?, date_added =?, status =?';
        $ins = $this->conn->prepare($sql);
        $ins->bindParam(1, $this->user_id);
        $ins->bindParam(2, $this->descriptions);
        $ins->bindParam(3, $this->type);
        $ins->bindParam(4, $this->date_added);
        $ins->bindParam(5, $this->status);

        return ($ins->execute()) ? true : false;
    }
    function upd_distribute()
    {
        $sql = 'UPDATE ' . $this->tbl_name . ' SET descriptions = ?, date_update = ? WHERE id = ?';
        $upd = $this->conn->prepare($sql);
        $upd->bindParam(1, $this->descriptions);
        $upd->bindParam(2, $this->date_update);
        $upd->bindParam(3, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function distribute_to_all()
    {
        $sql = 'INSERT INTO ' . $this->tbl_name . ' SET user_id =?, descriptions =?, type =?, date_added =?, status =?';
        $ins = $this->conn->prepare($sql);
        $ins->bindParam(1, $this->user_id);
        $ins->bindParam(2, $this->descriptions);
        $ins->bindParam(3, $this->type);
        $ins->bindParam(4, $this->date_added);
        $ins->bindParam(5, $this->status);

        return ($ins->execute()) ? true : false;
    }

    function get_last_id()
    {
        $query = "SELECT max(id) as 'id' FROM " . $this->tbl_name . "";
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    function get_number()
    {
        $query = 'SELECT users.contact_no, users.firstname FROM users WHERE id =?';
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);
        $sel->execute();
        return $sel;
    }

    function insert_image()
    {
        $query = "UPDATE " . $this->tbl_name . " SET image = ? WHERE id = ?";
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->image);
        $upd->bindParam(2, $this->id);

        return ($upd->execute()) ? true : false;
    }
    function check_image_exist()
    {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE image = ?";
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->image);

        $sel->execute();
        return $sel;
    }

    function distributed_byid()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ", users.lastname) as fullname, distribution.user_id, distribution.image, distribution.type, distribution.descriptions, distribution.date_added FROM users, items, distribution WHERE items.user_to = ? AND users.id = items.user_id AND distribution.id = items.dist_id AND distribution.status != 0 ORDER BY distribution.id DESC';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->user_to);

        $sel->execute();
        return $sel;
    }
    function distributer_byid()
    {
        $sql = 'SELECT * FROM ' . $this->tbl_name . ' WHERE user_id = ? AND status != 0 AND type = ? ORDER BY id DESC';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->user_id);
        $sel->bindParam(2, $this->type);

        $sel->execute();
        return $sel;
    }

    function get_id()
    {
        $sql = 'SELECT items.user_to FROM items, distribution WHERE items.dist_id = ?';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->dist_id);

        $sel->execute();
        return $sel;
    }


    function distribute_to()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ", users.lastname) as fullname, distribution.user_to, distribution.status FROM distribution, users WHERE distribution.user_to = ? AND distribution.user_to = users.id';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->user_to);

        $sel->execute();
        return $sel;
    }

    function distributions()
    {
        $sql = 'SELECT * FROM ' . $this->tbl_name . ' WHERE user_id = ? ORDER BY date_added DESC';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->user_id);

        $sel->execute();
        return $sel;
    }

    function distribution_detail()
    {
        $sql = 'SELECT * FROM distribution WHERE id =?';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function remove_distribution()
    {
        $sql = 'UPDATE distribution SET status = ? WHERE id = ?';
        $upd = $this->conn->prepare($sql);

        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->id);

        return ($upd->execute()) ? true : false;
    }


    function distributions_report()
    {
        $sql = 'SELECT * FROM distribution WHERE status != 0 ORDER BY date_added DESC';
        $sel = $this->conn->prepare($sql);

        $sel->execute();
        return $sel;
    }

    function get_distributer()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ", users.lastname) as fullname FROM users, items WHERE items.user_to = users.id AND items.dist_id = ?';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->dist_id);
        $sel->execute();
        return $sel;
    }

    function report_distribution()
    {
        $sql = 'SELECT * FROM distribution WHERE status != 0 AND date_added BETWEEN ? AND ?';
        $sel = $this->conn->prepare($sql);

        $sel->bindParam(1, $this->from);
        $sel->bindParam(2, $this->to);
        $sel->execute();
        return $sel;
    }

    function save_item()
    {
        $sql = 'INSERT INTO items SET user_id = ?, dist_id = ?, user_to = ?, status =?';
        $ins = $this->conn->prepare($sql);
        $ins->bindParam(1, $this->user_id);
        $ins->bindParam(2, $this->dist_id);
        $ins->bindParam(3, $this->user_to);
        $ins->bindParam(4, $this->status);

        return ($ins->execute()) ? true : false;
    }

    function distributer_name()
    {
        $sql = 'SELECT CONCAT(users.firstname, " ", users.lastname) as fullname FROM users, distribution WHERE users.id = distribution.user_id AND distribution.user_id = ?';
        $sel = $this->conn->prepare($sql);
        $sel->bindParam(1, $this->user_id);
        $sel->execute();
        return $sel;
    }
}
