<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;

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


Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Verify
Route::get('/verify/{token}', [UserController::class, 'verifyEmail'])->name('user.verified');
//Forget Password
Route::get('/forget-password/{token}', [UserController::class, 'fetchForgetPasswordLink'])->name('user.forgetpassword');

//Auth::routes();

Route::get('/register', [UserController::class, 'createRegister'])->name('register.form');
//Route::get('/login', [UserController::class, 'login'])->name('login');
//Route::post('/login', [UserController::class, 'saveLogin'])->name('save.login');
//Route::post('/save-register', function () {return view('auth.register'); })->name('register.save');
//Route::post('/save-register', [UserController::class, 'saveRegister'])->name('register.save');
