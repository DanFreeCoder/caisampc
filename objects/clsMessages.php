<?php
class Message
{

    protected $con;

    public function __construct($db)
    {
        $this->con = $db;
    }

    function send_to()
    {
        $sql = 'INSERT INTO msg_detail SET sender = ?, reciever = ?, last_sent = ?, last_message = ?, status = ?';
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->sender);
        $ins->bindParam(2, $this->reciever);
        $ins->bindParam(3, $this->last_sent);
        $ins->bindParam(4, $this->last_message);
        $ins->bindParam(5, $this->status);


        return ($ins->execute()) ? true : false;
    }
    function get_msg_detail()
    {
        $sql = 'SELECT * FROM msg_detail WHERE sender = ? AND reciever = ? AND status != 0';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->sender);
        $sel->bindParam(2, $this->reciever);

        $sel->execute();
        return $sel;
    }

    function msg_id()
    {
        $sql = 'SELECT id FROM msg_detail WHERE sender = ? AND reciever = ? AND status != 0';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->sender);
        $sel->bindParam(2, $this->reciever);

        $sel->execute();
        return $sel;
    }

    function send_message()
    {
        $sql = 'INSERT INTO messages SET message_id = ?, sender_id =?, reciever_id =?, message = ?, status = ?';
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->message_id);
        $ins->bindParam(2, $this->sender_id);
        $ins->bindParam(3, $this->reciever_id);
        $ins->bindParam(4, $this->message);
        $ins->bindParam(5, $this->status);

        return ($ins->execute()) ? true : false;
    }

    function get_convo_with()
    {
        $sql = 'SELECT msg_detail.id, msg_detail.sender, msg_detail.reciever, msg_detail.last_message, msg_detail.status, msg_detail.last_sent FROM msg_detail ORDER BY msg_detail.last_sent DESC';
        $sel = $this->con->prepare($sql);
        $sel->execute();
        return $sel;
    }
    function search_convo($search)
    {
        $sql = "SELECT msg_detail.id, msg_detail.sender, msg_detail.reciever, msg_detail.last_message, msg_detail.status, msg_detail.last_sent 
        FROM msg_detail 
        JOIN users ON users.id = msg_detail.sender OR users.id = msg_detail.reciever 
        WHERE CONCAT(users.firstname, ' ',users.lastname) LIKE '%" . $search . "%'";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    function update_date_last_convo()
    {
        $sql = 'UPDATE msg_detail SET last_sent = ?, last_message = ?, sender =?, reciever = ? WHERE id = ?';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->last_sent);
        $upd->bindParam(2, $this->last_message);
        $upd->bindParam(3, $this->sender);
        $upd->bindParam(4, $this->reciever);
        $upd->bindParam(5, $this->id);

        return ($upd->execute()) ? true : false;
    }

    function get_convoBy_id()

    {
        $sql = 'SELECT message,added_at,message_id,sender_id, reciever_id FROM messages WHERE message_id =?';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->message_id);
        $sel->execute();
        return $sel;
    }

    function get_last_convo()
    {
        $sql = 'SELECT message as last_message, message_id FROM messages WHERE message_id = ? ORDER BY id DESC LIMIT 1';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->message_id);
        $sel->execute();
        return $sel;
    }
    function reply_convo()
    {
        $sql = 'INSERT INTO messages SET message_id = ?, sender_id = ?, reciever_id = ?, message = ?, added_at = ?, status = ?';
        $ins = $this->con->prepare($sql);
        $ins->bindParam(1, $this->message_id);
        $ins->bindParam(2, $this->sender_id);
        $ins->bindParam(3, $this->reciever_id);
        $ins->bindParam(4, $this->message);
        $ins->bindParam(5, $this->added_at);
        $ins->bindParam(6, $this->status);

        return ($ins->execute()) ? true : false;
    }

    function unseen_msg()
    {
        $sql = 'SELECT COUNT(id) as total FROM messages WHERE reciever_id = ? AND status = 1';
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->reciever_id);
        $sel->execute();
        return $sel;
    }

    function update_message_status()
    {
        $sql = 'UPDATE messages SET status = ? WHERE status = 1 AND reciever_id = ?';
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->reciever_id);

        return ($upd->execute()) ? true : false;
    }

    function get_last_sender()
    {
        $sql = 'SELECT sender FROM msg_detail WHERE id = ?';
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->id);
        $sel->execute();
        return $sel;
    }
}
