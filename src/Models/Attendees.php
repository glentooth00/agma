<?php
namespace App\Models;

use App\Config\Database;
use PDO;


class Attendees{
    private $db;

    private $table = "ScannedQRData";

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }


}