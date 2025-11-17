<?php
session_start();
include_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UsersController;

$data = [
    'username' => $_POST['username'],
    'password' => md5($_POST['password']),
    'role' => $_POST['role'],
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'middlename' => $_POST['middlename'],
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'status' => 'offline'
];

$saveUser = (new UsersController)->createUser($data);

if ($saveUser) {
    $_SESSION['popup_message'] = "User created successfully!";
    $_SESSION['popup_type'] = "success";
} else {
    $_SESSION['popup_message'] = "Failed to create user.";
    $_SESSION['popup_type'] = "error";
}

// Redirect back to the users page
header("Location:../users.php");
exit;
