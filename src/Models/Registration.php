<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Registration{

    private $sql;
    private $db;

    private $table = 'online_registration';

    public function __construct(){

        $this->db = Database::connect();

    }

    public function saveRegistration($data){

        $filePath =  '../../../views/admin/uploads/';
        $uploadOk = 1;
        $id_image = $filePath . basename($data['image']['name']);

        if(!move_uploaded_file($_FILES["image"]["tmp_name"],  $id_image)) {
        
            echo "Sorry, there was an error uploading your file.";
            return;

        } else {

            $imagePath = 'uploads/' . htmlspecialchars( basename( $data['image']['name']));

            $sql = "INSERT INTO " 
                        . $this->table . 
                    " ( account_number, 
                        fullname, 
                        meter_number, 
                        contact_number, 
                        email, 
                        birthday, 
                        address, 
                        valid_id ) VALUES (
                        :account_number, 
                        :fullname, 
                        :meter_number, 
                        :contact_number, 
                        :email, 
                        :birthday, 
                        :address, 
                        :valid_id
                        )";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':account_number' => $data['account_no'],
                ':fullname' => $data['member_name'],
                ':meter_number' => $data['meter_number'],
                ':contact_number' => $data['contact_no'],
                ':email' => $data['email'],
                ':birthday' => $data['date_of_birth'],
                ':address' => $data['Address'],
                ':valid_id' => $imagePath
            ]);


            $lastInsrtedId = $this->db->lastInsertId();

            $getLastInsertedData = " SELECT * FROM " 
                                    . $this->table . 
                                " WHERE id = :id";
            $stmt = $this->db->prepare($getLastInsertedData);
            $stmt->execute([
                ':id' => $lastInsrtedId
            ]);

            $getLastdata = $stmt->fetch(PDO::FETCH_ASSOC);

            return json_encode($getLastdata);
            
        }

    }


}