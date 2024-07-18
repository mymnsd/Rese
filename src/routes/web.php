<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
  // メール認証
  Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
  Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed','throttle:6,1'])->name('verification.verify');
  Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
  Route::get('/thanks',[VerificationController::class,'thanks'])->name('thanks');
  
  // ログアウト
  Route::post('/logout', [AuthController::class, 'destroy']);

  // 予約登録、キャンセル、変更
  Route::get('/reserve',[ReservationController::class,'index']);
  Route::post('/reserve',[ReservationController::class,'create']);
  Route::post('/reserve/confirm-cancel-page/{id}',[ReservationController::class,'confirmCancelPage'])->name('reserve.confirmCancelPage');
  Route::post('/reserve/confirm-cancel/{id}', [ReservationController::class,'confirmCancel'])->name('reserve.confirmCancel');
  Route::get('/reserve/{id}/edit',[ReservationController::class,'edit'])->name('reserve.edit_reserve');
  Route::put('/reserve/{id}',[ReservationController::class,'update'])->name('reserve.update');

  // マイページ
  Route::get('/mypage',[UserController::class,'mypage']);

  // お気に入り登録、解除
  Route::post('/favorite',[FavoriteController::class,'create'])->name('favorite.create');
  Route::post('/favorite/delete',[FavoriteController::class,'delete'])->name('favorite.delete');
});