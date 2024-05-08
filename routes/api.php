<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\TestsController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // Route::post('/register', 'Api\AuthController@register');
// // Route::post('/login', 'Api\AuthController@login');
// Route::post('/register', 'Api\Auth\UserAuthController@register');
// Route::post('/login', 'Api\Auth\UserAuthController@login');
Route::post('userRegister', [UserAuthController::class, 'register']);

Route::post('userLogin', [UserAuthController::class, 'login']);
