<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Members
{
    private $db;
    private $sql;
    private $stmt;
    private $query;

    private $table = "tbl_consumers";

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getByUsername($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // returns a single row or false
    }

    public function updateStatus($data)
    {
        $id = $data['id'];
        $status = $data['status'];
        $lastLogin = $data['last_login'];
        $updatedAt = $data['updated_at'];
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET status = ?, last_login = ?, updated_at = ? WHERE id = ?");
        $stmt->execute([$status, $lastLogin, $updatedAt, $id,]);
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;

    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function delete($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        $this->stmt->execute([$id]);
    }

    public function getMember($data)
    {

        $sql = "SELECT * FROM " . $this->table . "WHERE account_no = :account_no ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':account_no', $data['account_no']);
        $stmt->execute();

        return $result = $stmt->fetchAll();

    }

    public function searchMember($search)
    {
        try {
            $sql = "SELECT * FROM {$this->table}
                WHERE account_no LIKE :account_no
                   OR member_name LIKE :member_name";

            $stmt = $this->db->prepare($sql);

            $likeTerm = '%' . $search . '%';

            $stmt->bindValue(':account_no', $likeTerm, PDO::PARAM_STR);
            $stmt->bindValue(':member_name', $likeTerm, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }



}