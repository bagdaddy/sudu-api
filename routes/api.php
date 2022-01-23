<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\FeedController;
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
        Route::get('/sent', [FriendListController::class, 'getSentInvites']);
        Route::get('/requests', [FriendListController::class, 'getPendingInvites']);
        Route::post('/accept/{id}', [FriendListController::class, 'acceptInvite']);
        Route::delete('/invite/{id}', [FriendListController::class, 'deleteInvite']);
        Route::delete('/{id}', [FriendListController::class, 'deleteFriend']);
    });
    Route::group(['prefix' => 'feed'], function() {
       Route::get('', [FeedController::class, 'getFeed']);
       Route::post('/comments/{id}', [FeedController::class, 'postComment']);
       Route::delete('/comments/{id}', [FeedController::class, 'deleteComment']);
       Route::patch('/comments/{id}', [FeedController::class, 'editComment']);
       Route::get('/{userId}', [FeedController::class, 'getPosts']);
       Route::post('/like/{id}', [FeedController::class, 'likeOrUnlikePost']);
       Route::post('', [FeedController::class, 'createPost']);
       Route::patch('/{id}', [FeedController::class, 'editPost']);
       Route::delete('/{id}', [FeedController::class, 'deletePost']);
    });
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'getAllUsers']);
});
