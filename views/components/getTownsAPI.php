<?php
require_once '../../vendor/autoload.php';
use App\Controllers\TownsController;

$search = $_GET['search'] ?? '';
$towns = (new TownsController)->getTowns($search);

// filter towns by search term
$results = array_filter($towns, function($town) use ($search) {
    
    return stripos($town['TownName'], $search) !== false;
});

echo json_encode(array_values($results));
