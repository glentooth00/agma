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

    public function countAllMembers()
    {
        $count = new Members();

        return $count->countAll();
    }

    public function deleteMember($id)
    {
        $delete = (new Members)->delete($id);
        return;
    }

    public function searchMember($search)
    {
        $model = new Members();
        return $model->hasSpecialChars($search);
    }

    public function getConsumerDetails($data)
    {
        $model = new Members();
        return $model->getConsumerDetails($data);
    }

}