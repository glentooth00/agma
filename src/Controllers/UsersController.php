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



}