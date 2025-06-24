<?php

use App\Controllers\MembersController;
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';

$id = $_POST['id'];

$delete = (new MembersController)->deleteMember($id);

if ($delete) {
    $_SESSION['notification'] = [
        'message' => 'Deleted successfully',
        'type' => 'success'
    ];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'failed']);
}
