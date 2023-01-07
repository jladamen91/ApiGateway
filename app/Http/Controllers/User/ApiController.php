<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser;
    public function __construct()
    {
       // $this->Middleware('auth:api');
    }
}
