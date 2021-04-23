<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TweetController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->middleware('throttle:login');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/tweet', [TweetController::class, 'create']);

    Route::post('/user/follow', [UserController::class, 'follow']);
});
