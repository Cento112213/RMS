<?php

namespace App\Http\Services;
use Illuminate\Http\Request;

interface AuthService
{

    public function __construct();

    /**
     * Interface for Login user using email and password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request);

    /**
     * Interface for Register user
     *
     * @param Request $request
     * @return @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request);

    /**
     * Interface for log the user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout();

    /**
     * Interface for Refresh the Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh();

}
