<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;

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
Route::post('/reserve',[ReservationController::class,'create']);