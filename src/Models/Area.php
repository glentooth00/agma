<?php
namespace App\Models;

use App\Config\Database;
use PDO;


class Area{
    private $db;

    private $table = "scannedQrdata";

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function countEstanciaAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '10'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countBalasanAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '11'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countBatadAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '09'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countCarlesAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '12'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countSaraAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '04'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countSanDionisioAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '08'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countSanRafaelAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '05'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countLemeryAttendees(){
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '06'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countConcepcionAttendees(){

        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '07'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }

    public function countGigantesAttendees(){

        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '15'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }
    
    public function countAjuyAttendees(){

        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '13'" ;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }

    public function countBarotacViejoAttendess(){

        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '03'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }

    public function countBanateAttendees(){
        
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '02'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }
    
    public function countAnilaoAttendees(){

        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE townCode = '01'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();

    }


}