<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AreaController;

$userid = $_SESSION['data']['id'];

$getAttendeesPerAreas = ( new AreaController )->getAttendees($userid);

var_dump($getAttendeesPerAreas);