<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //================================================================================================================================
    Route::post('/search-user' , [App\Http\Controllers\User\SearchUsersController::class, 'search'])->name('user.search');
    Route::get('/users/{user}' , [App\Http\Controllers\User\ReadUserController::class, 'getProfile'])->name('user.profile');
    Route::get('/edit-user', function () { return view('editProfile');})->name('edit.profile');
    Route::put('/update/{user}', [App\Http\Controllers\User\UpdateUserController::class, 'update'])->name('update.profile');
    Route::put('/update-password/{user}', [App\Http\Controllers\User\UpdateUserController::class, 'changePass'])->name('update.password');
    //================================================================================================================================
    Route::post('/create-post', [App\Http\Controllers\Posts\CreatePostController::class, 'create'])->name('post.create');
    Route::post('/update-post/{post}', [App\Http\Controllers\Posts\UpdatePostController::class, 'update'])->name('post.update');
    Route::delete('/delete-post/{post}', [App\Http\Controllers\Posts\DeletePostController::class, 'delete'])->name('post.delete');
    //================================================================================================================================
    Route::post('/create-like', [App\Http\Controllers\Likes\CreateLikeController::class, 'create'])->name('like.create');
    //================================================================================================================================
    Route::post('/create-comments/{post}', [App\Http\Controllers\Comments\CreateCommentController::class, 'create'])->name('comment.create');
    Route::put('/update-comments/{comment}', [App\Http\Controllers\Comments\UpdateCommentController::class, 'update'])->name('comment.update');
    Route::delete('/delete-comment/{comment}', [App\Http\Controllers\Comments\DeleteCommentController::class, 'delete'])->name('comment.delete');
    //================================================================================================================================
    Route::post('/create-frienship', [App\Http\Controllers\Friendship\CreateRequestController::class, 'create'])->name('friendRequest.create');
    Route::post('/accept-frienship', [App\Http\Controllers\Friendship\AcceptRequestController::class, 'accept'])->name('friendRequest.accept');
    Route::delete('/delete-frienship', [App\Http\Controllers\Friendship\DeleteFriendController::class, 'delete'])->name('friend.delete');

});
