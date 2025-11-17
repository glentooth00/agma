<?php
session_start();
include_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UsersController;

$userId = $_GET['userid'];

$user = (new UsersController())->getuser($userId);

if($user){
    echo json_encode($user);
}else{
    echo json_encode(['error' => 'User not found']);
}