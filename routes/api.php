<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    // user
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);   
    Route::put('/user-update', [AuthController::class, 'updateUserProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    // project
    Route::get('/projects', [ProjectController::class, 'show']); 
    Route::post('/projects/{project}/assign-users', [ProjectController::class, 'assignUser']); 
    Route::post('/projects/create-project', [ProjectController::class, 'create']);
    Route::put('/projects/{project}/update-project', [ProjectController::class, 'update']);

    // user
    Route::get('/interns', [UserController::class, 'show']);
    Route::get('/interns/{user}/user-project', [ProjectController::class, 'findByUser']);
});
