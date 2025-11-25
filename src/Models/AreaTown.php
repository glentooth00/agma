<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class AreaTown {


    private $db;

    private $table = 'AreaTown';

    public function __construct(){

        $this->db =  Database::connect();

    }

    public function save($data){

        $sql = "INSERT INTO " . $this->table . " (area_name, town_ids)
                VALUES (:area_name , :town_ids)";
        $stmt = $this->db->prepare($sql);

        $imploded = implode(",", $data['town_ids']);

        return $stmt->execute([
            ':area_name' => $data['area_name'],
            ':town_ids' => $imploded,
        ]);
    }

    public function getAreas(){

        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}