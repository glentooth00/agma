<?php
namespace App\Controllers;

use App\Models\Area;
use App\Models\Attendees;

class AreaController{

    private $model;


    public function __construct()
    {
        $this->model = new Area();

    }

    public function getEstanciaCount()
    {

        $countArea = new Area();

        return $countArea->countEstanciaAttendees();

    }

    public function getBalasanCount()
    {
        $countArea = new Area();

         return $countArea->countBalasanAttendees();

    }

    public function getBatadCount()
    {
        $countArea = new Area();

         return $countArea->countBatadAttendees();
    }

    public function getCarlesCount()
    {
        $countArea = new Area();

         return $countArea->countCarlesAttendees();
    }

    public function getSaraCount()
    {
        $countArea = new Area();

         return $countArea->countSaraAttendees();
    }

    public function getSanDionisioCount()
    {
        $countArea = new Area();

         return $countArea->countSanDionisioAttendees();
    }
    
    public function getSanRafaelCount()
    {
        $countArea = new Area();

         return $countArea->countSanRafaelAttendees();
    }

    public function getLemeryCount()
    {
        $countArea = new Area();

        return $countArea->countLemeryAttendees();
    }

    public function getConcepcionCount()
    {
        $countArea = new Area();

         return $countArea->countConcepcionAttendees();
    }

    public function getGigantesCount()
    {
        $countArea = new Area();

         return $countArea->countGigantesAttendees();
    }

    public function getAjuyCount(){

        $countArea = new Area();

         return $countArea->countAjuyAttendees();

    }

    public function getBarotacViejoCount(){

        $countArea = new Area();

         return $countArea->countBarotacViejoAttendess();

    }

    public function getBanateCount(){
     
        $countArea = new Area();

        return $countArea->countBanateAttendees();
        
    }

    public function getAnilaoCount(){

        $countArea =  new Area();

        return $countArea->countAnilaoAttendees();

    }

    public function getAttendees($id){
        return (new Attendees )->getAllAttendeesPerArea($id);
    }


}