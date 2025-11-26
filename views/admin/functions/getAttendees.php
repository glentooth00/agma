<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AreaController;

$userid = $_SESSION['data']['id'];

var_dump($_GET);


$getAttendeesPerAreas = ( new AreaController )->getAttendees($userid);

var_dump($getAttendeesPerAreas);