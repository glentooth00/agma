<?php
namespace App\Controllers;

use App\Models\User;

class UsersController
{

    public function authenticate($data)
    {
        $user = (new User)->getByUsername([
            'username' => $data['username'],
            'password' => md5($data['password'])
        ]);

        return $user;
    }

    public function loginStatusUpdate($data)
    {
        (new User)->updateStatus($data);
    }

    public function logoutStatusUpdate($data)
    {
        (new User)->updateLogoutStatus($data);
    }

    public function fetchAllUsers()
    {
        return (new User)->getUsers();
    }

    public function createUser($data)
    {
        return (new User)->addUser($data);
    }

    public function getuser($id)
    {
        return (new User)->getUserbyId($id);

    }

    public function deleteUserById($id)
    {
        return (new User)->deleteUser($id);
    }

    public function getUserArea($id){
        return (new User)->getUserAreainfo($id);
    }

    public function getAreaListPerUser($id){
        return (new User)->getAreaList($id);
    }


}