<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\AdminShopController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Auth\ShopManagerRegisterController;
use App\Http\Admin\AdminHomeController;
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


// 一覧表示
Route::get('/',[ShopController::class,'index']);

// 店舗詳細
Route::get('/detail/{shop_id}',[ShopController::class,'detail'])->name('shops.detail');

// QRコード
Route::get('/reservations/{reservation}/qrcode', [QRCodeController::class, 'generate'])->name('reservations.qrcode');
Route::get('/reservations/{reservation}/verify', [ReservationController::class, 'verify'])->name('reservations.verify');

// 店舗保存
// Route::get('/admin', [AdminShopController::class, 'index'])->name('admin.admin_index');
// Route::get('/admin/create', [AdminShopController::class, 'create'])->name('admin.create');
// Route::post('/admin', [AdminShopController::class, 'store'])->name('admin.store');

// ユーザー登録
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);

// ユーザーログイン
Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store']);


Route::middleware('auth')->group(function () {
  // メール認証
  Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
  Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed','throttle:6,1'])->name('verification.verify');
  Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
  Route::get('/thanks',[VerificationController::class,'thanks'])->name('thanks');

  // レビュー
  Route::get('reservations/{reservation}/review', [ReviewController::class, 'create'])->name('reviews.create');
  Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
  Route::get('reviews/thanks', [ReviewController::class, 'thanksReview'])->name('reviews.thanks');
  
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


// 店舗代表者のログイン・ログアウト
Route::get('login/shop_manager', [Auth\LoginController::class, 'showLoginForm'])->name('shop_manager.login.form');
Route::post('login/shop_manager', [Auth\LoginController::class, 'login'])->name('shop_manager.login');
Route::post('logout/shop_manager', [Auth\LoginController::class, 'logout'])->name('shop_manager.logout');

// 店舗管理用のルートグループ
Route::prefix('admin')->middleware(['auth', 'role:shop_manager'])->group(function () {
    Route::resource('shops', AdminShopController::class);
    Route::get('admin_reservations', [AdminReservationController::class, 'index'])->name('admin.reservation');

    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');

    // 店舗代表者の登録フォームと登録処理
    Route::get('register/shop_manager', [ShopManagerRegisterController::class, 'showRegistrationForm'])->name('shop_manager.register.form');
    Route::post('register/shop_manager', [ShopManagerRegisterController::class, 'register'])->name('shop_manager.register');

});
  