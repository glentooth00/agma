<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Towns{

    private $sql;
    private $db;

    private $table = 'Town';

    public function __construct(){

        $this->db = Database::connect();

    }

public function getAllTowns($search = '') {
    if ($search) {
        // Use LIKE for search
        $sql = "SELECT * FROM " . $this->table . " WHERE TownName LIKE :search";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%');
    } else {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}