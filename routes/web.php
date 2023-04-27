<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Post Routes
Route::get('/create-post', [PostController::class, 'showPostForm'])->middleware('mustLogin');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustLogin');
Route::get('/post/{post}', [PostController::class, 'showThePost'])->middleware('mustLogin');