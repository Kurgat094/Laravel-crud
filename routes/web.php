<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });





Route::get('/',[AuthController::class,'register'])->name('register');
Route::post('/registerpost', [AuthController::class, 'registerPost'])->name('registerpost');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginpost', [AuthController::class, 'loginpost'])->name('loginpost');
Route::get('/home',[AuthController::class,'home'])->name('user.home');