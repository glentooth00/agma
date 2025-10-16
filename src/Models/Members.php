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

    private $table = "consumer";

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

    public function getAll($limit = 100, $offset = 0)
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY ConsumerID OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    //search using name, Account number and Meter Number
    public function searchMember($search)
    {
        try {
            $sql = "SELECT 
                        C.*,
                        M.*,
                        -- Format: 11-1121-0080
                        (CAST(C.TownCode AS VARCHAR) + '-' +
                        CAST(C.TownCode AS VARCHAR) + CAST(C.RouteCode AS VARCHAR) + '-' +
                        CAST(C.AcctCode AS VARCHAR)) AS AccountNumber
                    FROM Consumer C
                    INNER JOIN Meter M ON C.ConsumerID = M.ConsumerID
                    WHERE 
                        -- Match against formatted Account Number
                        (CAST(C.TownCode AS VARCHAR) + '-' + 
                        CAST(C.TownCode AS VARCHAR) + CAST(C.RouteCode AS VARCHAR) + '-' +
                        CAST(C.AcctCode AS VARCHAR)) LIKE :account_number
                        OR C.Name LIKE :name
                        OR M.MeterSN = :meter_sn";

            $stmt = $this->db->prepare($sql);

            $likeSearch = '%' . $search . '%';

            $stmt->bindValue(':account_number', $likeSearch, PDO::PARAM_STR);
            $stmt->bindValue(':name', $likeSearch, PDO::PARAM_STR);
            $stmt->bindValue(':meter_sn', $search, PDO::PARAM_STR); // exact match

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }










}