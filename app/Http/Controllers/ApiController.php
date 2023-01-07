<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;


class ApiController extends Controller
{
    use ApiResponser;
    public function __construct()
    {
       // $this->Middleware('auth:api');
    }
}
