<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;


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

Route::get('/',[ShopController::class,'index']);
Route::get('/detail/{shop_id}',[ShopController::class,'detail'])->name('shops.detail');
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);
Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store']);


Route::middleware('auth')->group(function () {
  Route::post('/logout', [AuthController::class, 'destroy']);
  Route::post('/reserve',[ReservationController::class,'create']);
  Route::get('/mypage',[UserController::class,'mypage']);
  Route::post('/favorite',[FavoriteController::class,'create']);
  Route::post('/favorite/delete',[FavoriteController::class,'delete']);
});