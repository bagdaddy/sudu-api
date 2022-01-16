<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\FriendListController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::group(['prefix' => 'user'], function() {
       Route::get('/', [UserController::class, 'getUser']);
       Route::get('/{id}', [UserController::class, 'view']);
       Route::patch('/', [UserController::class, 'update']);
       Route::post('/change-password', [UserController::class, 'changePassword']);
    });
    Route::group(['prefix' => 'friends'], function() {
        Route::post('/invite', [FriendListController::class, 'sendInvite']);
        Route::get('', [FriendListController::class, 'getList']);
        Route::get('/sent', [FriendListController::class, 'getSentRequests']);
        Route::get('/requests', [FriendListController::class, 'getPendingRequests']);
        Route::post('/accept/{id}', [FriendListController::class, 'acceptInvite']);
    });
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});
