<?php 
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UsersController;

$deleteUserId = $_POST['id'];

$delete = (new UsersController)->deleteUserById($deleteUserId);