<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

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

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum', 'check.token.validity'])->group(function () {

    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/users/{user}' , [App\Http\Controllers\Api\User\ReadUserController::class, 'getProfile']);
        Route::post('/search-user' , [App\Http\Controllers\Api\User\SearchUserController::class, 'search']);
        Route::post('/update', [App\Http\Controllers\Api\User\UpdateUserController::class, 'update']);
        //================================================================================================================================
        Route::get('posts', [App\Http\Controllers\Api\Posts\GetPostsController::class, 'homeFeed']);
        Route::post('/create-post', [App\Http\Controllers\Api\Posts\CreatePostController::class, 'create']);
        Route::post('/update-post/{post}', [App\Http\Controllers\Api\Posts\UpdatePostController::class, 'update']);
        Route::delete('/delete-post/{post}', [App\Http\Controllers\Api\Posts\DeletePostController::class, 'delete']);
        //================================================================================================================================
        Route::post('/create-like', [App\Http\Controllers\Api\Likes\CreateLikeController::class, 'create']);
        //================================================================================================================================
        Route::post('/create-comments/{post}', [App\Http\Controllers\Api\Comments\CreateCommentController::class, 'create']);
        Route::put('/update-comments/{comment}', [App\Http\Controllers\Api\Comments\UpdateCommentController::class, 'update']);
        Route::delete('/delete-comment/{comment}', [App\Http\Controllers\Api\Comments\DeleteCommentController::class, 'delete']);
        //================================================================================================================================
        Route::post('/create-frienship', [App\Http\Controllers\Api\Friendship\CreateRequestController::class, 'create']);
        Route::post('/accept-frienship', [App\Http\Controllers\Api\Friendship\AcceptRequestController::class, 'accept']);
        Route::delete('/delete-frienship', [App\Http\Controllers\Api\Friendship\DeleteFriendController::class, 'delete']);    
    }); 
});


