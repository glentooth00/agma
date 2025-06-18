<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class User
{
    private $db;
    private $sql;
    private $stmt;
    private $query;

    private $table = "users";

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



}