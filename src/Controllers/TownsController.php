<?php 
namespace App\Controllers;

use App\Models\Towns;

class TownsController{

    private $model;

    public function __construct(){
        $this->model = new Towns();
    }

    public function getTowns(){
        return $this->model->getAllTowns();
    }



}