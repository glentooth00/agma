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

    private $table = "customer_details";

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
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY c_id LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
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
        var_dump($search);
    }



    public function getAllAttendees(){
        $sql = "SELECT * FROM ScannedQRData";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // search via name, account number and meter number with special characters 
    public function hasSpecialChars($search) {
        
        if( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $search )){

            $account_no = $search;
            $member_name = preg_replace( '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', '', $search );
            $meterNumber = str_replace("-", "", $search );

            $sql = "SELECT 
                    * FROM 
                        " . $this->table . 
                    "WHERE 
                        c_id 
                    LIKE 
                        :account_no 
                    OR 
                        fullname 
                    LIKE 
                        :name 
                    OR 
                        ced_meternumber 
                    LIKE 
                        :ced_meternumber";
                        
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':account_no', '%' . $account_no . '%', PDO::PARAM_STR);
            $stmt->bindValue(':name', '%' . $member_name . '%',  PDO::PARAM_STR);
            $stmt->bindValue(':ced_meternumber', '%' .$meterNumber . '%', PDO::PARAM_STR);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        }

        return $results;

    }


    public function getConsumerDetails($data){
        
        $member_name = preg_replace( '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', '', $data );
        $meterNumber = str_replace("-", "", $data );

        $townCode =  substr($data, 0, 2);
        $routeCode = substr($data, 2, 4);
        $accountCode =  substr($data, 6, 8);

        $account_no = $townCode . '-' . $routeCode . '-' . $accountCode;

        $sql = "
                SELECT * FROM 
                    " . $this->table . " 
                WHERE 
                    c_id LIKE :account_no
            ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':account_no', '%' . $account_no . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
}