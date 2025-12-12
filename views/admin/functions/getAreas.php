<?php 

use App\Controllers\AreaTownController;
require_once __DIR__ . '/../../../vendor/autoload.php';



$getAreas = ( new AreaTownController )->getAllAreas();
header('Content-type: application/json');
echo json_encode($getAreas);