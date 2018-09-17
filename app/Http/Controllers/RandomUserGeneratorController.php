<?php

namespace App\Http\Controllers;

use App\UserGenerator\UserGenerator;

class RandomUserGeneratorController extends Controller
{
    protected  $userGenerator;
    public function __construct()
    {
        $this->userGenerator = new UserGenerator();
    }

    public function show()
    {
        return $this->userGenerator->generateUser();
    }
}
