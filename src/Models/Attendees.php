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

    public function getAllAttendeesPerArea($id){

        $sql = "SELECT
                    areaTown.area_name,
                    areaTown.town_ids
                FROM areaTown 
                INNER JOIN users
                    ON users.area_office = areaTown.id
                WHERE users.id = :id ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $town_ids_string = $result[0]['town_ids'];

        $townIdsArray = explode(',',$town_ids_string);

        $placeholders = implode(',', array_fill(0, count($townIdsArray), '?'));

        $sql = "SELECT * FROM ScannedQRData WHERE townCode IN ($placeholders) ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);

        $i = array_values($townIdsArray);

        $stmt->execute($i);

        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


}