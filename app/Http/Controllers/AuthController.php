<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(public AuthService $authService) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Login User usig email and password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    /**
     * Register a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    /**
     * log the user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->authService->logout();
    }
    
    /**
     * Refresh the Token
     *
     * @return void
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->authService->refresh();
    }


}