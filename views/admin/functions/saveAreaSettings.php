<?php 
include_once __DIR__ . '/../../../vendor/autoload.php';
use App\Controllers\AreaTownController;


$data = [
    'area_name' => $_POST['area_office'] ?? '',
    'town_ids' => $_POST['towns'] ?? [],
];

$saveAreData = ( new AreaTownController )->saveAreaSetting($data);