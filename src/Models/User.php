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

        // If your DB stores MD5 passwords, hash it:
        // $password = md5($password);

        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE username = :username AND password = :password
            LIMIT 1
        ");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUser($data){

        $username = $data['username'];
        $password = $data['password'];

        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE username = :username AND password = :password
        ");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function updateLogoutStatus($data)
    {
        $id = $data['id'];
        $status = $data['status'];
        $lastLogout = $data['last_logout'];
        $updatedAt = $data['updated_at'];
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET status = ?, last_logout = ?, updated_at = ? WHERE id = ?");
        $stmt->execute([$status, $lastLogout, $updatedAt, $id,]);
    }

    public function getUsers(){

        $sql = "SELECT users.id,users.role, users.username, users.firstname, users.middlename, users.lastname, areaTown.area_name FROM " . $this->table . "
                INNER JOIN areaTown ON users.area_office = areaTown.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($data){

        $sql = "INSERT INTO " . $this->table . " (username, password, role, firstname, lastname, middlename, created_at, updated_at, status, area_office) 
                VALUES (:username, :password, :role, :firstname, :lastname, :middlename, :created_at, :updated_at, :status, :area_office)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':role' => $data['role'],
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':middlename' => $data['middlename'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
            ':status' => $data['status'],
            ':area_office' => $data['area_office']
        ]);
    
    }

    public function deleteUser($id){

        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    
    }

    public function getUserbyId($id){

        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getUserAreainfo($id){

        $sql = "SELECT users.area_office, areaTown.area_name, areaTown.town_ids FROM " . $this->table . "
                INNER JOIN areaTown ON users.area_office = areaTown.id WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
                ':id' => $id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getAreaList($id){

        $sql = "SELECT  
                    areaTown.town_ids,
                    areaTown.area_name
                FROM " . $this->table . " 
                INNER JOIN areaTown
                ON users.area_office = areaTown.id 
                WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
                ':id' => $id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    

}