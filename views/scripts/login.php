<?php
include_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\UsersController;

session_start();
error_reporting();
date_default_timezone_set("Asia/Manila");

$login = (new UsersController)->authenticate(
    [
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ]
);

if ($login == true) {

    $postPassword = $_POST['password'];
    $password = $login['password'];
    $hashedPassword = md5($postPassword);

    if ($hashedPassword === $password) {

        $_SESSION['data'] = [
            'firstname' => $login['firstname'],
            'middlename' => $login['middlename'],
            'lastname' => $login['lastname'],
            'user_type' => $login['user_type'],
            'id' => $login['id'],
            'status' => 'Online',
            'username' => $login['username'],
            'last_login' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $auth = (new UsersController)->loginStatusUpdate($_SESSION['data']);

        
        header('Location: ../admin/index.php');

        

    } 


} else {

    // $_SESSION['notification'] = [
    //     'message' => 'Incorrect username or password',
    //     'type' => 'warning'
    // ];

    // header('location:' . $_SERVER['HTTP_REFERER']);

}