<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\GenerateGroupUsersJob;
use App\Group;

class GroupController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'number_of_users' => 'required|integer'
        ]);
    }

    public function store(Request $request)
    {
        $validData = $this->validator($request->all())->validate();
        $group = new Group;
        $group->fill($validData);
        $group->save();

        $this->dispatch(new GenerateGroupUsersJob($group));
        return response(['group_id' => $group->id], 201 );
    }
}
