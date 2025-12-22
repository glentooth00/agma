<?php
namespace App\Controllers;

use App\Models\Attendees;

class AttendeesController{

    private $model;

    public function __construct()
    {
        $this->model = new Attendees();

    }

    // public function getDBInfo(){
    //     return $this->model->getConnInfo();
    // }

    public function getAllTheAttendees($data)
    {
        $countAttendees = new Attendees();

        return $countAttendees->getAllAttendees($data);
    }

    public function getAllTheAttendeesSQL()
    {
        $countAttendees = new Attendees();

        return $countAttendees->getAllAttendees();
    }

    public function raffle(){
         $countAttendees = new Attendees();

        return $countAttendees->getAttendees();
    }




}