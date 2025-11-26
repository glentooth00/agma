<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Controllers\AreaTownController;

$id = $_POST['id'] ?? null;

if ($id) {
    $deleted = (new AreaTownController())->deleteArea($id);
    if ($deleted) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}
