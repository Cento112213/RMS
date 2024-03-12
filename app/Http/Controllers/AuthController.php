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

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }
    
    public function refresh()
    {
        return $this->authService->refresh();
    }


}