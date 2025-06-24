<?php
include_once __DIR__ . '/../../vendor/autoload.php';
use App\Controllers\UsersController;
session_start();
session_unset();
session_destroy();
date_default_timezone_set("Asia/Manila");

$data = [
    'id' => $_GET['userid'],
    'status' => 'Offline',
    'updated_at' => date('Y-m-d H:i:s'),
    'last_login' => date('Y-m-d H:i:s'),
    'last_logout' => date('Y-m-d H:i:s'),
];


$logout = (new UsersController)->logoutStatusUpdate($data);

header('location:../../index.php');