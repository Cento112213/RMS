<?php

namespace App\Providers;

// Services
use App\Http\Services\AuthService;
use App\Http\Services\ProjectService;
use App\Http\Services\UserService;
use App\Http\Services\EmailVerificationService;

// Implementations
use App\Http\Implementations\AuthServiceImpl;
use App\Http\Implementations\ProjectServiceImpl;
use App\Http\Implementations\UserServiceImpl;
use App\Http\Implementations\EmailVerificationServiceImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        AuthService::class => AuthServiceImpl::class,
        ProjectService::class => ProjectServiceImpl::class,
        UserService::class => UserServiceImpl::class,
        EmailVerificationService::class => EmailVerificationServiceImpl::class,
    ];
    /** 
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
