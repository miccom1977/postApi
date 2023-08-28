<?php

use App\Http\Controllers\Api\{
    AuthController, PostController, RegistrationController, UserController };
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('posts', PostController::class)->only('index', 'show');
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('users', UserController::class);
    Route::post('register', [RegistrationController::class, 'create']);
});
