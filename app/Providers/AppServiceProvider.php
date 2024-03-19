<?php

namespace App\Providers;

// Services
use App\Http\Services\AuthService;
use App\Http\Services\ProjectService;
use App\Http\Services\UserService;

// Implementations
use App\Http\Implementations\AuthServiceImpl;
use App\Http\Implementations\ProjectServiceImpl;
use App\Http\Implementations\UserServiceImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        AuthService::class => AuthServiceImpl::class,
        ProjectService::class => ProjectServiceImpl::class,
        UserService::class => UserServiceImpl::class,
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
