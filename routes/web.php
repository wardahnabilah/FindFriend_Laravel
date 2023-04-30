<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Routes
Route::get('/', [UserController::class, 'showHomepage']);
Route::post('/signup', [UserController::class, 'addUser'])->middleware('guest');
Route::get('/login', [UserController::class, 'showLoginPage'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->middleware('mustLogin');
Route::get('/search/{keyword}', [UserController::class, 'searchUser'])->middleware('mustLogin');

// Post Routes
Route::get('/create-post', [PostController::class, 'showPostForm'])->middleware('mustLogin');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustLogin');
Route::get('/post/{post}', [PostController::class, 'showThePost'])->middleware('mustLogin');
Route::delete('/post/{post}', [PostController::class, 'deletePost'])->middleware('mustLogin');
Route::get('/post/{post}/edit', [PostController::class, 'showEditPostForm'])->middleware('mustLogin');
Route::put('/post/{post}/edit', [PostController::class, 'updatePost'])->middleware('mustLogin');

// Profile Routes
Route::get('/profile/{user:username}', [UserController::class, 'showProfile'])->middleware('mustLogin');
Route::get('/profile/{user:username}/followers', [UserController::class, 'showProfileFollowers'])->middleware('mustLogin');
Route::get('/profile/{user:username}/following', [UserController::class, 'showProfileFollowing'])->middleware('mustLogin');
Route::get('/manage-avatar', [UserController::class, 'showEditProfile'])->middleware('mustLogin');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustLogin');

// Follow Routes
Route::post('/profile/{user:username}/follow', [FollowController::class, 'storeFollow'])->middleware('mustLogin');
Route::post('/profile/{user:username}/unfollow', [FollowController::class, 'deleteFollow'])->middleware('mustLogin');