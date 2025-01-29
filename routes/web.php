<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });





Route::get('/',[AuthController::class,'register'])->name('register');
Route::post('/registerpost', [AuthController::class, 'registerPost'])->name('registerpost');
Route::get('/otp',[AuthController::class, 'otp'])->name('otp');
Route::post('/verify',[AuthController::class,'verify_otp'])->name('verify');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginpost', [AuthController::class, 'loginpost'])->name('loginpost');
Route::get('/home',[AuthController::class,'home'])->name('user.home');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/bookdetail',[AuthController::class,'homePost'])->name('bookdetail');
Route::get('/delete/{id}',[AuthController::class,'delete'])->name('delete');
Route::get('/edit/{id}', [AuthController::class, 'edit'])->name('edit');
Route::post('/edit/{id}', [AuthController::class, 'update'])->name('update');