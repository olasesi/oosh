<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\AccountController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::middleware('api')->group(function(){
//Route::get('/users', [UserController::class, 'createRegister'])->route('api.users');
 Route::post('/save-register', [UserController::class, 'saveRegister'])->name('register.save');
 Route::post('/save-login', [UserController::class, 'saveLogin'])->name('login.save');
Route::post('/forget-password', [UserController::class, 'forgetPassword'])->name('forgetpasswor.save');
 

Route::get('/show-friends', [FriendController::class, 'showFriends'])->name('showfriends.save');
Route::post('/connect-friends', [FriendController::class, 'connectFriend'])->name('connect.save');

 });

 Route::middleware(['auth:sanctum'])->group(function(){
     //This is for logout, etc
     Route::post('logout', [UserController::class, 'logout']);
 });