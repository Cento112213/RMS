<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;


class UserController extends Controller
{
    public function __construct(public UserService $userService) {
    }

    public function show()
    {
        return $this->userService->show();
    }
 
}
