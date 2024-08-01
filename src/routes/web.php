<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreManagerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\StoreManagerLoginController;
use App\Http\Controllers\Auth\AdminLoginController;

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

// 店舗情報
Route::get('/detail/{shop_id}',[ShopController::class,'detail'])->name('shops.detail');

// QRコード
Route::get('/reservations/{reservation}/qrcode', [QRCodeController::class, 'generate'])->name('reservations.qrcode');
Route::get('/reservations/{reservation}/verify', [ReservationController::class, 'verify'])->name('reservations.verify');

// ユーザー登録
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);

// ユーザーログイン
Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store']);

// ユーザールート
Route::middleware('auth')->group(function () {
  // メール認証
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed','throttle:6,1'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/thanks',[VerificationController::class,'thanks'])->name('thanks');

  // レビュー
    Route::get('reservations/{reservation}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reservations/{reservation}/review', [ReviewController::class, 'store'])->name  ('reviews.store');
    Route::get('reviews/thanks', [ReviewController::class, 'thanksReview'])->name('reviews.thanks');
    
  // ログアウト
    Route::post('/logout', [AuthController::class, 'destroy']);

  // 予約登録、キャンセル、変更
    Route::get('/reserve',[ReservationController::class,'index']);
    Route::post('/reserve',[ReservationController::class,'create']);
    Route::post('/reserve/confirm-cancel-page/{id}',[ReservationController::class,'confirmCancelPage'])->name('reserve.confirmCancelPage');
    Route::post('/reserve/confirm-cancel/{id}', [ReservationController::class,'confirmCancel']) ->name('reserve.confirmCancel');
    Route::get('/reserve/{id}/edit',[ReservationController::class,'edit'])->name('reserve.edit_reserve');
    Route::put('/reserve/{id}',[ReservationController::class,'update'])->name('reserve.update');

  // 予約一覧取得
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

  // マイページ
    Route::get('/mypage',[UserController::class,'mypage']);

  // お気に入り登録、解除
    Route::post('/favorite',[FavoriteController::class,'create'])->name('favorite.create');
    Route::post('/favorite/delete',[FavoriteController::class,'delete'])->name('favorite.delete');
});

// 店舗代表者用ログインページ
Route::prefix('store-manager')->group(function () {
    Route::get('login', [StoreManagerLoginController::class, 'showLoginForm'])->name('store-manager.login');
    Route::post('login', [StoreManagerLoginController::class, 'login']);
});

// 店舗代表者ルート
Route::middleware(['auth', 'role:store_manager'])->group(function () {
    Route::get('store_manager', [StoreManagerController::class, 'index'])->name('store_manager.index');
    Route::put('store_manager/update', [StoreManagerController::class, 'update'])->name('store_manager.update');
    Route::get('store_manager/reservations', [StoreManagerController::class, 'reservations'])->name('store_manager.reservations');
});

// 店舗代表者作成ルート（管理者のみアクセス）
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/create_store_manager', [AdminController::class, 'createStoreManager'])->name('admin.create_store_manager');
    Route::post('admin/store_store_manager', [AdminController::class, 'storeStoreManager'])->name('admin.store_store_manager');
    
});

// 管理者登録
Route::get('admin/create_admin', [AdminController::class, 'createAdmin'])->name('admin.create_admin');
Route::post('admin/store_admin', [AdminController::class, 'storeAdmin'])->name('admin.store_admin');

// 管理者登録完了ページ
Route::get('admin/registration_complete', function() {
    return view('admin.registration_complete');
})->name('admin.registration_complete');

// 管理者用ログイン
  Route::get('admin/login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
  Route::post('admin/login',[AdminLoginController::class,'login']);