<?php

namespace App\Http\Controllers;

use App\UserGenerator\UserGenerator;
use Illuminate\Http\Request;

class UserParamsController extends Controller
{

    public function show()
    {
        $params = [
            'number_of_users' => 'Number of fake user to create',
            'gender' => 'Gender of users null|male|female|',
        ];

        return $params;
    }
}
