<?php
namespace App\Controllers;

use App\Models\Attendees;

class AttendeesController{

    private $model;

    public function __construct()
    {
        $this->model = new Attendees();

    }

    public function getAllTheAttendees()
    {
        $countAttendees = new Attendees();

        return $countAttendees->getAllAttendees();
    }




}