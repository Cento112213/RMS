<?php

namespace App\Http\Implementations;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserService;

Class UserServiceImpl implements UserService
{
    
    public function __construct() {
    }

    public function show()
    {
        $users = User::with('userdetail')->get();

        return response()->json([
            'success' => true,
            'message' => 'Successfully show Interns',
            'Interns' => $users
        ], 200);
    }

}