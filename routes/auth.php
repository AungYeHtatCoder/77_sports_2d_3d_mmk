<?php 

use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;




Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
