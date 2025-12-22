<?php
namespace App\Models;

use App\Config\Database;
use PDO;


class Attendees{
    private $db;

    private $table = "scannedqrdata";

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // public function getConnInfo(){
    //     return $this->db->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    // }   

    public function getAllAttendees($userid){

        $sql = "SELECT * FROM users WHERE id = :id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $userid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $townId = $result['area_office'];

        $getTownIdsSql = "SELECT town_ids FROM areaTown WHERE id = :area_office ";
        $stmt = $this->db->prepare($getTownIdsSql);
        $stmt->execute([
            ':area_office' => $townId
        ]);

        $resultTownIds = $stmt->fetch(PDO::FETCH_ASSOC);

        $townIds = $resultTownIds['town_ids'];

        $townIdsArray = explode(',', $townIds);

        $placeholders = rtrim(str_repeat('?,', count($townIdsArray)), ',');

        $sql = "SELECT COUNT(*) as TOTAL FROM ScannedQRData WHERE townCode IN ($placeholders) ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($townIdsArray);

        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

    public function getAttendees(){
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}