<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;

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
 Route::post('/save-register', [UserController::class, 'saveRegister']);
 Route::post('/save-login', [UserController::class, 'saveLogin']);
Route::post('/forget-password', [UserController::class, 'forgetPassword']);
Route::post('/save-reset', [UserController::class, 'saveReset']);

Route::get('/show-friends', [FriendController::class, 'showFriends']);
Route::post('/connect-friends', [FriendController::class, 'connectFriend']);


 });

 Route::middleware(['auth:sanctum'])->group(function(){
    
     Route::post('/logout', [UserController::class, 'logout']);
     Route::get('/dashboard-header', [DashboardController::class, 'showHeaderInfo']);
     Route::get('/dashboard-potential-friend', [DashboardController::class, 'aPotentialFriends']);
     Route::get('/dashboard-image-profile', [DashboardController::class, 'userImageProfile']);

     Route::get('/user-settings', [SettingController::class, 'editSetting']);
     Route::patch('/update-settings', [SettingController::class, 'updateSetting']);
     
     Route::get('/display-profile', [ProfileController::class, 'displayProfile']);

     //Page
     
     Route::get('/list-page-category', [PageController::class, 'pageCategoryType']);
     Route::post('/create-page', [PageController::class, 'createPage']);
     Route::get('/show-page-list', [PageController::class, 'showPageList']);
     
 });

//All these should be under sanctum
