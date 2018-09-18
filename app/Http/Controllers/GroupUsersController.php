<?php

namespace App\Http\Controllers;

use App\Group;

class GroupUsersController extends Controller
{
    public function show(int $groupId)
    {
        $group = Group::findOrFail($groupId);
        return $group->getUsers();
    }
}
