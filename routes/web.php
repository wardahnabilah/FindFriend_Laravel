<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [UserController::class, 'showHomepage']);
Route::post('/signup', [UserController::class, 'addUser']);
Route::get('/login', [UserController::class, 'showLoginPage']);
Route::post('/login', [UserController::class, 'login']);
