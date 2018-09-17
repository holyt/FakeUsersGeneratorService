<?php

namespace App\Http\Controllers;

use App\UserGenerator\UserGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ParamsUserGeneratorController extends Controller
{
    protected  $userGenerator;
    public function __construct()
    {
        $this->userGenerator = new UserGenerator();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'number_of_users' => 'required|integer',
            'gender' => ['string',  Rule::in(['male', 'female'])]
        ]);
    }


    public function show(Request $request)
    {
        $validData = $this->validator($request->all())->validate();

        $numberOfUsers = $validData['number_of_users'];
        $gender =  isset($validData['gender']) ? $validData['gender'] : null;


        return $this->userGenerator->generateUsers($numberOfUsers, $gender);
    }
}
