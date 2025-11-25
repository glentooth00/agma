<?php 
namespace App\Controllers;

use App\Models\AreaTown;

class AreaTownController{

    private $model;

    public function __construct(){
        $this->model = new AreaTown();
    }

    public function saveAreaSetting($data): bool{
        return $this->model->save($data);
    }

    public function getAllAreas(){
        return $this->model->getAreas();
    }



}