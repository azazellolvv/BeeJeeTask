<?php
namespace models;


class Tasks
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getList($page = 1, $limit = 3, $sort = 'name asc')
    {
        $sort = mysqli_real_escape_string($this->db, $sort);

        $offset = ($page - 1)*$limit;
        $stmt = $this->db->prepare("select * from tasks order by {$sort} limit ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_all(true);

        return $row;
    }

    public function saveTask($name, $email, $text)
    {
        $stmt = $this->db->prepare("insert into tasks (name, email, text) VALUE (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $text);
        $stmt->execute();
        $stmt->close();
    }

    public function searchTask($email)
    {
        $stmt = $this->db->prepare('select * from tasks where email=?');
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

        return $row;
    }

    public function updateTask($email, $text, $did)
    {
        $task = $this->searchTask($email);
        $adminEdit = (integer)($text != $task['text'] || $task['adminEdit'] == 1);

        $stmt = $this->db->prepare("update tasks set text=?, did=?, adminEdit={$adminEdit} where email=?");
        $stmt->bind_param("sss", $text, $did, $email);
        $stmt->execute();
        $stmt->close();
    }

    public function getCount()
    {
        return mysqli_query($this->db, 'select count(*) as count from tasks')->fetch_all(true)[0]['count'];
    }
}