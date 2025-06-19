<?php
namespace App\Controllers;

use App\Models\Members;

class MembersController
{
    public function getAllMembers()
    {
        $members = (new Members)->getAll();

        return $members;
    }
}